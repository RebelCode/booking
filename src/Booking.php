<?php

namespace RebelCode\Bookings;

use ArrayAccess;
use ArrayObject;
use Dhii\Collection\AbstractBaseCountableMap;
use Dhii\Collection\MapInterface;
use Dhii\Data\Container\Exception\ContainerException;
use Dhii\Data\Container\Exception\NotFoundException;
use Dhii\Data\Object\CreateDataStoreCapableTrait;
use Dhii\I18n\StringTranslatingTrait;
use Exception as RootException;
use Exception;
use stdClass;
use Traversable;

/**
 * Concrete implementation of a booking.
 *
 * This implementation extends the functionality of a map, using an internal data store for storing its data and also
 * allowing any other arbitrary data to be stored in addition to the ID, status, start time, end time and duration.
 *
 * @since [*next-version*]
 */
class Booking extends AbstractBaseCountableMap implements BookingInterface
{
    /*
     * Provides functionality for creating a data store.
     *
     * @since [*next-version*]
     */
    use CreateDataStoreCapableTrait;

    /*
     * Provides functionality for retrieving data, using a default when data is not found.
     *
     * @since [*next-version*]
     */
    use GetDataWithDefaultCapableTrait;

    /*
     * Provides string translating functionality.
     *
     * @since [*next-version*]
     */
    use StringTranslatingTrait;

    /**
     * Constructor.
     *
     * @since [*next-version*]
     *
     * @param array|stdClass|ArrayObject|MapInterface $data The data of the booking - anything that is both a valid
     *                                                      container and is also traversable.
     */
    public function __construct($data)
    {
        $data = (is_array($data) || ($data instanceof stdClass))
            ? $this->_createDataStore($data)
            : $data;

        $this->_setDataStore($data);

        $this->_construct();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getId()
    {
        return $this->_getDataWithDefault('id', null);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getStatus()
    {
        return $this->_getDataWithDefault('status', null);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getStart()
    {
        return $this->_getDataWithDefault('start', null);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getEnd()
    {
        return $this->_getDataWithDefault('end', null);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getDuration()
    {
        $start = $this->getStart();
        $end = $this->getEnd();

        return ($start === null || $end === null)
            ? null
            : $end - $start;
    }
}
