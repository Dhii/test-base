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

    public function assertClassType($expected, $actual, $message = '')
    {
        $constraint = new Constraint\Type($expected);
        $this->assertThat($actual, $constraint, $message);
    }
}
