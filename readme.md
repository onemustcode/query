[![Build Status](https://travis-ci.org/onemustcode/query.svg?branch=master)](https://travis-ci.org/onemustcode/query)
[![Total Downloads](https://poser.pugx.org/onemustcode/query/d/total.svg)](https://packagist.org/packages/onemustcode/query)
[![Latest Stable Version](https://poser.pugx.org/onemustcode/query/v/stable)](https://packagist.org/packages/onemustcode/query)
[![License](https://poser.pugx.org/onemustcode/query/license)](https://packagist.org/packages/onemustcode/query)

# Query
It simply transforms the given filters, sortings and paging to a Doctrine or Eloquent query. Handy for interal usage or it can be used for API's.

## Installation
Require the Query library trough composer.
```
composer require onemustcode/query
```

## Query
The Query holds the paging, sortings, filters and includes.

Create new Query instance;
```
$query = new Query();
```

### Paging
Change the results per page;
```
$query->getPaging()->setPerPage(50);
```

Change the page;
```
$query->getPaging()->setPage(5);
```

Create an Query instance directly from given Paging object;
```
$query = Query::createFromPaging(new Paging(3, 40));
```

### Filtering
The following filters can be used;

| Type | Class |
|------|-------|
| Equals | new Equals('field', 'value') |
| Not Equals | new NotEquals('field', 'value') |
| Greather than | new GreatherThan('field', 20) |
| Greather than or Equals | new GreatherThanOrEquals('field', 25) |
| Less than | new LessThan('field', 50) |
| Less than or Equals | new LessThanOrEquals('field', 55) |
| Is null | new IsNull('field') |
| Is not null | new IsNotNull('field') |
| In | new In('field', '1,2,3,4,5') |
| Not in | new NotIn('field', '1,2,3,4,5') |
| Like | new Like('field', '%ohn%') |

Add new filter to existing Query instance;
```
$query->addFilter(new Equals('last_name', 'john'));
```

Create an Query instance directly from one or more filters;
```
$query = Query::createFromFilters([
    new Equals('name', 'john),
    new GreatherThan('age', 23),
]);
```

### Sorting
Add new sorting to existing Query instance;
```
$query->addSorting(new Ascending('last_name'));
```

Create an Query instance directly from one or more sortings;
```
$query = Query::createFromSortings([
    new Ascending('name'),
    new Descending('score'),
]);
```

### Includes
Add new include to existing Query instance;
```
$query->addInclude('posts.comments);
```

Create an Query instance directly from one or more includes;
```
$query = Query::createFromIncludes([
    'relation', 'some_other.relation'
]);
```

## Builder
_Warning: The Builder class is deprecated, use the transformer instead._

The builder turns an given array to an Query instance;

```
$data = [
    'per_page' => 20,
    'page' => 2,
    'filters' => [
        'age' => ['eq' => 15],
        'last_name' => ['like' => 'doe%'],
    ],
    'sortings' => [
        'first_name' => 'asc',
        'score' => 'desc',
    ],
];

$builder = new Builder($data);
$query = $builder->build();
```

# Transformer
The builder transforms an given array to an Query instance;
```
$data = [
    'per_page' => 20,
    'page' => 2,
    'filters' => [
        'age' => ['eq' => 15],
        'last_name' => ['like' => 'doe%'],
    ],
    'sortings' => [
        'first_name' => 'asc',
        'score' => 'desc',
    ],
];

$transformer = new Transformer();
$query = $transformer->transform($data);
```

It is possible to add your own custom filters.
In order to do this you should pass them as an associative array in the constructor (note that the filter should implement the OneMustCode\Query\Filters\FilterInterface]).
The key should be the filters's operator and the value the filter's FQN;
```
$transformer = new Transformer([CustomFilter::OPERATOR => CustomFilter::class]);
$query = $transformer->transform($data);
```

## Writer
The writer can export the given Query instance to json, query parameters and an array.

### Json
```
$writer = new Writer($query);
$parameters = $writer->toJson();
```

### Array
```
$writer = new Writer($query);
$parameters = $writer->toArray();
```

### Query parameters
```
$writer = new Writer($query);
$parameters = $writer->toQueryParameters();
```

## Doctrine Query Builder
The following example code shows you how to use the Doctrine Query Builder. Just pass the Query instance, Doctrine Query Builder, the accepted filters or sortings and it will automatically generate the query for you.

Example;
```
// Get the Doctrine Query Builder
$queryBuilder = $this->createQueryBuilder('e');

// Create new Query instance from given filters en sortings
$query = new Query(null, [
    new GreatherThan('age', 25),
    new LessThan('age', 55),
], [
    new Ascending('last_name')),
]);

// Only accept certain sortings that can be added to the doctrine query builder
$acceptedSortings = [
    // Given field => Doctrine property
    'age' => 'e.age',
];

// Only accept certain filters that can be added to the doctrine query builder
$acceptedFilters = [
    // Given field => Doctrine property
    'first_name' => 'e.firstName',
    'last_name' => 'e.lastName',
    'age' => 'e.age',
];

// Build the query
$queryBuilder = (new QueryBuilder())->build($query, $queryBuilder, $acceptedFilters, $acceptedSortings);

// Retrieve the results via Doctrine
$results = $queryBuilder->getQuery()->getResults();
```

It is possible to add your own custom filter handlers.
In order to do this you should pass in the handler in the QueryBuilder's constructor (note that the filter handler should implement the OneMustCode\Query\Builders\Doctrine\Filters\FilterHandlerInterface);
```
$queryBuilder = (new QueryBuilder([new CustomFilterHandler()]))->build($query, $queryBuilder, $acceptedFilters, $acceptedSortings);
```


License
----

MIT
