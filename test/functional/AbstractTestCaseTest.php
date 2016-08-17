<?php

namespace Dhii\Test\FuncTest;

use Dhii\Test\Assertion;
use Dhii\Test\AbstractTestCase as TestSubject;

/**
 * Tests AbstractTestCase
 * 
 * @since [*next-version*]
 */
class AbstractTestCaseTest extends \PHPUnit_Framework_TestCase
{
    use Assertion\AssertionFailureTrait;
    use Assertion\AssertionSuccessTrait;
    
    /**
     * Creates an instance of the SUT.
     * 
     * @since [*next-version*]
     * @return TestSubject
     */
    public function createInstance()
    {
        return $this->getMockForAbstractClass(TestSubject::class, array());
    }
    
    /**
     * Tests that AbstractTestCase#assertClassType() will pass under the right conditions.
     * 
     * @since [*next-version*]
     */
    public function testAssertClassTypeSuccess()
    {
        $subject = $this->createInstance();
        $actual = new \stdClass();
        $expected = get_class($actual); // The actual class name
        $this->assertAssertionSuccess(function() use ($subject, $actual, $expected) {
            $subject->assertClassType($expected, $actual, '[Irrelevant assertion]');
        }, 'Type assertion must pass');
    }
    
    /**
     * Tests that AbstractTestCase#assertClassType() will fail under the wrong conditions.
     * 
     * @since [*next-version*]
     */
    public function testAssertClassTypeFailure()
    {
        $subject = $this->createInstance();
        $actual = new \stdClass();
        $expected = \PHPUnit_Framework_Assert::class; // Some irrelevant class name
        $expectedMessage = '[Failed assertion]';
        $this->assertAssertionFailure(function() use ($subject, $actual, $expected, $expectedMessage) {
            $subject->assertClassType($expected, $actual, $expectedMessage);
        }, $expectedMessage, 'Type assertion must fail');
    }
}
