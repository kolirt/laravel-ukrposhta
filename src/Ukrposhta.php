<?php

namespace Kolirt\Ukrposhta;

use GuzzleHttp\Client;
use Exception;
use mysql_xdevapi\Collection;
use phpDocumentor\Reflection\Types\Integer;

class Ukrposhta
{

    private $client;
    private $api;

    const COUNTRY_CODES = [
        'uk' => 'UA',
        'en' => 'EN',
        'ru' => 'RU'
    ];

    const ADDRESS_CLASSIFIER = 'address-classifier';

    public function __construct()
    {
        $this->api = config('ukrposhta.api');

        $this->client = new Client([
            'base_uri' => $this->api,
            'timeout'  => config('ukrposhta.timeout', 3),
            'headers'  => [
                'Accept' => 'application/json'
            ]
        ]);
    }

    /**
     * Сервіс для отримання переліку областей (з можливістю пошуку за частиною назви).
     *
     * @param string|null $region_name
     * @param string $lang
     * @return array
     * @throws Exception
     */
    public function getRegions(string $region_name = null, string $lang = 'uk'): array
    {
        if (!in_array($lang, ['uk', 'en'])) {
            throw new Exception('Invalid language. Available languages: uk, en.');
        }

        $query = [];
        if (!empty($region_name)) {
            if ($lang == 'en') {
                $query['region_name_en'] = $region_name;
            } else {
                $query['region_name'] = $region_name;
            }
        }

        $request = $this->client->get(self::ADDRESS_CLASSIFIER . '/get_regions_by_region_ua', [
            'query' => $query
        ]);

        $response = json_decode($request->getBody()->getContents());
        return $response->Entries->Entry ?? [];
    }

    /**
     * Сервіс для отримання переліку районів (з можливістю пошуку за частиною назви).
     *
     * @param string|null $district_name
     * @param int|null $region_id
     * @return array
     */
    public function getDistricts(string $district_name = null, int $region_id = null): array
    {
        $query = [];
        if (!empty($district_name)) {
            $query['district_ua'] = $district_name;
        }
        if (!empty($region_id)) {
            $query['region_id'] = $region_id;
        }

        $request = $this->client->get(self::ADDRESS_CLASSIFIER . '/get_districts_by_region_id_and_district_ua', [
            'query' => $query
        ]);

        $response = json_decode($request->getBody()->getContents());
        return $response->Entries->Entry ?? [];
    }

    /**
     * Сервіс для отримання переліку населених пунктів (з можливістю пошуку за частиною назви).
     *
     * @param string|null $city_name
     * @param int|null $district_id
     * @param int|null $region_id
     * @return array
     */
    public function getCities(string $city_name = null, int $district_id = null, int $region_id = null): array
    {
        $query = [];
        if (!empty($city_name)) {
            $query['city_ua'] = $city_name;
        }
        if (!empty($district_id)) {
            $query['district_id'] = $district_id;
        }
        if (!empty($region_id)) {
            $query['region_id'] = $region_id;
        }

        $request = $this->client->get(self::ADDRESS_CLASSIFIER . '/get_city_by_region_id_and_district_id_and_city_ua', [
            'query' => $query
        ]);

        $response = json_decode($request->getBody()->getContents());
        return $response->Entries->Entry ?? [];
    }

    /**
     * Сервіс для отримання переліку вулиць населених пунктів міст із деталізацією району та області (з можливістю пошуку за частиною назви).
     *
     * @param string|null $street_name
     * @param int|null $city_id
     * @param int|null $district_id
     * @param int|null $region_id
     * @return array
     */
    public function getStreets(string $street_name = null, int $city_id = null, int $district_id = null, int $region_id = null): array
    {
        $query = [];
        if (!empty($street_name)) {
            $query['street_ua'] = $street_name;
        }
        if (!empty($city_id)) {
            $query['city_id'] = $city_id;
        }
        if (!empty($district_id)) {
            $query['district_id'] = $district_id;
        }
        if (!empty($region_id)) {
            $query['region_id'] = $region_id;
        }

        $request = $this->client->get(self::ADDRESS_CLASSIFIER . '/get_street_by_region_id_and_district_id_and_city_id_and_street_ua', [
            'query' => $query
        ]);

        $response = json_decode($request->getBody()->getContents());
        return $response->Entries->Entry ?? [];
    }

    /**
     * Сервіс для отримання переліку будинків вулиць (з можливістю пошуку за ідентифікатором вулиці).
     *
     * @param int $street_id
     * @param string|null $house_number
     * @return array
     */
    public function getHouses(int $street_id, string $house_number = null): array
    {
        $query = [];
        $query['street_id'] = $street_id;
        if (!empty($house_number)) {
            $query['housenumber'] = $house_number;
        }

        $request = $this->client->get(self::ADDRESS_CLASSIFIER . '/get_addr_house_by_street_id', [
            'query' => $query
        ]);

        $response = json_decode($request->getBody()->getContents());
        return $response->Entries->Entry ?? [];
    }

