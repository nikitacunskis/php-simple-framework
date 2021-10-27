<?php


namespace App;


class Language
{
    private $short;
    private $full;


    public function __construct(array $lang)
    {
        $this->setFull($lang[0]);
        $this->setShort($lang[1]);
        if(isset($lang[2]))
        {
            if($lang[2] == 'default')
            {
                $this->setDefault(true);
            }
        }
    }

    /**
     * @param mixed $full
     */
    public function setFull($full)
    {
        $this->full = $full;
    }

    /**
     * @param mixed $short
     */
    public function setShort($short)
    {
        $this->short = $short;
    }

    /**
     * @return mixed
     */
    public function getFull()
    {
        return $this->full;
    }

    /**
     * @return mixed
     */
    public function getShort()
    {
        return $this->short;
    }

    /**
     * @param bool $default
     */
    public function setDefault( bool $default)
    {
        $this->default = $default;
    }

    /**
     * @return bool
     */
    public function isDefault()
    {
        return $this->default;
    }
}