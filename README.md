# laravel-value-objects
[![CircleCI](https://circleci.com/gh/imunew/laravel-value-objects.svg?style=svg)](https://circleci.com/gh/imunew/laravel-value-objects)  
This package provides abstract Value Object (immutable) class and `make:value-object` command.

```bash
$ composer require imunew/laravel-value-objects
```

## abstract Value Object (immutable) class
The abstract ImmutableObject class has the following features.

- Inspired by Laravel's Eloquent Model
- Accessors (`get{Attribute}Attribute` method)
- Data is set only in the constructor

```php
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
```

## `make:value-object` command
You can create a ValueObject by executing the command as follows.

```bash
$ php artisan make:value-object {name}
```

## Example 1 (`Range`)

```php
namespace App\ValueObjects;

use Imunew\Laravel\ValueObjects\ImmutableObject;

class Range extends ImmutableObject
{
    /**
     * Range constructor.
     * @param int $start
     * @param int $end
     * @param int $step
     */
    public function __construct(int $start, int $end, int $step = 1)
    {
        $this->setAttribute('start', $start);
        $this->setAttribute('end', $end);
        $this->setAttribute('step', $step);
    }

    /**
     * @return array
     */
    public function getRangeAttribute()
    {
        return range($this->start, $this->end, $this->step);
    }
}
```

```php
$range = new Range(1, 10);
echo $range;
// [1,2,3,4,5,6,7,8,9,10]
```

## Example 2 (`DirectoryTree`)
```php
namespace App\ValueObjects;

use Imunew\Laravel\ValueObjects\ImmutableObject;

class DirectoryTree extends ImmutableObject
{
    /**
     * Range constructor.
     * @param array $directoryTree
     */
    public function __construct(array $directoryTree)
    {
        $this->attributes = $directoryTree;
    }
}
```

```php
$directoryTree = new DirectoryTree([
    'app' => [
        'Http' => [
            'Controllers' => [],
            'Middleware' => [],
            'Requests' => [],
            'Resources' => [],
        ],
        'ValueObjects' => []
    ]
]);

echo json_encode($directoryTree->get('app.Http'));
// {"Controllers":[],"Middleware":[],"Requests":[],"Resources":[]}
```
