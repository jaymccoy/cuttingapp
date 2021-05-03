<?php

$cwd=getcwd();
$logFile="/var/www/html/logs/development.log";
include_once ("logger.php");
$log = new Logger($logFile);
include_once ("config.php");
include_once ("connect.php");
include_once ("functions.php");