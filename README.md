
# CEBAF Graph Database

An application consisting of a database to store data sets of CEBAF graph objects and a web interface for locating and
retrieving them.

# Schema 

![schema diagram](schema.jpg)

# Command Line Usage

## Import data to create DataSet

```shell
artisan graph-data:import  ./tests/data/20221221_092324 --comment="First Data Set"
```

## List data sets
```shell
 cebaf-graph-db % sail artisan graph-data:list-sets
+----+-----------------------------+-----------------+
| ID | Created                     | Comment         |
+----+-----------------------------+-----------------+
| 1  | 2023-01-09T19:24:10.000000Z | First data set  |
| 2  | 2023-01-09T19:24:18.000000Z | Second data set |
+----+-----------------------------+-----------------+
```

## Append data to an existing DataSet

```shell
 # The number 2 is the data set id to which data is appended
 artisan graph-data:append 2 ./tests/data/20230109_104207 --label=foo 
```

## Append data to an existing DataSet

```shell
 # The number 2 is the data set id to which data is appended
 # Add --replace to prevent an error if timestamp already occupied
 artisan graph-data:append 2 ./tests/data/20230109_104207 --label=bar --replace
```


## Reference

Links for access to the reference documentation of toolkits used in the development of this application:

- [Laravel Livewire](https://laravel-livewire.com/docs/2.x/reference)
- [Laravel Livewire Tables](https://rappasoft.com/docs/laravel-livewire-tables/v2/introduction)
- [Bootstrap 4](https://getbootstrap.com/docs/4.6/getting-started/introduction/)
- [Tailwind CSS](https://tailwindcss.com/docs/utility-first)
- [Alpinejs](https://alpinejs.dev/start-here)
- [PEST](https://pestphp.com/docs/writing-tests)
