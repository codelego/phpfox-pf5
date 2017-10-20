<?php

namespace Phpfox\Storage;

/**
 * Class FtpFileStorage
 *
 * <p>
 * Storage file uses FTPs servers, In order too build your own intranet website,
 * it is helpful to separating storage machine from application machine.
 * </p>
 * <quote>
 * Prefer Ssh2FileStorage than FtpFileStorage for performance and security.
 * </quote>
 *
 * @package Phpfox\Storage
 */
class FtpStorage implements StorageInterface
{
    use FileStorageTrait;

    /**
     * @var int
     */
    private $port = 21;

    /**
     * @var string
     */
    private $host = 'localhost';

    /**
     * @var int
     */
    private $timeout = 3;

    /**
     * @var bool
     */
    private $isFtps = 0;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var \resource
     */
    private $ftpStream;

    /**
     * FtpFileStorage constructor.
     *
     * Params array contain
     * - basePath: string, required
     * - baseUrl: string, required
     * - baseCdnUrl: string, optional, default = baseUrl
     * - timeout: int , optional, default "3" seconds
     * - username: string, required
     * - password: string, required
     * - port: int, optional, default "21"
     * - protocol: string, optional default "ftp", available value "ftp"|"ftps"
     *
     * @param array $params
     */
    public function __construct($params)
    {

        if (isset($params['basePath'])) {
            $this->basePath = $params['basePath'];
        }

        if (isset($params['baseUrl'])) {
            $this->baseUrl = $params['baseUrl'];
        }

        if (isset($params['baseCdnUrl'])) {
            $this->baseCdnUrl = $params['baseCdnUrl'];
        }

        if (null == $this->baseUrl) {
            $this->baseUrl = PHPFOX_BASE_URL;
        }

        if (null == $this->basePath) {
            $this->basePath = PHPFOX_BASE_DIR;
        }

        if (null == $this->baseCdnUrl) {
            $this->baseCdnUrl = PHPFOX_BASE_URL;
        }

        $this->basePath = rtrim($this->basePath, '/') . '/';
        $this->baseUrl = rtrim($this->baseUrl, '/') . '/';
        $this->baseCdnUrl = rtrim($this->baseCdnUrl, '/') . '/';


        if (!empty($params['timeout'])) {
            $this->timeout = (int)$params['timeout'];
        }

        if (!empty($params['username'])) {
            $this->username = $params['username'];
        }

        if (!empty($params['password'])) {
            $this->password = $params['password'];
        }

        if (!empty($params['host'])) {
            $this->host = $params['host'];
        }

        if (!empty($params['port'])) {
            $this->port = (int)$params['port'];
        }

        if (!empty($params['protocol'])) {
            $this->isFtps = (strtolower($params['protocol']) == 'ftps') ? 1 : 0;
        }
    }

    public function getObject($name)
    {
        $path = $this->mapPath($name);

        $handle = tmpfile();

        if (!$handle) {
            throw new FileStorageException('Can not open stream to buffer data');
        }

        $this->connect();

        // Non-blocking mode
        if (@function_exists('ftp_nb_fget')) {
            $res = @ftp_nb_fget($this->ftpStream, $handle, $path, FTP_BINARY);
            while ($res == FTP_MOREDATA) {
                //$this->_announce('nb_get');
                $res = @ftp_nb_continue($this->ftpStream);
            }
            $return = ($res === FTP_FINISHED);
        } // Blocking mode
        else {
            $return = @ftp_fget($this->ftpStream, $handle, $path, FTP_BINARY);
        }

        if (!$return) {
            throw new FileStorageException(sprintf('Unable to get contents of "%s"',
                $path));
        }

        $data = '';
        fseek($handle, 0); // seek to begin of file.
        while (false != ($line = fread($handle, 1024))) {
            $data .= $line;
        }
        fclose($handle);
        $this->disconnect();

        return $data;
    }

    /**
     * @return \resource
     * @throws FileStorageException
     */
    private function connect()
    {
        if (null != $this->ftpStream) {
            return $this->ftpStream;
        }

        if ($this->isFtps == false) {
            $this->ftpStream = @ftp_connect($this->host, $this->port,
                $this->timeout);
        } else {
            if (!function_exists('ftp_ssl_connect')) {
                throw new FileStorageException(sprintf('Unexpected configuration, Could not connect FPTs without extension OpenSSL',
                    $this->host));
            } else {
                $this->ftpStream = ftp_ssl_connect($this->host, $this->port,
                    $this->timeout);
            }
        }

        if (!$this->ftpStream) {
            throw new FileStorageException(_sprintf('Unable to connect to "{0}"',
                [$this->host]));
        }

        // there no username password
        if (null === $this->username) {
            return $this->ftpStream;
        }

        $return = @ftp_login($this->ftpStream, $this->username,
            $this->password);

        if (!$return) {
            throw new FileStorageException(_sprintf('Login FTP failed {0}:{1}.',
                [$this->username, $this->password]));
        }

        return $this->ftpStream;
    }

