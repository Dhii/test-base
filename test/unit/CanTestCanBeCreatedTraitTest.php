<?php

namespace Dhii\Test\Test;

use Dhii\Test\CanTestCanBeCreatedTrait as TestSubject;
use Dhii\Test\Assertion;

/**
 * Description of CanTestCanBeCreatedTraitTest
 *
 * @since [*next-version*]
 */
class CanTestCanBeCreatedTraitTest extends \PHPUnit_Framework_TestCase
{
    use Assertion\AssertionFailureTrait;
    use Assertion\AssertionSuccessTrait;

    /**
     * Tests that the check for valid created class fails if not right class.
     * @since [*next-version*]
     */
    public function testTestCanBeCreatedClassTypeFails()
    {
        $subjectClass = TestSubject::class;
        $trait = $this->getMockForTrait($subjectClass);
        $trait->method('createInstance')
            ->willReturn('[instance of subject]');
        $trait->method('getClassName')
            ->willReturn('[class name]');
        $trait->method('getClassAncestor')
            ->willReturn('[ancestor name]');
        $trait->method('assertClassType')
            ->will($this->returnCallback(function($actual, $expected, $message = '') {
                $this->assertTrue(false, $message);
            }));

        // Part of actual error message from the test subject
        $classTypeError = 'Object must be of type';
        // Due to the class type assertion failing, this should pass
        $this->assertAssertionFailure(function() use ($trait) {
                $trait->testCanBeCreated();
        }, $classTypeError, 'Should not be able to create object due to type mismatch');
    }

    /**
     * Tests that the check for valid created class fails if no right ancestor.
     * @since [*next-version*]
     */
    public function testTestCanBeCreatedInstanceOfFails()
    {
        $subjectClass = TestSubject::class;
        $trait = $this->getMockForTrait($subjectClass);
        $trait->method('createInstance')
            ->willReturn('[instance of subject]');
        $trait->method('getClassName')
            ->willReturn('[class name]');
        $trait->method('getClassAncestor')
            ->willReturn('[ancestor name]');
        $trait->method('assertClassType')
            ->will($this->returnCallback(function($actual, $expected, $message = '') {
                $this->assertTrue(true, 'This passes in this example');
            }));

        $trait->method('assertInstanceOf')
            ->will($this->returnCallback(function($actual, $expected, $message = '') {
                $this->assertTrue(false, $message);
            }));

        // Part of actual error message from the test subject
        $classTypeError = 'Object must be an instance of';
        // Due to the class type assertion failing, this should pass
        $this->assertAssertionFailure(function() use ($trait) {
                $trait->testCanBeCreated();
        }, $classTypeError, 'Should not be able to create object due to type mismatch');
    }

    /**
     * Tests that the check for valid created class succeeds under the right conditions.
     * @since [*next-version*]
     */
    public function testTestCanBeCreatedSuccess()
    {
        $subjectClass = TestSubject::class;
        $trait = $this->getMockForTrait($subjectClass);
        $trait->method('createInstance')
            ->willReturn('[instance of subject]');
        $trait->method('getClassName')
            ->willReturn('[class name]');
        $trait->method('getClassAncestor')
            ->willReturn('[ancestor name]');
        $trait->method('assertClassType')
            ->will($this->returnCallback(function($actual, $expected, $message = '') {
                $this->assertTrue(true, 'This passes in this example');
            }));

        $trait->method('assertInstanceOf')
            ->will($this->returnCallback(function($actual, $expected, $message = '') {
                $this->assertTrue(true, 'Also passes');
            }));

        // Due to the class type assertion succeeding, this should pass
        $this->assertAssertionSuccess(function() use ($trait) {
                $trait->testCanBeCreated();
        }, 'Should be able to create object');
    }
}