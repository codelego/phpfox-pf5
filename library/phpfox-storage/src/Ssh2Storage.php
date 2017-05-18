<?php

namespace Phpfox\Storage;


class Ssh2Storage implements StorageInterface
{
    use FileStorageTrait;

    /**
     * @var int
     */
    private $port = 22;

    /**
     * @var string
     */
    private $publicKey;

    /**
     * @var string
     */
    private $privateKey;

    /**
     * @var string
     */
    private $hostKey;

    /**
     * @var string
     */
    private $host = 'localhost';

    /**
     * @var int
     */
    private $timeout = 20;

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
    private $sshStream;

    /**
     * @var \resource
     */
    private $ftpStream;

    /**
     * Ssh2FileStorage constructor.
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
     * - publicKey: string, optional
     * - hostKey: string, optional
     *
     * Usage method
     * - ssh2_connect
     * - ssh2_auth_none
     * - ssh2_auth_pubkey_file
     *
     * @see
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

        if (isset($params['password'])) {
            $this->password = $params['password'];
        }

        if (isset($params['username'])) {
            $this->username = $params['username'];
        }

        if (!empty($params['port'])) {
            $this->port = (int)$params['port'];
        }

        if (!empty($params['host'])) {
            $this->host = $params['host'];
        }

        if (!empty($params['publicKey'])) {
            $this->publicKey = $params['publicKey'];
        }

        if (!empty($params['hostKey'])) {
            $this->hostKey = $params['hostKey'];
        }
    }


    public function getObject($name)
    {
        $path = $this->mapPath($name);

        $content = file_get_contents('ssh2.sftp://' . $this->getFtpStream()
            . $path);

        if (!$content) {
            throw new FileStorageException(sprintf('Unable to get contents of "%s"',
                $path));
        }

        return $content;
    }

    /**
     * @return \resource
     * @throws FileStorageException
     */
    private function getFtpStream()
    {
        if (null === $this->ftpStream) {
            $this->connect();
            $this->ftpStream = @ssh2_sftp($this->sshStream);
            if (null === $this->ftpStream) {
                throw new FileStorageException('Unable to get sftp resource');
            }
        }

        return $this->ftpStream;
    }

    /**
     * @throws  FileStorageException
     */
    private function connect()
    {
        if ($this->sshStream) {
            return;
        }

        $authResult = null;


        if (!function_exists('ssh2_connect')) {
            throw new \InvalidArgumentException(_sprintf('"libssh2" extension required by {0}.',
                [__CLASS__]));
        }
        if (($this->publicKey and $this->privateKey and $this->hostKey)) {

            $this->sshStream = @ssh2_connect($this->host, $this->port, [
                'hostkey' => $this->hostKey,
            ], [
                'disconnect' => [$this, 'onDisconnect'],
            ]);
        } else {
            $this->sshStream = @ssh2_connect($this->host, $this->port, [], [
                'disconnect' => [$this, 'onDisconnect'],
            ]);
        }


        if (!$this->sshStream) {
            throw new FileStorageException(sprintf('Unable to connect to "%s"',
                $this->host));
        }


        // Auth using keys
        if ($this->publicKey && $this->privateKey && $this->hostKey) {
            $authResult = @ssh2_auth_pubkey_file($this->sshStream,
                $this->username, $this->publicKey, $this->privateKey,
                $this->password);
        } elseif ($this->username && $this->password) {
            $authResult = @ssh2_auth_password($this->sshStream, $this->username,
                $this->password);
        } else {
            $authResult = @ssh2_auth_none($this->sshStream, $this->username);
        }

        if (!$authResult) {
            throw new FileStorageException('Can not connect storage system');
        }
    }

    public function putObject($data, $name)
    {
        $path = $this->mapPath($name);

        $return = file_put_contents('ssh2.sftp://' . $this->getFtpStream()
            . $path, $data);

        try {
            $this->command(sprintf('chmod -R  %o %s', 0666,
                escapeshellarg($path)));
        } catch (\Exception $e) {
            // Silence
        }

        if (!$return) {
            throw new FileStorageException(sprintf('Unable to put contents to "%s"',
                $path));
        }

        return true;
    }

    /**
     * @param string $command
     *
     * @return string
     * @throws FileStorageException
     */
    private function command($command)
    {
        $this->connect();

        $stream = @ssh2_exec($this->sshStream, $command);

        if (!$stream) {
            throw new FileStorageException(sprintf('Unable to execute command "%s"',
                $command));
        }
        $errorStream = @ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);

        stream_set_blocking($stream, true);
        stream_set_timeout($stream, $this->timeout);
        if ($errorStream) {
            stream_set_blocking($errorStream, true);
            stream_set_timeout($errorStream, $this->timeout);
        }

        $data = stream_get_contents($stream);
        if ($errorStream) {
            stream_get_contents($errorStream);
        }

        fclose($stream);
        if ($errorStream) {
            fclose($errorStream);
        }

        return trim($data);
    }

    public function getFile($local, $name)
    {
        $path = $this->mapPath($name);
        $this->connect();

        $return = @ssh2_scp_recv($this->sshStream, $path, $local);

        if (!$return) {
            throw new FileStorageException(sprintf('Unable to get "%s" to "%s"',
                $path, $local));
        }

        return true;
    }

    public function putFile($local, $name)
    {
        $path = $this->mapPath($name);
        $directory = dirname($path);
        $this->connect();

        $isDir = is_dir('ssh2.sftp://' . $this->getFtpStream() . $directory);

        if (!$isDir) {

            if (!@ssh2_sftp_mkdir($this->getFtpStream(), $directory,
                $this->directoryPermission, true)
            ) {
                throw new FileStorageException(sprintf('Unable to make directory "%s"',
                    $directory));
            }
        }

        $return = @ssh2_scp_send($this->sshStream, $local, $path,
            $this->filePermission);

        echo $local, '->', $path;

        if (!$return) {
            throw new FileStorageException(sprintf('Unable to put "%s" to "%s"',
                $local, $path));
        }

        return true;
    }

    public function deleteFile($name)
    {
        $path = $this->mapPath($name);

        $return = @ssh2_sftp_unlink($this->getFtpStream(), $path);

        if (!$return) {
            throw new FileStorageException(sprintf('Unable to unlink "%s"',
                $path));
        }

        return true;
    }

    /**
     * @throws FileStorageException
     */
    public function onDisconnect()
    {
        throw new FileStorageException('Disconnected from server');
    }

    public function __destruct()
    {
        $this->release();
    }

    public function release()
    {
        if (null !== $this->sshStream) {
            $this->command('exit');
            $this->sshStream = null;
        }
    }

    public function __sleep()
    {
        $this->release();

        return [
            'basePath',
            'baseUrl',
            'baseCdn',
            'host',
            'port',
            'username',
            'password',
            'timeout',
            'publicKey',
            'privateKey',
            'hostKey',
        ];
    }
}