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

    public function __construct($name)
    {
        $this->wasRun = null;
        parent::__construct($name);
    }

    public function setUp()
    {
        $this->wasSetUp = 1;
    }

    public function testMethod()
    {
        $this->WasRun = 1;
    }
}

class TestCaseTest extends TestCase {

    public function testRunning()
    {
        $test = new WasRun('testMethod');
        assert(!$test->WasRun);
        $test->run();
        assert($test->WasRun);
    }

    public function testSetUp()
    {
        $test = new WasRun('testMethod');
        $test->run();
        assert($test->wasSetUp);
    }
}

(new TestCaseTest('testRunning'))->run();
(new TestCaseTest('testSetUp'))->run();
