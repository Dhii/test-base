<?php

namespace Dhii\Test\Tests;

/**
 * Functionality for testing whether the test subject can be created.
 *
 * @since [*next-version*]
 */
trait CanBeCreatedTrait
{
    /**
     * Tests whether the class can be created, and is of correct type, and optionally that
     * it has the right ancestor.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $instance  = $this->createInstance();
        $className = $this->getClassName();
        $this->assertClassType($className, $instance, sprintf('Object must be of type "%1$s"', $className));

        if ($ancestorName = $this->getClassAncestor()) {
            $this->assertInstanceOf($ancestorName, $instance, sprintf('Object must be an instance of "%1$s"', $ancestorName));
        }
    }

    /**
     * @since [*next-version*]
     *
     * @return object The test subject instance.
     */
    abstract public function createInstance();

    /**
     * @since [*next-version*]
     *
     * @return string Name of the test subject class.
     */
    abstract public function getClassName();

    /**
     * @since [*next-version*]
     *
     * @return string|null Name of a class or instance, of which the test subject must be a descendant.
     */
    abstract public function getClassAncestor();

    /**
     * Asserts that a object is of a specific class.
     *
     * @since [*next-version*]
     */
    abstract public function assertClassType($expected, $actual, $message = '');

    /**
     * Asserts that an object extends a specific class, or implements a specific interface.
     *
     * @since [*next-version*]
     */
    abstract public function assertInstanceOf($expected, $actual, $message = '');
}
