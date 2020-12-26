<?php

namespace Tests\ValueObjects;

use Imunew\Laravel\ValueObjects\ImmutableObject;

/**
 * Class DirectoryTree
 * @package Tests\ValueObjects
 */
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
