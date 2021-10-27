<?php
$tpl = new \App\Template('module/login/index');
$document->assign('ENGINE_CONTENT', $tpl->fetch());
?>