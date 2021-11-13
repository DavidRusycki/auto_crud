<?php
// require_once('./core/controller/controllerBase.php');
// init();


require_once('./core/includer.php');
includeControllerBd();
$aRes = execute('select * from tbproduto');
var_dump($aRes);