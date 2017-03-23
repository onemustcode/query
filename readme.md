# Query
todo: fix what Query is, add more info abouth the filters, sortings, paging and includes.

## Installation
Require the Query library trough composer.
```
composer require onemustwork/query
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
    'age' => 'age',
];

// Only accept certain filters that can be added to the doctrine query builder
$acceptedFilters = [
    // Given field => Doctrine property
    'first_name' => 'first_name',
    'last_name' => 'last_name',
    'age' => 'age',
];

// Build the query
$queryBuilder = (DoctrineQueryBuilder())->build($query, $queryBuilder, $acceptedFilters, $acceptedSortings);

// Retrieve the results via Doctrine
$results = $queryBuilder->getQuery()->getResults();
```

License
----

MIT
