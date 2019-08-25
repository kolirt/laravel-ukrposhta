<?php

namespace Kolirt\Ukrposhta\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getRegions(string $region_name = null, string $lang = 'uk')
 * @method static array getDistricts(string $district_name = null, int $region_id = null)
 * @method static array getCities(string $city_name = null, int $district_id = null, int $region_id = null)
 * @method static array getStreets(string $street_name = null, int $city_id = null, int $district_id = null, int $region_id = null)
 * @method static array getHouses(int $street_id, string $house_number = null)
 */
class Ukrposhta extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'ukrposhta';
    }

}