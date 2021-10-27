<?php


namespace App;


class Error
{
    static public function show(string $error)
    {
        exit($error);
    }
}