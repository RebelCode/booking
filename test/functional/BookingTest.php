<?php

namespace RebelCode\Bookings\FuncTest;

use RebelCode\Bookings\Booking as TestSubject;
use RebelCode\Bookings\Booking;
use Xpmock\TestCase;
use Exception as RootException;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class BookingTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'RebelCode\Bookings\Booking';

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = new Booking([]);

        $this->assertInstanceOf(
            'RebelCode\Bookings\BookingInterface',
            $subject,
            'A valid instance of the test subject could not be created.'
        );

        $this->assertInstanceOf(
            'Dhii\Collection\CountableMapInterface',
            $subject,
            'A valid instance of the test subject could not be created.'
        );
    }

    /**
     * Tests the constructor with an empty data set to assert whether an empty booking is created.
     *
     * @since [*next-version*]
     */
    public function testConstructor()
    {
        $subject = new Booking([]);

        $data = iterator_to_array($subject);
        $count = count($subject);

        $this->assertEmpty($data, 'Data is not empty.');
        $this->assertEquals(0, $count, 'Count is not zero');
    }

    /**
     * Tests the constructor with a data set to assert whether the data is correctly assigned.
     *
     * @since [*next-version*]
     */
    public function testConstructorWithData()
    {
        $k1 = uniqid('key-');
        $k2 = uniqid('key-');
        $v1 = uniqid('val-');
        $v2 = uniqid('val-');
        $data = [
            $k1 => $v1,
            $k2 => $v2,
        ];
        $subject = new Booking($data);

        $actual = iterator_to_array($subject);

        $this->assertEquals($data, $actual, 'Internal data set is incorrect.');
    }

    /**
     * Tests the constructor with a data set that contains known keys, and the getter methods, to assert whether the
     * assigned data that can correctly retrieved by the getter methods.
     *
     * @since [*next-version*]
     */
    public function testConstructorGetters()
    {
        $id = rand(0, 100);
        $status = uniqid('status-');
        $start = rand(0, time() / 2);
        $end = rand($start, time());
        $duration = $end - $start;
        $data = [
            'id'     => $id,
            'status' => $status,
            'start'  => $start,
            'end'    => $end,
        ];
        $subject = new Booking($data);

        $this->assertEquals($id, $subject->getId(), 'Retrieved ID is incorrect.');
        $this->assertEquals($status, $subject->getStatus(), 'Retrieved status is incorrect.');
        $this->assertEquals($start, $subject->getStart(), 'Retrieved start is incorrect.');
        $this->assertEquals($end, $subject->getEnd(), 'Retrieved end is incorrect.');
        $this->assertEquals($duration, $subject->getDuration(), 'Retrieved duration is incorrect.');
    }

    /**
     * Tests the constructor with a data set that contains known keys, and the getter methods, to assert whether the
     * assigned data that can correctly retrieved by the getter methods.
     *
     * @since [*next-version*]
     */
    public function testConstructorEmptyDataSetGetters()
    {
        $data = [];
        $subject = new Booking($data);

        $this->assertNull($subject->getId(), 'Retrieved ID is incorrect.');
        $this->assertNull($subject->getStatus(), 'Retrieved status is incorrect.');
        $this->assertNull($subject->getStart(), 'Retrieved start is incorrect.');
        $this->assertNull($subject->getEnd(), 'Retrieved end is incorrect.');
        $this->assertNull($subject->getDuration(), 'Retrieved duration is incorrect.');
    }

    /**
     * Tests the constructor with a data set that contains arbitrary data to assert whether that data can be retrieved.
     *
     * @since [*next-version*]
     */
    public function testConstructorGetMiscData()
    {
        $key = uniqid('key-');
        $val = uniqid('val-');
        $data = [
            $key => $val,
        ];
        $subject = new Booking($data);

        $this->assertEquals($val, $subject->get($key), 'Retrieved data is incorrect.');
    }

    /**
     * Tests the constructor with a data set that contains arbitrary data to assert whether an exception is thrown
     * the subject does not have that data.
     *
     * @since [*next-version*]
     */
    public function testConstructorGetMiscDataNotFound()
    {
        $key = uniqid('key-');
        $key2 = uniqid('key-');
        $val = uniqid('val-');
        $data = [
            $key => $val,
        ];
        $subject = new Booking($data);

        $this->setExpectedException('Psr\Container\NotFoundExceptionInterface');

        $subject->get($key2);
    }

    /**
     * Tests the constructor with a data set that contains arbitrary data to assert whether that data can be checked
     * for.
     *
     * @since [*next-version*]
     */
    public function testConstructorHasMiscData()
    {
        $key = uniqid('key-');
        $key2 = uniqid('key-');
        $val = uniqid('val-');
        $data = [
            $key => $val,
        ];
        $subject = new Booking($data);

        $this->assertTrue($subject->has($key), 'Subject should have the data.');
        $this->assertFalse($subject->has($key2), 'Subject should NOT have the data.');
    }
}
