<?php

namespace Imunew\Laravel\ValueObjects;

/**
 * Interface Immutable
 * @package Imunew\Laravel\ValueObjects
 */
interface Immutable
{
    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name);

    /**
     * @param string $name
     * @param mixed|null $default
     * @return mixed
     */
    public function get(string $name, $default = null);
}
