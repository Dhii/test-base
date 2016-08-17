<?php

namespace Dhii\Test\FuncTest;

use Dhii\Test\Assertion;
use Dhii\Test\AbstractClassTestCase as TestSubject;

/**
 * Testing AbstractClassTestCase.
 * 
 * @since [*next-version*]
 */
class AbstractClassTestCaseTest extends \PHPUnit_Framework_TestCase
{
    use Assertion\AssertionFailureTrait;
    use Assertion\AssertionSuccessTrait;
    
    /**
     * Crates an instance of the SUT.
     * 
     * @since [*next-version*]
     * 
     * @return TestSubject|\PHPUnit_Framework_MockObject_MockObject An instance of the SUT.
     */
    public function createSubject($class = null, $ancestor = null)
    {
        $mockedMethods = array();
        
        if (!is_null($class)) {
            $mockedMethods['createInstance'] = $this->returnCallback(function() use ($class) {
                return new $class;
            });

            $mockedMethods['getClassName'] = $this->returnCallback(function() use ($class) {
                return $class;
            });
        }
        
        if (!is_null($ancestor)) {
            $mockedMethods['getClassAncestor'] = $this->returnCallback(function() use ($ancestor) {
                return $ancestor;
            });
        }
        
        $mockTestCaseName = 'SUT';
        $mockTestCaseArgs = [];

        $subject = $this->getMockForAbstractClass(
                TestSubject::class,
                $mockTestCaseArgs,
                '',
                true,
                true,
                true,
                array_keys($mockedMethods)
                );

        foreach ($mockedMethods as $_name => $_return) {
            $subject->method($_name)->will($_return);
        }
        
        return $subject;
    }
    
    public function testCanBeCreated()
    {
        $subject = $this->createSubject();
        $this->assertInstanceOf(TestSubject::class, $subject);
    }
    
    /**
     * Tests #testCanBeCreated().
     * 
     * @since [*next-version*]
     */
    public function testTestCanBeCreatedSuccess()
    {
        $class = \PHPUnit_Framework_Constraint_And::class;
        $ancestor = \PHPUnit_Framework_Constraint::class;
        $subject = $this->createSubject($class, $ancestor);
        
        $this->assertAssertionSuccess(function() use ($subject) {
            $subject->testCanBeCreated();
        }, 'Assertion should pass');
    }
}
