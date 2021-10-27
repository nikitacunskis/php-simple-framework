<?php


namespace App;


class MenuElement
{
    private $link;
    private $icon;
    private $text;

    public function __construct( array $menuElement )
    {
        $this->setIcon($menuElement['icon']);
        $this->setLink($menuElement['link']);
        $this->setText($menuElement['text']);
    }

    /**
     * @param mixed $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }
}