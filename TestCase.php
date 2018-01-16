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
