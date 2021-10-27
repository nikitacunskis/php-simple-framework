<?php


namespace App;

class Router implements PathInterface
{
    private $requestUri;
    private $lang;
    private $module;
    public function __construct( string $requestUri)
    {
        $this->setRequestUri($requestUri);
        $route = explode('/', $requestUri);
        if($route[sizeof($route) - 1] == "")
        {
            unset($route[sizeof($route) - 1]);
        }

        require ('App/config/lang.php');
//        var_dump($route); die;
        if(sizeof($route) == 1)
        {
            $route[1] = ''; //it's homepage
        }

        $langIsset = false;
        foreach ($lang as $l)
        {
            if($l[1] == $route[1])
            {
                $this->setLang(new Language($l));
                $langIsset = true;
                break;
            }
            if(isset($l[2]))
            {
                $defaultLang = new Language($l);
            }
        }
        if(!$langIsset)
        {

            if(isset($defaultLang))
            {
                $this->setLang($defaultLang);
            }
            else
            {
                Error::show("No default Lagnuage set!");
            }

            $params = [];

            $n = 0;


            for($i = 2; $i < sizeof($route); $i++)
            {

                if($i%2 == 0)
                    $params[$n][0] = $route[$i];
                if($i%2 != 0)
                {
                    $params[$n][1] = $route[$i];
                    $n++;
                }
            }

            $this->setModule( new Module($route[1], $params));
        }
        else
        {
            if(sizeof($route) == 2)
            {
                $route[2] = ''; // home page
            }

            $params = [];

            $n = 0;
            for($i = 3; $i < sizeof($route); $i++)
            {

                if($i%2 != 0)
                    $params[$n][0] = $route[$i];
                if($i%2 == 0)
                {
                    $params[$n][1] = $route[$i];
                    $n++;
                }
            }

            $this->setModule( new Module($route[2], $params));
        }
    }


    /**
     * @param mixed $requestUri
     */
    public function setRequestUri($requestUri)
    {
        $this->requestUri = $requestUri;
    }

    /**
     * @return mixed
     */
    public function getRequestUri()
    {
        return $this->requestUri;
    }
    /**
     * @param Language $lang
     */
    private function setLang(Language $lang)
    {
        $this->lang = $lang;
    }

    /**
     * @return Language
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param Module $module
     */
    private function setModule(Module $module)
    {
        $this->module = $module;
    }

    /**
     * @return Module
     */
    public function getModule() : Module
    {
        return $this->module;
    }

    public function getPath()
    {
        require("App/config/route.php");
        foreach ($routeExceptions as $re)
        {
            if($this->getModule()->getModule() == $re)
            {
                require($this->getRequestUri());
                exit;
            }
        }
        foreach ($route as $i => $r)
        {
            if($r['route'] == $this->getModule()->getModule())
            {
                return 'App/modules/' . $r['module'] . '/' . $r['file'];
            }
        }
        return 'App/modules/404/index.php';
    }
}