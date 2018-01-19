<?php
class TestCase {
    public $name;
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function setUp()
    {
    }

    public function run()
    {
        $this->setUp();
        $method = $this->name;

        $this->$method();
    }
}

class WasRun extends TestCase {
    public $log;

    public function setUp()
    {
        $this->log = 'setUp ';
    }

    public function testMethod()
    {
        $this->log = $this->log . 'testMethod ';
    }
}

class TestCaseTest extends TestCase {

    private $test;
    public function setUp()
    {
        $this->test = new WasRun('testMethod');
    }

    public function testTemplateMethod()
    {
        $this->test->run();
        assert('setUp testMethod ' === $this->test->log);
    }
}

(new TestCaseTest('testTemplateMethod'))->run();
