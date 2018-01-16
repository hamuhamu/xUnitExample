<?php

class WasRun {
    public $wasRun;
    public function __construct($name)
    {
        $this->wasRun = null;
    }

    public function run()
    {
        $this->testMethod();
    }

    public function testMethod()
    {
        $this->WasRun = 1;
    }
}
