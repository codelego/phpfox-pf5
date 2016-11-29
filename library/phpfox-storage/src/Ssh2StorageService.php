<?php
namespace Phpfox\Storage;


class Ssh2StorageService implements StorageServiceInterface
{
    use StorageServiceTrait;

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
        $path = $this->getPath($name);

        $content = file_get_contents('ssh2.sftp://' . $this->getFtpStream()
            . $path);

        if (!$content) {
            throw new StorageServiceException(sprintf('Unable to get contents of "%s"',
                $path));
        }

        return $content;
    }

    public function putObject($data, $name)
    {
        $path = $this->getPath($name);

        $return = file_put_contents('ssh2.sftp://' . $this->getFtpStream()
            . $path, $data);

        try {
            $this->command(sprintf('chmod -R  %o %s', 0666,
                escapeshellarg($path)));
        } catch (\Exception $e) {
            // Silence
        }

        if (!$return) {
            throw new StorageServiceException(sprintf('Unable to put contents to "%s"',
                $path));
        }

        return true;
    }

    public function getFile($local, $name)
    {
        $path = $this->getPath($name);
        $this->connect();

        $return = @ssh2_scp_recv($this->sshStream, $path, $local);

        // Error
        if (!$return) {
            throw new StorageServiceException(sprintf('Unable to get "%s" to "%s"',
                $path, $local));
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function putFile($local, $name)
    {
        $path = $this->getPath($name);
        $directory = dirname($path);


        $isDir = is_dir('ssh2.sftp://' . $this->getFtpStream() . $directory);

        $this->connect();

        if (!$isDir) {

            if (!@ssh2_sftp_mkdir($this->getFtpStream(), $directory,
                $this->directoryPermission, true)
            ) {
                throw new StorageServiceException(sprintf('Unable to make directory "%s"',
                    $directory));
            }
        }

        $return = @ssh2_scp_send($this->sshStream, $local, $path,
            $this->filePermission);

        if (!$return) {
            throw new StorageServiceException(sprintf('Unable to put "%s" to "%s"',
                $local, $path));
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteFile($name)
    {
        $path = $this->getPath($name);

        $return = @ssh2_sftp_unlink($this->getFtpStream(), $path);

        if (!$return) {
            throw new StorageServiceException(sprintf('Unable to unlink "%s"',
                $path));
        }

        return true;
    }

    /**
     * @return \resource
     * @throws  StorageServiceException
     */
    private function connect()
    {
        if ($this->sshStream) {
            return $this->sshStream;
        }

        $return = null;
        $publicKey = $this->publicKey;
        $privateKey = $this->privateKey;
        $hostKey = $this->hostKey;

        // Connect with keys
        if (($publicKey && $privateKey && $hostKey)) {
            $this->sshStream = @ssh2_connect($this->host, $this->port, [
                'hostkey' => $hostKey,
            ], [
                'disconnect' => [$this, 'onDisconnect'],
            ]);
        } // Connect without keys
        else {
            $this->sshStream = @ssh2_connect($this->host, $this->port, [], [
                'disconnect' => [$this, 'onDisconnect'],
            ]);
        }

        if (!$this->sshStream) {
            throw new StorageServiceException(sprintf('Unable to connect to "%s"',
                $this->host));
        }


        // Auth using keys
        if ($publicKey && $privateKey && $hostKey) {
            $return = @ssh2_auth_pubkey_file($this->sshStream,
                $this->getUsername(), $publicKey, $privateKey,
                $this->getPassword());
        } // Auth using username/password only
        else {
            if ($this->getUsername() && $this->getPassword()) {
                $return = @ssh2_auth_password($this->sshStream,
                    $this->getUsername(), $this->getPassword());
            } // Auth using none
            else {
                $return = @ssh2_auth_none($this->sshStream,
                    $this->getUsername());
            }
        }

        // Failure
        if (!$return) {
            throw new StorageServiceException('Login failed.');
        }


        return $this->sshStream;
    }

    public function disconnect()
    {
        if (null !== $this->sshStream) {
            $this->command('exit');
            $this->sshStream = null;
        }
    }

    /**
     * @throws StorageServiceException
     */
    public function onDisconnect()
    {
        throw new StorageServiceException('Disconnected from server');
    }

    /**
     * @param $command
     *
     * @return string
     * @throws StorageServiceException
     */
    private function command($command)
    {
        $this->connect();

        $stream = @ssh2_exec($this->sshStream, $command);

        if (!$stream) {
            throw new StorageServiceException(sprintf('Unable to execute command "%s"',
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

    /**
     * @return \resource
     * @throws StorageServiceException
     */
    private function getFtpStream()
    {
        if (null === $this->ftpStream) {
            $this->connect();
            $this->ftpStream = @ssh2_sftp($this->sshStream);
            if (null === $this->ftpStream) {
                throw new StorageServiceException('Unable to get sftp resource');
            }
        }

        return $this->ftpStream;
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
            'username',
            'password',
            'timeout',
            'publicKey',
            'privateKey',
            'hostKey',
        ];
    }
}