<?php
/**
 * $head = [
'title' => 'Site Name',
'charset' =>  'UTF-8',
'keywords' => '',
'description' => '',
'author' => 'Nikita Cunskis',
'refresh' => '',
'viewport' => '',
];
 */

namespace App;


class Header
{
    private $title;
    private $charset;
    private $keywords;
    private $description;
    private $author;
    private $refresh;
    private $viewport;
    private $styles;
    private $scripts;

    public function __construct( array $headConfig )
    {
        if($headConfig['title']) $this->setTitle($headConfig['title']);
        if($headConfig['charset']) $this->setCharset($headConfig['charset']);
        if($headConfig['keywords']) $this->setDescription($headConfig['keywords']);
        if($headConfig['author']) $this->setAuthor($headConfig['author']);
        if($headConfig['refresh']) $this->setRefresh($headConfig['refresh']);
        if($headConfig['viewport']) $this->setViewport($headConfig['viewport']);
    }

    /**
     * @param string $style
     * @param bool $local
     */
    public function addStyle( string $style, bool $local = false )
    {
        $this->styles[] = [
            "style" => $style,
            "local" => $local
        ];
    }
    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }
    /**
     * @param mixed $charset
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;
    }
    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    /**
     * @param mixed $keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }
    /**
     * @param mixed $refresh
     */
    public function setRefresh($refresh)
    {
        $this->refresh = $refresh;
    }
    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    /**
     * @param mixed $viewport
     */
    public function setViewport($viewport)
    {
        $this->viewport = $viewport;
    }
    /**
     * @return mixed
     */
    public function getAuthor()
    {

        return isset($this->author) ? $this->author : false;
    }
    /**
     * @return mixed
     */
    public function getCharset()
    {
        return isset($this->charset) ? $this->charset : false;
    }
    /**
     * @return mixed
     */
    public function getDescription()
    {
        return isset($this->description) ? $this->description : false;
    }
    /**
     * @return mixed
     */
    public function getKeywords()
    {
        return isset($this->keywords) ? $this->keywords : false;
    }
    /**
     * @return mixed
     */
    public function getRefresh()
    {
        return isset($this->refresh) ? $this->refresh : false;
    }
    /**
     * @return mixed
     */
    public function getTitle()
    {
        return isset($this->title) ? $this->title : false;
    }
    /**
     * @return mixed
     */
    public function getViewport()
    {
        return isset($this->viewport) ? $this->viewport : false;
    }
    /**
     * @return array
     */
    public function getStyle()
    {
        return isset($this->styles) ? $this->styles : false;
    }

    public function fetch()
    {
        $head = [];
        if($this->getTitle())
        {
            $head['title'] = new Template('engine/head/title');
            $head['title']->assign('TITLE', $this->getTitle());
        }
        if($this->getCharset())
        {
            $head['charset'] = new Template('engine/head/charset');
            $head['charset']->assign('CHARSET', $this->getCharset());
        }
        if($this->getKeywords())
        {
            $head['keywords'] = new Template('engine/head/keywords');
            $head['keywords']->assign("KEYWORDS", $this->getKeywords());
        }
        if($this->getDescription())
        {
            $head['description'] = new Template('engine/head/description');
            $head['description']->assign("DESCRIPTION", $this->getDescription());
        }
        if($this->getAuthor())
        {
            $head['author'] = new Template('engine/head/author');
            $head['author']->assign("AUTHOR", $this->getAuthor());
        }
        if($this->getRefresh())
        {
            $head['refresh'] = new Template('engine/head/refresh');
            $head['refresh']->assign('REFRESH', $this->getRefresh());
        }
        if($this->getViewport())
        {
            $head['viewport'] = new Template('engine/head/viewport');
            $head['viewport']->assign('VIEWPORT', $this->getViewport());
        }
        if($this->getStyle())
        {

            $head['style'] = new Template('engine/head/style');
            foreach ($this->getStyle() as $i => $style)
            {
                $styleElement = new Template('engine/head/style-element');
                $styleValue = $style["local"] ? '/assets/css/' . $style["style"] : $style['style'];
                $styleElement->assign('STYLE', $styleValue);
                $head['style']->assign('ENGINE_STYLE', $styleElement->fetch(), false);
            }
        }

        $fetch = '';
        foreach ($head as $i => $h)
        {
            $fetch .= $h->fetch();
        }
        return $fetch;
    }
}