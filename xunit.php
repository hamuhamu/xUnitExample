<?php

class TestResult {
    public $runCount;
    public function __construct()
    {
        $this->runCount = 1;
    }

    public function summary()
    {
        return sprintf('%d run, 0 failed', $this->runCount);
    }
}

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

        $this->tearDown();

        return new TestResult();
    }

    public function tearDown()
    {
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

    public function tearDown()
    {
        $this->log = $this->log . 'tearDown ';
    }
}

class TestCaseTest extends TestCase {

    public function testTemplateMethod()
    {
        $test = new WasRun('testMethod');
        $test->run();
        assert('setUp testMethod tearDown ' === $test->log);
    }

    public function testResult()
    {
        $test = new WasRun('testMethod');
        $result = $test->run();
        assert('1 run, 0 failed' === $result->summary());
    }
}

(new TestCaseTest('testTemplateMethod'))->run();
(new TestCaseTest('testResult'))->run();
