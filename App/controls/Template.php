<?php

namespace App;

class Template
{
    private $src;
    private $vars;

    function __construct( string $src ) {
        $this->src = 'App/templates/' . $src . '.html';
        $this->vars = [];
    }

    /**
     * assign variable
     * @param string $varName - Variable name
     * @param mixed $varValue - Variable value
     * @param bool $replace - replace data or add assign. True if new variable;
     */
    function assign( string $varName, $varValue, bool $replace = true)
    {
        if ($replace) {
            foreach ($this->vars as $i => $var) {
                if ($var['var'] == $varName) {
                    $this->vars[$i] = $varValue;
                    return;
                }
            }
        }

        foreach ($this->vars as $i => $var) {
            if ($var['var'] == $varName) {
                $this->vars[$i]['value'] .= $varValue;
                return;
            }
        }
        $this->vars[] = ['var' => $varName, 'value' => $varValue];

    }
    /**
     * parses data inside HTML file and print file
     */
    function parse() {
        $html = file_get_contents($this->src);

        foreach($this->vars as $var) {
            $html = preg_replace('/{' . $var["var"] . '}/', $var["value"], $html);
        }
        echo $html;
    }

    /**
     * parse data inside HTML file and returns HTML as string variable
     * @return string HTML
     */
    function fetch() {
        $html = file_get_contents($this->src);
        foreach ($this->vars as $var) {
            $html = preg_replace('/{' . $var["var"] . '}/', $var["value"], $html);
        }
        return $html;
    }

    function isAssigned(string $varName) {
        foreach ($this->vars as $i => $var) {
            if($var["var"] == $varName) return true;
        }
        return false;
    }

}