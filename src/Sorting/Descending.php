<?php

namespace OneMustCode\Query\Sorting;

class Descending extends AbstractSorting implements SortingInterface
{
    const DIRECTION = 'desc';

    /**
     * @inheritdoc
     */
    public function getDirection()
    {
        return self::DIRECTION;
    }
}