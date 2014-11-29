<?php
require_once('../bin/myDatabase.php');

$dbUserName = 'mharri11' . '_admin';
$whichPass = "a"; //flag for which one to use.
$dbName = strtoupper('mharri11') . '_BlipBloop';

$thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName);
?>