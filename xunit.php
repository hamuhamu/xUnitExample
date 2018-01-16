<?php
class TestCase {
    public $name;
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function run()
    {
        $method = $this->name;

        $this->$method();
    }
}

class WasRun extends TestCase {
    public $wasRun;

    public function __construct($name)
    {
        $this->wasRun = null;
        parent::__construct($name);
    }

    public function testMethod()
    {
        $this->WasRun = 1;
    }
}

$test = new WasRun('testMethod');
var_dump($test->wasRun);
$test->run();
var_dump($test->WasRun);
