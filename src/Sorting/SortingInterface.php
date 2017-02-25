<?php

namespace OneMustCode\Query\Sorting;

interface SortingInterface
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