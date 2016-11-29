<?php
namespace Phpfox\Storage;


class FtpStorageService implements StorageServiceInterface
{
    use StorageServiceTrait;

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
    private $timeout = 20;

    /**
     * @var bool
     */
    private $isFtps = 0;

    /**
     * @var string
     */
    private $username = '';

    /**
     * @var string
     */
    private $password = '';

    /**
     * @var \resource
     */
    private $ftpStream;

    /**
     * @inheritdoc
     */
    public function __construct($params)
    {

        if (isset($params['basePath'])) {
            $this->basePath = $params['basePath'];
        }

        if (isset($params['baseUrl'])) {
            $this->baseUrl = $params['baseUrl'];
        }

        if (isset($params['baseCdn'])) {
            $this->basePath = $params['baseCdn'];
        }

        if (null == $this->baseUrl) {
            $this->baseUrl = PHPFOX_BASE_URL;
        }

        if (null == $this->basePath) {
            $this->basePath = PHPFOX_BASE_DIR;
        }

        if (null == $this->baseCdn) {
            $this->baseCdn = PHPFOX_BASE_URL;
        }

        $this->basePath = rtrim($this->basePath, '/') . '/';
        $this->baseUrl = rtrim($this->baseUrl, '/') . '/';
        $this->baseCdn = rtrim($this->baseCdn, '/') . '/';


        if (!empty($params['timeout'])) {
            $this->timeout = (int)$params['timeout'];
        }

        if (!empty($params['username'])) {
            $this->username = (int)$params['username'];
        }

        if (!empty($params['password'])) {
            $this->password = (int)$params['password'];
        }

        if (!empty($params['host'])) {
            $this->host = (int)$params['host'];
        }

        if (!empty($params['port'])) {
            $this->port = (int)$params['port'];
        }

        if (!empty($params['protocol'])) {
            $this->isFtps = (strtolower($params['protocol']) == 'ftps') ? 1 : 0;
        }
    }

    /**
     * @inheritdoc
     */
    public function getObject($name)
    {
        $path = $this->getPath($name);

        $handle = tmpfile();

        if (!$handle) {
            throw new StorageServiceException('Can not open stream to buffer data');
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
            throw new StorageServiceException(sprintf('Unable to get contents of "%s"',
                $path));
        }

        $data = '';
        fseek($handle, 0); // seek to bebin of file.
        while (false != ($line = fread($handle, 1024))) {
            $data .= $line;
        }
        fclose($handle);
        $this->disconnect();

        return $data;
    }

    /**
     * @inheritdoc
     */
    function putObject($data, $name)
    {
        $path = $this->getPath($name);

        // Create stack buffer
        $existed = in_array('stack', stream_get_wrappers());
        if ($existed) {
            stream_wrapper_unregister('stack');
        }

        $handle = tmpfile();

        if (!$handle) {
            throw new StorageServiceException(sprintf('Unable to create stack buffer'));
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
            $res = @ftp_nb_fput($this->ftpStream, $path, $handle, FTP_BINARY);
            while ($res == FTP_MOREDATA) {
                //$this->_announce('nb_get');
                $res = @ftp_nb_continue($this->ftpStream);
            }
            $return = ($res === FTP_FINISHED);
        } // Blocking mode
        else {
            $return = @ftp_fput($this->ftpStream, $path, $handle, FTP_BINARY);
        }

        fclose($handle);

        if (!$return) {
            throw new StorageServiceException(sprintf('Unable to put contents to "%s"',
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

    /**
     * @inheritdoc
     */
    public function getFile($local, $name)
    {
        $path = $this->getPath($name);

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
            throw new StorageServiceException(sprintf('Unable to get "%s" -> "%s"',
                $name, $local));
        }

        return true;
    }

    public function putFile($local, $name)
    {
        $path = $this->getPath($name);

        // Make sure parent exists
        if (!$this->ensure(dirname($path))) {
            throw new StorageServiceException(sprintf('Can not create directory %s',
                dirname($path)));
        }

        // Get mode
        $this->connect();

        // Non-blocking mode
        if (@function_exists('ftp_nb_put')) {
            $res = @ftp_nb_put($this->ftpStream, $path, $local, FTP_BINARY);
            while ($res == FTP_MOREDATA) {
                //$this->_announce('nb_put');
                $res = @ftp_nb_continue($this->ftpStream);
            }
            $return = ($res === FTP_FINISHED);
        } // Blocking mode
        else {
            $return = @ftp_put($this->ftpStream, $path, $local, FTP_BINARY);
        }

        if (!$return) {
            throw new StorageServiceException(sprintf('Unable to put "%s" to "%s"',
                $path, $local));
        }

        @ftp_chmod($this->ftpStream, $this->filePermission, $path);

        $this->disconnect();

        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteFile($name)
    {
        $path = $this->getPath($name);
        $this->connect();

        $return = @ftp_delete($this->ftpStream, $path);

        if (!$return) {
//            throw new StorageServiceException(sprintf('Unable to delete "%s"', $path));
        }

        return true;
    }

    /**
     * @return \resource
     * @throws StorageServiceException
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
                throw new StorageServiceException(sprintf('Unexepected configuration, Coul not connect FPTS without extension OpenSSL',
                    $this->host));
            } else {
                $this->ftpStream = ftp_ssl_connect($this->host, $this->port,
                    $this->timeout);
            }
        }

        if (!$this->ftpStream) {
            throw new StorageServiceException(sprintf('Unable to connect to "%s"',
                $this->host));
        }

        // there no username password
        if (null === $this->username) {
            return $this->ftpStream;
        }

        $return = @ftp_login($this->ftpStream, $this->username,
            $this->password);

        if (!$return) {
            throw new StorageServiceException('Login FTP failed.');
        }

        return $this->ftpStream;
    }

    /**
     * disconnect ftp server
     */
    public function disconnect()
    {
        if (null !== $this->ftpStream) {
            try {
                @ftp_close($this->ftpStream);
            } catch (\Exception $ex) {
                throw new StorageServiceException($ex->getMessage());
            }
            $this->ftpStream = null;
        }
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

    public function __destruct()
    {
        $this->disconnect();
    }

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