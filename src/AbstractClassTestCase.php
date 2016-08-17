<?php

namespace Dhii\Test;

use Dhii\Test\Tests;

/**
 * Base functionality for class tests.
 *
 * @since [*next-version*]
 */
abstract class AbstractClassTestCase extends AbstractTestCase  implements ClassTestCaseInterface
{
    use Tests\CanBeCreatedTrait;
}
