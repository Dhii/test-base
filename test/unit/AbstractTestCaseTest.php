<?php

namespace Dhii\Test\Test;

use Dhii\Test\AbstractTestCase as TestSubject;
use Dhii\Test\TestCaseInterface;

/**
 * Tests AbstractTestCase.
 *
 * @since [*next-version*]
 */
class AbstractTestCaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @since [*next-version*]
     *
     * @return PHPUnit_Framework_MockObject_MockObject The mock of the abstract test case.
     */
    public function createSubject()
    {
        $subject = $this->getMockForAbstractClass(TestSubject::class);

        return $subject;
    }

    /**
     * Tests that a valid test can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createSubject();
        $this->assertInstanceOf(\PHPUnit_Framework_TestCase::class, $subject, 'Must be a valid PHPUnit test case');
        $this->assertInstanceOf(TestCaseInterface::class, $subject, 'Must be a valid Dhii test case');
    }
}
