<?php

namespace OneMustCode\Query\Sorting;

class Ascending extends AbstractSorting implements SortingInterface
{
    const DIRECTION = 'asc';

    /**
     * @inheritdoc
     */
    public function getDirection()
    {
        return self::DIRECTION;
    }
}