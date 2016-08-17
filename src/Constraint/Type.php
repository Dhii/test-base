<?php

namespace Dhii\Test\Constraint;

use Dhii\Test\TestUtil;

/**
 * Fails if object not of the specified type.
 *
 * @since [*next-version*]
 */
class Type extends AbstractConstraint
{
    use TestUtil\CanGetVarTypeTrait;

    protected $type;

    /**
     * @since [*next-version*]
     *
     * @param string $type The name of the class, of which the match must be an instance.
     *
     * @throws Exception If type is not a string.
     */
    public function __construct($type)
    {
        if (!is_string($type)) {
            throw new \PHPUnit_Framework_Exception(sprintf('Could not create constraint: type must be a string, but is of type "%1$s"',
                $this->getVarType($type)));
        }

        $this->type = trim($type);
        parent::__construct();
    }

    /**
     * Compares value to determine if it is of the configured type.
     *
     * @since [*next-version*]
     *
     * @param mixed $other The value to compare.
     *
     * @return bool True if parameter is an object of configured type; otherwise false.
     */
    public function matches($other)
    {
        if (!is_object($other)) {
            return false;
        }

        return get_class($other) === $this->_getType();
    }

    /**
     * @since [*next-version*]
     *
     * @return string The type, with which comparison will be made.
     */
    protected function _getType()
    {
        return $this->type;
    }

    /**
     * @since [*next-version*]
     *
     * @return string The string representation of this constraint.
     */
    public function toString()
    {
        return sprintf('class is of type "%1$s"', $this->_getType());
    }
}
