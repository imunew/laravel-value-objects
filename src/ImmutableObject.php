<?php

namespace Imunew\Laravel\ValueObjects;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\JsonEncodingException;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Class ImmutableObject
 * @package Imunew\Laravel\ValueObjects
 */
abstract class ImmutableObject implements Immutable, Arrayable, Jsonable
{
    /** @var array */
    protected $attributes;

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name)
    {
        return $this->hasAccessor($name) || $this->hasAttribute($name);
    }

    /**
     * @param string $name
     * @param mixed|null $default
     * @return mixed
     */
    public function get(string $name, $default = null)
    {
        $value = null;
        if ($this->hasAccessor($name)) {
            $value = $this->callAccessor($name);
        }
        if ($this->hasAttribute($name)) {
            $value = $this->getAttribute($name);
        }
        return is_null($value) ? $default : $value;
    }

    /**
     * @param string $name
     * @return bool
     */
    protected function hasAttribute(string $name)
    {
        return Arr::has($this->attributes, $name);
    }

    /**
     * @param string $name
     * @return mixed
     */
    protected function getAttribute(string $name)
    {
        return Arr::get($this->attributes, $name);
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return static
     */
    protected function setAttribute(string $name, $value)
    {
        Arr::set($this->attributes, $name, $value);
        return $this;
    }

    /**
     * @param string $name
     * @return bool
     */
    protected function hasAccessor(string $name)
    {
        return method_exists($this, self::toAccessorMethodName($name));
    }

    /**
     * @param string $name
     * @return mixed
     */
    protected function callAccessor(string $name)
    {
        return $this->{self::toAccessorMethodName($name)}();
    }

    /**
     * @param string $name
     * @return string
     */
    private static function toAccessorMethodName(string $name)
    {
        return 'get'. Str::studly($name). 'Attribute';
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset(string $name)
    {
        return $this->has($name);
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function __get(string $name)
    {
        return $this->get($name);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->attributes;
    }

    /**
     * @param int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        $json = json_encode($this->toArray(), $options);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new JsonEncodingException('Error encoding value-object ['.get_class($this).'] to JSON: '. json_last_error_msg());
        }
        return (string) ($json ?? '');
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }
}
