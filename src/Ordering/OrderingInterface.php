<?php

namespace OneMustCode\Query\Ordering;

interface OrderingInterface
{
    /**
     * @return string
     */
    public function getField();

    /**
     * @return string
     */
    public function getDirection();
}