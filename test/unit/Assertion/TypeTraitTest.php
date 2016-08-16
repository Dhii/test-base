<?php

namespace Dhii\Test\Test\Assertion;

use Dhii\Test\Assertion\TypeTrait as TestSubject;
use Dhii\Test\Assertion;

/**
 * Tests TypeTrait assertion.
 *
 * @since [*next-version*]
 */
class TypeTraitTest extends \PHPUnit_Framework_TestCase
{
    use Assertion\AssertionFailureTrait;
    use Assertion\AssertionSuccessTrait;

    /**
     * @since [*next-version*]
     *
     * @return PHPUnit_Framework_MockObject_MockObject Mock of the trait.
     *                                                 This mock will use this test instance for assertions.
     */
    public function createSubject()
    {
        $mock = $this->getMockForTrait(TestSubject::class);
        $mock->method('assertThat')->will($this->returnCallback(function ($value, $constraint, $message) {
            $this->assertThat($value, $constraint, $message);
        }));

        return $mock;
    }

    /**
     * Tests that class type can be successfully asserted with right conditions.
     *
     * @since [*next-version*]
     */
    public function testAssertClassTypeSuccess()
    {
        $subject = $this->createSubject();
        $arg = new \stdClass();
        $class = get_class($arg);
        $this->assertAssertionSuccess(function () use ($subject, $arg, $class) {
            $subject->assertClassType($class, $arg);
        }, 'Class type must be matched');
    }

    /**
     * Tests that class type assertion can fail with wrong conditions.
     *
     * @since [*next-version*]
     */
    public function testAssertClassTypeFailure()
    {
        $subject = $this->createSubject();
        $arg = new \stdClass();
        $class = get_class($arg);
        $token = 'h97ASDAS13r31(^';
        $this->assertAssertionFailure(function () use ($subject, $class, $token) {
            $subject->assertClassType($class, new \Reflection(), $token);
        }, $token, 'Class type must not be matched');
    }
}
