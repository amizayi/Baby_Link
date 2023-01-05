<?php

namespace App\Http\Services\Rezix_FTP;


class FTPService
{
    protected $connectionId;

    public function __construct($config)
    {
        $this->connectionId = $this->connect($config);
    }

    public function __destruct()
    {
        $this->disconnect($this->connectionId);
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

    public function disconnect($connectionId)
    {
        ftp_close($connectionId);
    }

    public function mkdir($directory)
    {
        return ftp_chdir($this->connectionId, 'test');
        try {
            if (ftp_mkdir($this->connectionId, $directory))
                return true;
            else
                return false;
        } catch (\Exception $e) {
            return false;
        }
    }
 

}
