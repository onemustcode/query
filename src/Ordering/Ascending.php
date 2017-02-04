<?php

namespace OneMustCode\Query\Ordering;

class Ascending extends AbstractOrdering implements OrderingInterface
{
    /**
     * @inheritdoc
     */
    public function getDirection()
    {
        return 'asc';
    }
}