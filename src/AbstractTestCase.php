<?php

namespace Dhii\Test;

/**
 * Base functionality for all tests.
 *
 * @since [*next-version*]
 */
abstract class AbstractTestCase extends \PHPUnit_Framework_TestCase implements TestCaseInterface
{
    use Assertion\TypeTrait;
}
