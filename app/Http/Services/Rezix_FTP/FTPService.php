<?php

namespace App\Http\Services\Rezix_FTP;

use Illuminate\Support\Facades\Storage;

class FTPService
{
    protected $connectionId;
    protected $storage;

    public function __construct($config)
    {
        $this->connectionId = $this->connect($config); 
        $this->storage = $this->createFtpDriver($config);
    }

    public function connect($config)
    {
        if (!isset($config['port'])) $config['port'] = 21;
        if (!isset($config['timeout'])) $config['timeout'] = 90;
        if (!isset($config['secure'])) $config['secure'] = false;

        if ($config['secure']) {
            $connectionId = ftp_ssl_connect($config['host'], $config['port'], $config['timeout']);
        } else {
            $connectionId = ftp_connect($config['host'], $config['port'], $config['timeout']);
        }

        if ($connectionId) {
            $loginResponse = ftp_login($connectionId, $config['username'], $config['password']);
            ftp_pasv($connectionId, $config['passive']);
        }

        if ((!$connectionId) || (!$loginResponse))
            throw new \Exception('FTP connection has failed!');

        return $connectionId;
    }

    public function createFtpDriver($config)
    {
        $result = Storage::createFtpDriver(['host' => $config['host'], 'username' => $config['username'], 'password' => $config['password'], 'port' => (int)$config['port']]);
        return $result;
    }

    public function __destruct()
    {
        $this->disconnect($this->connectionId);
    }

    public function disconnect($connectionId)
    {
        ftp_close($connectionId);
    }

    public function mkdir($directory)
    {
        try {
            if (ftp_mkdir($this->connectionId, $directory))
                return true;
            else
                return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function uploadFile($file, $path)
    {  
        try {
            if ($this->storage->put($path, file_get_contents($file->path())))
                return true;
            else
                return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function size($remoteFile)
    {
        try {
            return ftp_size($this->connectionId, $remoteFile);
        } catch (\Exception $e) {
            return false;
        }
    }
}
