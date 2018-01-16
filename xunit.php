<?php
require_once 'WasRun.php';

$test = new WasRun('testMethod');
echo $test->wasRun();
$test->testMethod();
echo $test->WasRun();
