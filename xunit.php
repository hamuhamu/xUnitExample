<?php
require_once 'WasRun.php';

$test = new WasRun('testMethod');
var_dump($test->wasRun);
$test->run();
var_dump($test->WasRun);
