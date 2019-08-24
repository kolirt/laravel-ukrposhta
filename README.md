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
- [Get regions](#get-regions)
- [Get districts](#get-districts)
- [Get cities](#get-cities)

#### Get regions
Available $lang: uk, en.
```
Kolirt\Ukrposhta\Facade\Ukrposhta::getRegions([string $region_name = null [, string $lang = 'uk']]);
```
#### Get districts
```
Kolirt\Ukrposhta\Facade\Ukrposhta::getDistricts([string $district_name = null [, int $region_id = null]]);
```

#### Get cities
```
Kolirt\Ukrposhta\Facade\Ukrposhta::getCities([string $city_name = null [, int $district_id = null [, int $region_id = null]]]);
```