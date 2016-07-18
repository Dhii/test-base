<?php

namespace Dhii\Test\Test\Constraint;

use Dhii\Test\Constraint\Type;
use Dhii\Test\TestUtil\CanGetAccessibleMethodTrait;

/**
 * Tests Type constraint.
 *
 * This constraint fails if the subject is not an object of the specified class.
 *
 * @since [*next-version*]
 */
class TypeTest extends \PHPUnit_Framework_TestCase
{
    use CanGetAccessibleMethodTrait;

    /**
     * Creates a new constraint instance.
     *
     * @since [*next-version*]
     * @param string $type The class name for the type constraint.
     * @return Type A new instance of the constraint.
     */
    public function createConstraint($type = \stdClass::class)
    {
        $constraint = new Type($type);
        return $constraint;
    }

    /**
     * @since [*next-version*]
     * @param string|null $type If specified, the mock will assume that it's a constraint for the specified type.
     * @return Type A mock for the constraint.
     */
    public function createConstraintMock($type = null)
    {
        $constraint = $this->getMockBuilder(Type::class)
            ->setConstructorArgs([$type])
            ->getMock();

        return $constraint;
    }

    /**
     * Tests whether a valid constraint can be created.
     * 
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $constraint = $this->createConstraint(\PHPUnit_Framework_Constraint_And::class);
        $this->assertInstanceOf(\PHPUnit_Framework_Constraint::class, $constraint, 'Type constraint must be a valid PHPUnit constraint');
    }

    /**
     * Tests whether the constraint creation will fail if given invalid class name.
     * @since [*next-version*]
     */
    public function testNonStringTypeThrowsException() {
        $this->expectException(\PHPUnit_Framework_Exception::class);
        $this->expectExceptionMessage('type must be a string');
        $constraint = $this->createConstraint([]);
    }

    /**
     * Tests whether the constraint will succeed when correct class name and object given.
     * @since [*next-version*]
     */
    public function testMatchSuccess()
    {
        $class = \stdClass::class;
        $constraint = $this->createConstraint($class);
        $result = $constraint->matches(new \stdClass());
        $this->assertTrue($result, sprintf('Constraint match must succeed on class name "%1$s"', $class));
    }

    /**
     * Tests that the match will fail if an invalid subject is supplied.
     * @since [*next-version*]
     */
    public function testMatchFailureInvalidSubject()
    {
        $constraint = $this->createConstraint();
        $result = $constraint->matches('Not an object');
        $this->assertFalse($result, sprintf('Constraint match must fail on non-object subject'));
    }

    /**
     * Tests that the value returned by protected `_getType()` method is the same as supplied in subject constructor.
     * @since [*next-version*]
     */
    public function testProtectedGetType()
    {
        $class = 'MyClass';
        $constraint = $this->createConstraint($class);
        $method = $this->getAccessibleMethod($constraint, '_getType');
        $this->assertSame($class, $method->invoke($constraint), 'The class returned must be same as class set via constructor');
    }

    /**
     * Tests that the string representation of the constraint is correct.
     * @since [*next-version*]
     */
    public function testToString()
    {
        $class = 'Asdasd1Ay9182YE1';
        $constraint = $this->createConstraint($class);
        $this->assertContains($class, $constraint->toString(), 'The constraint string must feature the type name');
    }
}