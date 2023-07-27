<?php

namespace Kolirt\Ukrposhta\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getRegions(string $region_name = null, string $lang = 'uk')
 * @method static array getDistricts(string $district_name = null, int $region_id = null)
 * @method static array getCities(string $city_name = null, int $district_id = null, int $region_id = null)
 * @method static array getStreets(string $street_name = null, int $city_id = null, int $district_id = null, int $region_id = null)
 * @method static array getHouses(int $street_id, string $house_number = null)
 * @method static array getPostOffices(string $zip_code = null, int $street_id = null, int $city_id = null, int $district_id = null, int $region_id = null, int $additionally_city_id = null, int $additionally_district_id = null, int $additionally_region_id = null)
 * @method static array getPostOfficesOpenHours(string $zip_code, int $post_office_id = null)
 * @method static array getPostOfficesByGeolocation(float $lat, float $lng, int $radius = 1)
 * @method static array getCitiesByPostcode(string $zip, string $lang = 'uk')
 * @method static array getAddressesByPostcode(string $zip, string $lang = 'uk')
 */
class Ukrposhta extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'ukrposhta';
    }

}