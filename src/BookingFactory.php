<?php

namespace RebelCode\Bookings;

use ArrayObject;
use Dhii\Factory\AbstractBaseCallbackFactory;
use stdClass;

/**
 * Implementation of a booking factory.
 *
 * @since [*next-version*]
 */
class BookingFactory extends AbstractBaseCallbackFactory implements BookingFactoryInterface
{
    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function make($config = null)
    {
        return parent::make($config);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _getFactoryCallback($config = null)
    {
        return function() use ($config) {
            if ($config === null) {
                $config = [];
            }

            if (!is_array($config) && !($config instanceof stdClass) && !($config instanceof ArrayObject)) {
                throw $this->_createInvalidArgumentException(
                    $this->__('Config is not a valid data set'),
                    null,
                    null,
                    $config
                );
            }

            return new Booking($config);
        };
    }
}
