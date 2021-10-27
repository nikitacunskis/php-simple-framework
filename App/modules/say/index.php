<?php
    $menu = new \App\Menu('say');
    $document->assign('ENGINE_MENU', $menu->fetch());
    $header->setTitle($header->getTitle() . " :: Say");
    $document->assign('ENGINE_CONTENT', $router->getModule()->getParam('value'));
?>
