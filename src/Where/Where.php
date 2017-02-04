<?php

namespace OneMustCode\Query\Where;

use OneMustCode\Query\Where\Comparisons\ComparisonInterface;

class Where implements WhereInterface
{
    /** @var string */
    private $field;

    /** @var ComparisonInterface */
    private $comparison;

    /**
     * @param string $field
     * @param ComparisonInterface $comparison
     */
    public function __construct($field, ComparisonInterface $comparison)
    {
       $this->field = $field;
       $this->comparison = $comparison;
    }

    /**
     * @inheritdoc
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @inheritdoc
     */
    public function getComparison()
    {
        return $this->comparison;
    }
}