    /**
     * @throws FileStorageException
     * @ignore
     */
    public function disconnect()
    {
        if (null !== $this->ftpStream) {
            try {
                @ftp_close($this->ftpStream);
            } catch (\Exception $ex) {
                throw new FileStorageException($ex->getMessage());
            }
            $this->ftpStream = null;
        }
    }

    function putObject($data, $name)
    {
        $path = $this->mapPath($name);


        // Create stack buffer
        $existed = in_array('stack', stream_get_wrappers());

        if ($existed) {
            stream_wrapper_unregister('stack');
        }

        $handle = tmpfile();

        if (!$handle) {
            throw new FileStorageException(sprintf('Unable to create stack buffer'));
        }

        // Write into stack
        $len = 0;
        do {
            $tmp = @fwrite($handle, substr($data, $len));
            $len += $tmp;
        } while (strlen($data) > $len && $tmp != 0);

        // Get mode
        $this->connect();

        // Non-blocking mode
        if (@function_exists('ftp_nb_fput')) {
            $res = @ftp_nb_fput($this->ftpStream, $path, $handle, FTP_TEXT);
            while ($res == FTP_MOREDATA) {
//                $this->_announce('nb_get');
                $res = @ftp_nb_continue($this->ftpStream);
            }
            $return = ($res === FTP_FINISHED);
        } // Blocking mode
        else {
            $return = @ftp_fput($this->ftpStream, $path, $handle, FTP_TEXT);
        }

        fclose($handle);

        if (!$return) {
            throw new FileStorageException(sprintf('Unable to put contents to "%s"',
                $path));
        }

        // Set umask permission
        try {
            @ftp_chmod($this->ftpStream, $this->filePermission, $path);
        } catch (\Exception $e) {
            // Silence
        }

        $this->disconnect();

        return true;
    }

    public function getFile($local, $name)
    {
        $path = $this->mapPath($name);

        $this->connect();

        // Non-blocking mode
        if (@function_exists('ftp_nb_get')) {
            $res = @ftp_nb_get($this->ftpStream, $local, $path, FTP_BINARY);
            while ($res == FTP_MOREDATA) {
                $res = @ftp_nb_continue($this->ftpStream);
            }
            $return = ($res === FTP_FINISHED);
        } else {
            $return = @ftp_get($this->ftpStream, $local, $path, FTP_BINARY);
        }

        if (!$return) {
            throw new FileStorageException(sprintf('Unable to get "%s" -> "%s"',
                $name, $local));
        }

        return true;
    }

    public function putFile($local, $name)
    {
        $path = $this->mapPath($name);

        // Make sure parent exists
        if (!$this->ensure(dirname($path))) {
            throw new FileStorageException(sprintf('Can not create directory %s',
                dirname($path)));
        }

        // Get mode
        $this->connect();

        // Non-blocking mode
        if (@function_exists('ftp_nb_put')) {
            $res = @ftp_nb_put($this->ftpStream, $path, $local, FTP_BINARY);
            while ($res == FTP_MOREDATA) {
//                $this->_announce('nb_put');
                $res = @ftp_nb_continue($this->ftpStream);
            }
            $return = ($res === FTP_FINISHED);
        } // Blocking mode
        else {
            $return = @ftp_put($this->ftpStream, $path, $local, FTP_BINARY);
        }

        if (!$return) {
            throw new FileStorageException(sprintf('Unable to put "%s" to "%s"',
                $path, $local));
        }

        @ftp_chmod($this->ftpStream, $this->filePermission, $path);

        $this->disconnect();

        return true;
    }

    private function ensure($path)
    {
        $dir = explode("/", $path);
        $path = '';
        $this->connect();

        for ($i = 0; $i < count($dir); $i++) {
            $path .= '/' . $dir[$i];
            if (!@ftp_chdir($this->ftpStream, $path)) {
                @ftp_chdir($this->ftpStream, '/');
                if (!@ftp_mkdir($this->ftpStream, $path)) {
                    return false;
                }
            }
        }

        return true;
    }

    public function deleteFile($name)
    {
        $path = $this->mapPath($name);
        $this->connect();

        $return = @ftp_delete($this->ftpStream, $path);

        if (!$return) {
            \Phpfox::get('dev.log')
                ->debug('Oops! {1} Unable to delete "{0}"', [$path, __CLASS__]);
        }

        return true;
    }

    public function release()
    {
        $this->disconnect();
    }

    /**
     * @ignore
     */
    public function __destruct()
    {
        $this->disconnect();
    }

    /**
     * @ignore
     * @return array
     */
    public function __sleep()
    {
        $this->disconnect();
        return [
            'basePath',
            'baseUrl',
            'baseCdn',
            'host',
            'port',
            'timeout',
            'username',
            'password',
            'isFtps',
        ];
    }
}