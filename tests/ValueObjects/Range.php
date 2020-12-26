<?php

namespace Tests\ValueObjects;

use Imunew\Laravel\ValueObjects\ImmutableObject;

/**
 * Class Range
 * @package Tests\ValueObjects
 *
 * @property-read int $start
 * @property-read int $end
 * @property-read int $step
 * @property-read array|int[] $range
 */
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
