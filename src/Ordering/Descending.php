<?php

namespace OneMustCode\Query\Ordering;

class Descending extends AbstractOrdering implements OrderingInterface
{
    /**
     * @inheritdoc
     */
    public function getDirection()
    {
        return 'desc';
    }
}