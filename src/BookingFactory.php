<?php

namespace RebelCode\Bookings;

use Dhii\Collection\MapFactoryInterface;
use Dhii\Data\Container\ContainerFactoryInterface;
use Dhii\Data\Container\ContainerGetCapableTrait;
use Dhii\Data\Container\CreateContainerExceptionCapableTrait;
use Dhii\Data\Container\CreateNotFoundExceptionCapableTrait;
use Dhii\Data\Object\NormalizeKeyCapableTrait;
use Dhii\Factory\AbstractBaseCallbackFactory;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Implementation of a booking factory.
 *
 * @since [*next-version*]
 */
class BookingFactory extends AbstractBaseCallbackFactory implements BookingFactoryInterface, MapFactoryInterface
{
    /* @since [*next-version*] */
    use ContainerGetCapableTrait;

    /* @since [*next-version*] */
    use NormalizeKeyCapableTrait;

    /* @since [*next-version*] */
    use CreateContainerExceptionCapableTrait;

    /* @since [*next-version*] */
    use CreateNotFoundExceptionCapableTrait;

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

            try {
                $data = $this->_containerGet($config, BookingFactoryInterface::K_DATA);
            } catch (NotFoundExceptionInterface $exception) {
                $data = [];
            }

            return new Booking($data);
        };
    }
}
