# Laravel Ukrposhta
This package was created for [api UkrPoshta](https://dev.ukrposhta.ua/documentation).

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
- [Get streets](#get-streets)
- [Get houses](#get-houses)

### Get regions
Available $lang: uk, en.
```
Kolirt\Ukrposhta\Facade\Ukrposhta::getRegions([string $region_name = null [, string $lang = 'uk']]);
```
### Get districts
```
Kolirt\Ukrposhta\Facade\Ukrposhta::getDistricts([string $district_name = null [, int $region_id = null]]);
```

### Get cities
```
Kolirt\Ukrposhta\Facade\Ukrposhta::getCities([string $city_name = null [, int $district_id = null [, int $region_id = null]]]);
```

### Get streets
```
Kolirt\Ukrposhta\Facade\Ukrposhta::getStreets([string $street_name = null [, int $city_id = null [, int $district_id = null [, int $region_id = null]]]]);
```

### Get houses
```
Kolirt\Ukrposhta\Facade\Ukrposhta::getHouses(int $street_id [, string $house_number = null]);
```
