<?php

require_once 'TestCase.php';

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
