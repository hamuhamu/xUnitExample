<?php

require_once 'TestCase.php';

class WasRun extends TestCase {
    public $wasRun;
    public $name;
    public function __construct($name)
    {
        $this->wasRun = null;
        $this->name = $name;
    }

    public function run()
    {
        $method = $this->name;

        $this->$method();
    }

    public function testMethod()
    {
        $this->WasRun = 1;
    }
}
