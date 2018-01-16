<?php
require_once 'WasRun.php';

$test = new WasRun('testMethod');
var_dump($test->wasRun);
$test->testMethod();
var_dump($test->WasRun);
