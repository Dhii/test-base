<?php

namespace Dhii\Test\Assertion;

use Dhii\Test\Constraint;

/**
 * Functionality for asserting type.
 *
 * @since [*next-version*]
 */
trait TypeTrait
{
    use ThatTrait;

    /**
     * Asserts that the given object is exactly of a specified class type.
     *
     * @since [*next-version*]
     *
     * @param string $expected The fully qualified name of the expected type.
     * @param object $actual   The object to test.
     * @param string $message  The message to output if the test fails.
     */
    public function assertClassType($expected, $actual, $message = '')
    {
        $constraint = new Constraint\Type($expected);
        $this->assertThat($actual, $constraint, $message);
    }
}
