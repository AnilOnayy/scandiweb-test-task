<?php 
require __DIR__."/config.php";
require BASEDIR."vendor/autoload.php";


$starter = new \Core\Starter();

require BASEDIR."App/Routes/Route.php";