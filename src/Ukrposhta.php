<?php

namespace Kolirt\Ukrposhta;

use GuzzleHttp\Client;
use Exception;
use phpDocumentor\Reflection\Types\Integer;

class Ukrposhta
{

    private $client;
    private $api = 'https://ukrposhta.ua/';

    const ADDRESS_CLASSIFIER = 'address-classifier';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->api,
            //            'timeout'  => config('ukrposhta.timeout', 3),
            'headers'  => [
                'Accept' => 'application/json'
            ]
        ]);
    }

    /*
     * Get regions
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

    /*
     * Get regions
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

    /*
     * Get regions
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



}