<?php

class TestResult {
    public $runCount;
    public $errorCount;
    public function __construct()
    {
        $this->runCount = 0;
        $this->errorCount = 0;
    }

    public function testStarted()
    {
        $this->runCount = $this->runCount + 1;
    }

    public function testFailed()
    {
        $this->errorCount = $this->errorCount + 1;
    }

    public function summary()
    {
        return sprintf('%d run, %d failed', $this->runCount, $this->errorCount);
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

    public function run(TestResult $result)
    {
        $result->testStarted();

        $this->setUp();

        try {
            $method = $this->name;
            $this->$method();
        } catch (Exception $e) {
            $result->testFailed();
        }

        $this->tearDown();
    }

    public function tearDown()
    {
    }
}

class TestSuite {
    public $tests;
    public function __construct()
    {
        $this->tests = [];
    }

    public function add(TestCase $test)
    {
        $this->tests[] = $test;
    }

    public function run(TestResult $result)
    {
        foreach ($this->tests as $test) {
            $test->run($result);
        }
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

    public function testBrokenMethod()
    {
        throw new Exception();
    }

    public function tearDown()
    {
        $this->log = $this->log . 'tearDown ';
    }
}

class TestCaseTest extends TestCase {
    public $result;
    public function setUp()
    {
        $this->result = new TestResult();
    }

    public function testTemplateMethod()
    {
        $test = new WasRun('testMethod');
        $test->run($this->result);
        assert('setUp testMethod tearDown ' === $test->log);
    }

    public function testResult()
    {
        $test = new WasRun('testMethod');
        $test->run($this->result);
        assert('1 run, 0 failed' === $this->result->summary());
    }

    public function testFailedResult()
    {
        $test = new WasRun('testBrokenMethod');
        $result = new TestResult();
        $test->run($this->result);
        assert('1 run, 1 failed' === $this->result->summary());
    }

    public function testFailedResultFormatting()
    {
        $this->result->testStarted();
        $this->result->testFailed();
        assert('1 run, 1 failed' === $this->result->summary());
    }

    public function testSuite()
    {
        $suite = new TestSuite();
        $suite->add(new WasRun('testMethod'));
        $suite->add(new WasRun('testBrokenMethod'));
        $suite->run($this->result);
        assert('2 run, 1 failed' === $this->result->summary());
    }
}

$suite = new TestSuite();
$suite->add((new TestCaseTest('testTemplateMethod')));
$suite->add(new TestCaseTest('testResult'));
$suite->add(new TestCaseTest('testFailedResult'));
$suite->add(new TestCaseTest('testFailedResultFormatting'));
$suite->add(new TestCaseTest('testSuite'));

$result = new TestResult();
$suite->run($result);

echo $result->summary() . PHP_EOL;
