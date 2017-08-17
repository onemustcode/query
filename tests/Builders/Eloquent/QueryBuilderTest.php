<?php

namespace OneMustCode\Query\Tests\Builders\Eloquent;

use OneMustCode\Query\Builders\Eloquent\QueryBuilder;
use OneMustCode\Query\Query;
use OneMustCode\Query\Paging\Paging;
use OneMustCode\Query\Sorting\Ascending;
use OneMustCode\Query\Sorting\Descending;
use OneMustCode\Query\Filters\Equals;
use OneMustCode\Query\Filters\GreaterThan;
use OneMustCode\Query\Filters\GreaterThanOrEquals;
use OneMustCode\Query\Filters\In;
use OneMustCode\Query\Filters\IsNotNull;
use OneMustCode\Query\Filters\LessThan;
use OneMustCode\Query\Filters\LessThanOrEquals;
use OneMustCode\Query\Filters\Like;
use OneMustCode\Query\Filters\NotEquals;
use OneMustCode\Query\Filters\NotIn;

class QueryBuilderTest extends AbstractTest
{
    public function testBuildQuery()
    {
        $queryBuilder = new QueryBuilder();

        $query = new Query();

        $model = $queryBuilder->build($query, $this->getModel(), [], []);

        $this->assertNull($model->getQuery()->wheres);
        $this->assertNull($model->getQuery()->orders);
    }

    public function testFilters()
    {
        $queryBuilder = new QueryBuilder();

        $query = Query::createFromFilters([
            new Equals('name', 'john'),
            new GreaterThan('age', 20),
            new LessThan('age', 50),
        ]);

        $model = $queryBuilder->build($query, $this->getModel(), [
            'name' => 'name',
            'age' => 'age',
        ], []);

        $this->assertEquals(
            [
                [
                    'type' => 'Basic',
                    'column' => 'name',
                    'operator' => '=',
                    'value' => 'john',
                    'boolean' => 'and',
                ],
                [
                    'type' => 'Basic',
                    'column' => 'age',
                    'operator' => '>',
                    'value' => 20,
                    'boolean' => 'and',
                ],
                [
                    'type' => 'Basic',
                    'column' => 'age',
                    'operator' => '<',
                    'value' => 50,
                    'boolean' => 'and',
                ],
            ],
            $model->getQuery()->wheres
        );

        $this->assertNull($model->getQuery()->orders);
    }

    public function testSortings()
    {
        $queryBuilder = new QueryBuilder();

        $query = Query::createFromSortings([
            new Ascending('name'),
            new Descending('age'),
        ]);

        $model = $queryBuilder->build($query, $this->getModel(), [], [
            'name' => 'name',
            'age' => 'age',
        ]);

        $this->assertEquals(
            [
                [
                    'column' => 'name',
                    'direction' => 'asc',
                ],
                [
                    'column' => 'age',
                    'direction' => 'desc',
                ],
            ],
            $model->getQuery()->orders
        );

        $this->assertNull($model->getQuery()->wheres);
    }

    protected function getModel()
    {
        return Model::query();
    }
}