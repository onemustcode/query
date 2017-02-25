<?php

namespace OneMustCode\Query\Sorting;

class Ascending extends AbstractSorting implements SortingInterface
{
    /**
     * @inheritdoc
     */
    public function getDirection()
    {
        return 'asc';
    }
}