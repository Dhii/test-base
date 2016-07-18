<?php

namespace Dhii\Test\Test;

use Dhii\Test\Exception as TestSubject;

/**
 * Tests Exception.
 *
 * @since [*next-version*]
 */
class ExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @since [*next-version*]
     *
     * @param string|null $message The message for the exception
     *
     * @return TestSubject The exception instance.
     */
    public function createException($message = null)
    {
        $subject = new TestSubject($message);

        return $subject;
    }

    /**
     * Tests that a vald PHPUnit exception can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createException();
        $this->assertInstanceOf(\PHPUnit_Framework_Exception::class, $subject, 'Exception must be a valid PHPUnit exception');
    }

    /**
     * Tests that the exception can be thrown with the correct message.
     *
     * @since [*next-version*]
     */
    public function testCanBeThrown()
    {
        $token = '&^*&@e)SDIq!';
        $subject = $this->createException($token);
        $error = 'The exception must be throwable';

        try {
            throw $subject;
        } catch (\Exception $ex) {
            $this->assertContains($token, $ex->getMessage(), $error);

            return;
        }

        $this->assertTrue(false, $error);
    }
}