    /**
     * Сервіс для отримання інформації про поштове відділення (з можливістю пошуку за індексом поштового відділення).
     *
     * @param string|null $zip_code
     * @param int|null $street_id
     * @param int|null $city_id
     * @param int|null $district_id
     * @param int|null $region_id
     * @param int|null $additionally_city_id
     * @param int|null $additionally_district_id
     * @param int|null $additionally_region_id
     * @return array
     */
    public function getPostOffices(string $zip_code = null, int $street_id = null, int $city_id = null, int $district_id = null, int $region_id = null, int $additionally_city_id = null, int $additionally_district_id = null, int $additionally_region_id = null): array
    {
        $query = [];
        if (!empty($zip_code)) {
            $query['pi'] = $zip_code;
        }
        if (!empty($street_id)) {
            $query['poStreetId'] = $street_id;
        }
        if (!empty($city_id)) {
            $query['poCityId'] = $city_id;
        }
        if (!empty($district_id)) {
            $query['poDistrictId'] = $district_id;
        }
        if (!empty($region_id)) {
            $query['poRegionId'] = $region_id;
        }
        if (!empty($additionally_city_id)) {
            $query['pdCityId'] = $additionally_city_id;
        }
        if (!empty($additionally_district_id)) {
            $query['pdDistrictId'] = $additionally_district_id;
        }
        if (!empty($additionally_region_id)) {
            $query['pdRegionId'] = $additionally_region_id;
        }

        $request = $this->client->get(self::ADDRESS_CLASSIFIER . '/get_postoffices_by_postindex', [
            'query' => $query
        ]);

        $response = json_decode($request->getBody()->getContents());
        return $response->Entries->Entry ?? [];
    }

    /**
     * Сервіс для отримання інформації про графік роботи поштового відділення (з можливістю пошуку за індексом поштового відділення).
     *
     * @param string $zip_code
     * @param int|null $post_office_id
     * @return array
     */
    public function getPostOfficesOpenHours(string $zip_code, int $post_office_id = null): array
    {
        $query = [];
        if (!empty($zip_code)) {
            $query['pc'] = $zip_code;
        }
        if (!empty($post_office_id)) {
            $query['id'] = $post_office_id;
        }

        $request = $this->client->get(self::ADDRESS_CLASSIFIER . '/get_postoffices_openhours_by_postindex', [
            'query' => $query
        ]);

        $response = json_decode($request->getBody()->getContents());
        $response = $response->Entries->Entry ?? [];
        return !empty($post_office_id) ? $response : collect($response)->groupBy('id')->toArray();
    }

    /**
     * Сервіс для отримання інформації про найближчі поштові відділення (з можливістю пошуку за геокоординатами).
     *
     * @param float $lat
     * @param float $lng
     * @param int $radius
     * @return array
     */
    public function getPostOfficesByGeolocation(float $lat, float $lng, int $radius = 1): array
    {
        $query = [];
        $query['lat'] = $lat;
        $query['long'] = $lng;
        $query['maxdistance'] = $radius;

        $request = $this->client->get(self::ADDRESS_CLASSIFIER . '/get_postoffices_by_geolocation', [
            'query' => $query
        ]);

        $response = json_decode($request->getBody()->getContents());
        return $response->Entries->Entry ?? [];
    }

    /**
     * Сервіс для отримання інформації про область, район і населений пункт за індексом (з можливістю отримання інформації на різних мовах).
     *
     * @param string $zip
     * @param string $lang
     * @return array
     * @throws Exception
     */
    public function getCitiesByPostcode(string $zip, string $lang = 'uk'): array
    {
        if (!in_array($lang, ['uk', 'en', 'ru'])) {
            throw new Exception('Invalid language. Available languages: uk, en, ru.');
        }

        $query = [];
        $query['postcode'] = $zip;
        $query['lang'] = self::COUNTRY_CODES[$lang];

        $request = $this->client->get(self::ADDRESS_CLASSIFIER . '/get_city_details_by_postcode', [
            'query' => $query
        ]);

        $response = json_decode($request->getBody()->getContents());
        return $response->Entries->Entry ?? [];
    }

    /**
     * Сервіс для отримання адресної інформації за індексом (з можливістю отримання інформації на різних мовах).
     *
     * @param string $zip
     * @param string $lang
     * @return array
     * @throws Exception
     */
    public function getAddressesByPostcode(string $zip, string $lang = 'uk'): array
    {
        if (!in_array($lang, ['uk', 'en', 'ru'])) {
            throw new Exception('Invalid language. Available languages: uk, en, ru.');
        }

        $query = [];
        $query['postcode'] = $zip;
        $query['lang'] = self::COUNTRY_CODES[$lang];

        $request = $this->client->get(self::ADDRESS_CLASSIFIER . '/get_address_by_postcode', [
            'query' => $query
        ]);

        $response = json_decode($request->getBody()->getContents());
        return $response->Entries->Entry ?? [];
    }

}
