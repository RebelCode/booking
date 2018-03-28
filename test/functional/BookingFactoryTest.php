<?php

namespace RebelCode\Bookings\FuncTest;

use PHPUnit_Framework_MockObject_MockObject as MockObject;
use RebelCode\Bookings\BookingFactory;
use Xpmock\TestCase;

/**
 * Tests {@see \RebelCode\Bookings\BookingFactory}.
 *
 * @since [*next-version*]
 */
class BookingFactoryTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'RebelCode\Bookings\BookingFactory';

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = new BookingFactory();

        $this->assertInstanceOf(
            'RebelCode\Bookings\BookingFactoryInterface',
            $subject,
            'Test subject does not implement expected interface.'
        );
    }

    public function testMakeNoData()
    {
        $subject = new BookingFactory();

        $actual = $subject->make();

        $this->assertEquals(null, $actual->getId());
        $this->assertEquals(null, $actual->getStatus());
        $this->assertEquals(null, $actual->getStart());
        $this->assertEquals(null, $actual->getEnd());
    }

    public function testMakeEmptyData()
    {
        $subject = new BookingFactory();

        $actual = $subject->make([]);

        $this->assertEquals(null, $actual->getId());
        $this->assertEquals(null, $actual->getStatus());
        $this->assertEquals(null, $actual->getStart());
        $this->assertEquals(null, $actual->getEnd());
    }

    public function testMakeInvalidData()
    {
        $subject = new BookingFactory();

        $this->setExpectedException('InvalidArgumentException');

        $subject->make("invalid-data");
    }

    public function testMakeWithData()
    {
        $subject = new BookingFactory();
        $data = [
            'id'     => rand(0, 100),
            'status' => uniqid('status-'),
            'start'  => rand(0, time()),
            'end'    => rand(0, time()),
        ];

        $actual = $subject->make($data);

        $this->assertEquals($data['id'], $actual->getId());
        $this->assertEquals($data['status'], $actual->getStatus());
        $this->assertEquals($data['start'], $actual->getStart());
        $this->assertEquals($data['end'], $actual->getEnd());
    }
}
