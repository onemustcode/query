<?php

namespace OneMustCode\Query\Sorting;

class Descending extends AbstractSorting implements SortingInterface
{
    /**
     * @inheritdoc
     */
    public function getDirection()
    {
        return 'desc';
    }
}