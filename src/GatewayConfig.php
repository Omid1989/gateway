<?php


namespace Larabookir\Gateway;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

use Larabookir\Gateway\Models\PortInfo;


class GatewayConfig implements InterfaceGatewayConfig
{

    private  $config;

    public function __construct()
    {

        if(PortInfo::first()!=null){
            $this->config= collect(json_decode(PortInfo::first()->pluck('info')[0]));
        }else{
            $this->config=collect(json_decode('
              {
              "gateway":
                {
                 "timezone":"Asia\/Tehran",
                 "table":"gateway_transactions"
                }
               }'));


        }

    }

    /**
     * @param $arg
     * @return mixed
     */
    public  function  has($arg)
    {
        return $this->pluck($arg);
    }

    /**
     * @param $arg
     * @return mixed
     */
    public function get($arg)
    {
       return $this->pluck($arg);
    }

    /**
     * @param $arg
     * @return mixed
     */
    private function pluck($arg)
    {
        return $this->config->pluck(str_replace('gateway.','',$arg))[0];
    }

    /**
     * @param $config
     * @param $name
     */
    public  function SetConfig($config, $name)
    {

        if(gettype($config)=='string')
        {
            $raplace=$config;
        }
        else
        {
            $raplace=(object)$config;
        }

        $configarray=$this->config->toArray();
        $configarray['gateway']->{$name}=$raplace;
        $this->config=collect($configarray);

        if(PortInfo::first()==null)
        {
           $port=new PortInfo();
           $port->info=$this->config;
           $port->save();
        }else{

//            $port=PortInfo::find(0);
//            $port->update(['info'=>$this->config]);
//
            PortInfo::where('id',0)->update(['info'=>$this->config]);
        }


    }



}
