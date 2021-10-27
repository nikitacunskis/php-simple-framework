<?php


namespace App;


class LanguageHardConfig implements ConfigInterface
{
    private $lang;

    public function __construct()
    {
        $this->load();
    }

    protected function load()
    {
        require('App/config/lang.php');
        $this->lang = $lang;
    }



}