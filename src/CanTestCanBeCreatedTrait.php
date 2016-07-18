<?php

namespace Dhii\Test;

/**
 * Functionality for testing whether the test subject can be created.
 *
 * @since [*next-version*]
 */
trait CanTestCanBeCreatedTrait
{
    public function testCanBeCreated()
    {
        $instance  = $this->createInstance();
        $className = $this->getClassName();
        $this->assertClassType($instance, $className, sprintf('Object must be of type "%1$s"', $className));

        if ($ancestorName = $this->getClassAncestor()) {
            $this->assertInstanceOf($instance, $ancestorName, sprintf('Object must be an instance of "%1$s"', $ancestorName));
        }
    }

    abstract public function createInstance();

    abstract public function getClassName();

    abstract public function getClassAncestor();

    abstract public function assertClassType($actual, $expected, $message = '');

    abstract public function assertInstanceOf($actual, $expected, $message = '');
}
