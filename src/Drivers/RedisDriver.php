<?php

namespace Feather\Session\Drivers;

/**
 * Description of RedisDriver
 *
 * @author fcarbah
 */
class RedisDriver extends Driver
{

    protected $path;

    public function __construct($server, $port = '6379', $scheme = 'tcp', array $connOptions = array())
    {

        $savePath = $scheme . '://' . $server . ':' . $port;

        $optStr = '';
        foreach ($connOptions as $key => $val) {
            $optStr .= "$key=$val&";
        }

        $this->path = $savePath . '?' . substr($optStr, 0, strlen($optStr) - 1);
    }

    public function activate()
    {
        ini_set('session.save_handler', 'redis');
        session_save_path($this->path);
    }

}
