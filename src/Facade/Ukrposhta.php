<?php

namespace Kolirt\Ukrposhta\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getRegions()
 * @method static array getRegionsByName(string $region_name, string $lang = 'uk')
 */
class Ukrposhta extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'ukrposhta';
    }

}