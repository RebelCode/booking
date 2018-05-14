<?php

namespace RebelCode\Bookings\FuncTest;

use Exception;
use RebelCode\Bookings\GetDataWithDefaultCapableTrait as TestSubject;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use stdClass;
use Xpmock\TestCase;

/**
 * Tests {@see \RebelCode\Bookings\GetDataWithDefaultCapableTrait}.
 *
 * @since [*next-version*]
 */
class GetDataWithDefaultCapableTraitTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'RebelCode\Bookings\GetDataWithDefaultCapableTrait';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @param array $methods Optional additional mock methods.
     *
     * @return MockObject|TestSubject
     */
    public function createInstance(array $methods = [])
    {
        $builder = $this->getMockBuilder(static::TEST_SUBJECT_CLASSNAME)
                        ->setMethods(
                            array_merge(
                                $methods,
                                [
                                    '_getData',
                                ]
                            )
                        );

        $mock = $builder->getMockForTrait();

        return $mock;
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance();

        $this->assertInternalType(
            'object',
            $subject,
            'An instance of the test subject could not be created'
        );
    }

    /**
     * Tests the `_getDataWithDefault()` method to assert whether it correctly returns existing values.
     *
     * @since [*next-version*]
     */
    public function testGetData()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $key = uniqid('key-');
        $value = new stdClass();
        $default = uniqid('default-');

        $subject->expects($this->once())
                ->method('_getData')
                ->with($key)
                ->willReturn($value);

        $actual = $reflect->_getDataWithDefault($key, $default);

        $this->assertSame($actual, $value);
    }

    /**
     * Tests the `_getDataWithDefault()` method to assert whether it correctly returns the default for non-existing
     * values.
     *
     * @since [*next-version*]
     */
    public function testGetDataDefault()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $key = uniqid('key-');
        $default = uniqid('default-');

        $subject->expects($this->once())
                ->method('_getData')
                ->with($key)
                ->willThrowException(new Exception());

        $actual = $reflect->_getDataWithDefault($key, $default);

        $this->assertSame($default, $actual);
    }
}
