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
    public $wasRun;
    public $wasSetUp;

    public function setUp()
    {
        $this->wasRun = null;
        $this->wasSetUp = 1;
    }

    public function testMethod()
    {
        $this->wasRun = 1;
    }
}

class TestCaseTest extends TestCase {

    private $test;
    public function setUp()
    {
        $this->test = new WasRun('testMethod');
    }

    public function testRunning()
    {
        $this->test->run();
        assert($this->test->wasRun);
    }

    public function testSetUp()
    {
        $this->test->run();
        assert($this->test->wasSetUp);
    }
}

(new TestCaseTest('testRunning'))->run();
(new TestCaseTest('testSetUp'))->run();
