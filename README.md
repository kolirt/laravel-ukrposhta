# Laravel Ukrposhta

## Installation
```
$ composer require kolirt/laravel-ukposhta
```
```
$ php artisan ukrposhta:install
```

## Methods
All available methods:
- [Get all regions](#get-all-regions)
- [Get regions by name](#get-regions-by-name)

#### Get all regions
```
Kolirt\Ukrposhta\Facade\Ukrposhta::getRegions();
```

#### Get regions by name
Available $lang: uk, en.
```
Kolirt\Ukrposhta\Facade\Ukrposhta::getRegionsByName(string $region_name, string $lang = 'uk');
```