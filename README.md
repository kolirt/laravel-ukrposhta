# Laravel Ukrposhta
This package was created for [UkrPoshta API](https://dev.ukrposhta.ua/documentation).

## Installation
```
$ composer require kolirt/laravel-ukrposhta
```
```
$ php artisan ukrposhta:install
```

## Methods
All available methods:
- [Address classifier](#address-classifier)
    - [Get regions](#get-regions) - сервіс для отримання переліку областей (з можливістю пошуку за частиною назви).
    - [Get districts](#get-districts) - сервіс для отримання переліку районів (з можливістю пошуку за частиною назви).
    - [Get cities](#get-cities) - сервіс для отримання переліку населених пунктів (з можливістю пошуку за частиною назви).
    - [Get streets](#get-streets) - сервіс для отримання переліку вулиць населених пунктів міст із деталізацією району та області (з можливістю пошуку за частиною назви).
    - [Get houses](#get-houses) - сервіс для отримання переліку будинків вулиць (з можливістю пошуку за ідентифікатором вулиці).
    - [Get post offices](#get-post-offices) - сервіс для отримання інформації про поштове відділення (з можливістю пошуку за індексом поштового відділення).
    - [Get post offices open hours](#get-post-offices-open-hours) - cервіс для отримання інформації про графік роботи поштового відділення (з можливістю пошуку за індексом поштового відділення).
    - [Get post offices by geolocation](#get-post-offices-by-geolocation) - сервіс для отримання інформації про найближчі поштові відділення (з можливістю пошуку за геокоординатами).
    - [Get city by postcode](#get-city-by-postcode) - сервіс для отримання інформації про область, район і населений пункт за індексом (з можливістю отримання інформації на різних мовах).
    - [Get address by postcode](#get-address-by-postcode) - сервіс для отримання адресної інформації за індексом (з можливістю отримання інформації на різних мовах).

### Address classifier

#### Get regions
Сервіс для отримання переліку областей (з можливістю пошуку за частиною назви).

Available $lang: uk, en.
```
Kolirt\Ukrposhta\Facade\Ukrposhta::getRegions([string $region_name = null [, string $lang = 'uk']]);
```
#### Get districts
Сервіс для отримання переліку районів (з можливістю пошуку за частиною назви).
```
Kolirt\Ukrposhta\Facade\Ukrposhta::getDistricts([string $district_name = null [, int $region_id = null]]);
```

#### Get cities
Сервіс для отримання переліку населених пунктів (з можливістю пошуку за частиною назви).
```
Kolirt\Ukrposhta\Facade\Ukrposhta::getCities([string $city_name = null [, int $district_id = null [, int $region_id = null]]]);
```

#### Get streets
Сервіс для отримання переліку вулиць населених пунктів міст із деталізацією району та області (з можливістю пошуку за частиною назви).
```
Kolirt\Ukrposhta\Facade\Ukrposhta::getStreets([string $street_name = null [, int $city_id = null [, int $district_id = null [, int $region_id = null]]]]);
```

#### Get houses
Сервіс для отримання переліку будинків вулиць (з можливістю пошуку за ідентифікатором вулиці).
```
Kolirt\Ukrposhta\Facade\Ukrposhta::getHouses(int $street_id [, string $house_number = null]);
```

#### Get post offices
Сервіс для отримання інформації про поштове відділення (з можливістю пошуку за індексом поштового відділення).
```
Kolirt\Ukrposhta\Facade\Ukrposhta::getPostOffices([string $zip_code = null [, int $street_id = null [, int $city_id = null [, int $district_id = null [, int $region_id = null [, int $additionally_city_id = null [, int $additionally_district_id = null [, int $additionally_region_id = null]]]]]]]]);
```

#### Get post offices open hours
Сервіс для отримання інформації про графік роботи поштового відділення (з можливістю пошуку за індексом поштового відділення).
```
Kolirt\Ukrposhta\Facade\Ukrposhta::getPostOfficesOpenHours(string $zip_code [, int $post_office_id = null]);
```

#### Get post offices by geolocation
Сервіс для отримання інформації про найближчі поштові відділення (з можливістю пошуку за геокоординатами).
```
Kolirt\Ukrposhta\Facade\Ukrposhta::getPostOfficesByGeolocation(float $lat, float $lng [, int $radius = 1]);
```

#### Get city by postcode
Сервіс для отримання інформації про область, район і населений пункт за індексом (з можливістю отримання інформації на різних мовах).

Available $lang: uk, en, ru.
```
Kolirt\Ukrposhta\Facade\Ukrposhta::getCitiesByPostcode(string $zip [, string $lang = 'uk']);
```

#### Get address by postcode
Сервіс для отримання адресної інформації за індексом (з можливістю отримання інформації на різних мовах).

Available $lang: uk, en, ru.
```
Kolirt\Ukrposhta\Facade\Ukrposhta::getAddressesByPostcode(string $zip [, string $lang = 'uk']);
```
