<?php

namespace RebelCode\Bookings;

use Exception as RootException;
use InvalidArgumentException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Dhii\Util\String\StringableInterface as Stringable;

/**
 * Functionality for retrieving data, using a default if a value is not found.
 *
 * @since [*next-version*]
 */
trait GetDataWithDefaultCapableTrait
{
    /**
     * Retrieves data by key, or a default value if data is not found.
     *
     * @since [*next-version*]
     *
     * @param string|Stringable $key     The key for which to get the data.
     * @param mixed|null        $default The default value to return if the data is not found.
     *
     * @return mixed The value that corresponds to the given key, or the default value if it's not found.
     */
    protected function _getDataWithDefault($key, $default = null)
    {
        try {
            return $this->_getData($key);
        } catch (RootException $exception) {
            return $default;
        }
    }

    /**
     * Retrieve data, all or by key.
     *
     * @since [*next-version*]
     *
     * @param string|int|float|bool|Stringable $key The key, for which to get the data.
     *                                              Unless an integer is given, this will be normalized to string.
     *
     * @throws InvalidArgumentException    If key is invalid.
     * @throws ContainerExceptionInterface If an error occurred while reading from the container.
     * @throws NotFoundExceptionInterface  If the key was not found in the container.
     *
     * @return mixed The value for the specified key.
     */
    abstract protected function _getData($key);
}
