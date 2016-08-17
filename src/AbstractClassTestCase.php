<?php

namespace Dhii\Test;

/**
 * Base functionality for class tests.
 *
 * @since [*next-version*]
 */
abstract class AbstractClassTestCase extends AbstractTestCase  implements ClassTestCaseInterface
{
    use Tests\CanBeCreatedTrait;

    public function isTestInstanceType()
    {
        return true;
    }
}
