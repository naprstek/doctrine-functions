DoctrineFunctions
==================

A set of extensions to Doctrine 2 that add support for additional query functions available in MSSQL.

This library is inspired by DoctrineExpressions, see here: [https://github.com/beberlei/DoctrineExtensions]. It contains a lot of functions for other DB.

The namespace were preserved as they are in DoctrineExtensions, so those two library can be used together.

| DB | Functions |
|:--:|:---------:|
| MSSQL | `CAST, FORMAT, ISNULL, GETDATE, MONTH, YEAR` |

Installation
------------

To install this library, run the command below and you will get the latest
version:

```sh
composer require naprstek/doctrine-functions
```

Integration to application
--------------------------
in module.config.php add to doctrine section and name function you need. Functions are not added automaticaly (to decrease dependencies and speed up):
```php
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                ...
            ],
        ],
        'configuration' => [
            'orm_default' => [ //User Defined Functions
                'string_functions' => [
                    'format' => 'DoctrineFunctions\Query\Mssql\Format',
                    ...
                ],
                'datetime_functions' => [], //when they exist
                'numeric_functions' => [], //when they exist
            ],
        ],
    ],
```