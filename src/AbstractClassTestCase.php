<?php

namespace Dhii\Test;

use Dhii\Test\Test as Testing;

/**
 * Base functionality for class tests.
 *
 * @since [*next-version*]
 */
abstract class AbstractClassTestCase extends AbstractTestCase  implements ClassTestCaseInterface
{
    use Testing\CanBeCreatedTrait;
}
