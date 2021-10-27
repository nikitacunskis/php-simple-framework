<?php
require 'vendor/autoload.php';

$router = new \App\Router($_SERVER['REQUEST_URI']);
$document = new \App\Template('engine/main');

/**
 * Header and styles attachment
 */
require ('App/config/default_head.php');
$header = new \App\Header($_head);
$header->addStyle('style.css', true);
$header->addStyle('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
$document->assign("HEAD", $header->fetch());


require ($router->getPath());

/**
 * Default menu attachment
 */
if(!$document->isAssigned('ENGINE_MENU'))
{
    $menu = new \App\Menu('main');
    $document->assign('ENGINE_MENU',$menu->fetch());
}

$document->parse();
?>

