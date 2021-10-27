<?php


namespace App;


class Module
{
    private $module;
    private $params;

    /**
     * Module constructor.
     * @param string $module
     * @param array $params
     */
    public function __construct( string $module, array $params = [])
    {
        $this->setModule($module);

        foreach ($params as $i => $p)
        {
            $this->addParam($p[0],$p[1]);
        }
    }

    /**
     * @param string $param
     * @param string $value
     */
    public function addParam(string $param, string $value)
    {
        if(isset($this->params))
        {
            foreach ($this->params as $i => $p)
            {
                if($p[0] == $param)
                {
                    $this->params[$i] = [$param, $value];
                    return;
                }
            }
        }
        $this->params[] =  [$param, $value];
    }

    /**
     * @param string $module
     */
    private function setModule(string $module)
    {
        $this->module = $module;
    }

    /**
     * @return string
     */
    public function getModule() : string
    {
        return $this->module;
    }

    /**
     * @return mixed
     */
    public function getParam(string $param)
    {
        if($this->params)
        {
            foreach ($this->params as $i => $p)
            {
                if($p[0] == $param)
                {
                    return $p[1];
                }
            }
        }
        return false;
    }
}