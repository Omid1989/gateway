<?php

namespace Larabookir\Gateway;

interface InterfaceGatewayConfig
{
    /**
     * @param $arg
     * @return mixed
     */
    public function has($arg);

    /**
     * @param $arg
     * @return mixed
     */
    public function get($arg);

    /**
     * @param $config
     * @param $name
     */
    public function SetConfig($config, $name);
}
