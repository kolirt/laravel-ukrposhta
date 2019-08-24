<?php

namespace Kolirt\Ukrposhta;

use GuzzleHttp\Client;
use Exception;

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
     * Get all regions
     */
    public function getRegions()
    {
        $request = $this->client->get(self::ADDRESS_CLASSIFIER . '/get_regions_by_region_ua', [
            'query' => []
        ]);

        $response = json_decode($request->getBody()->getContents());
        return $response->Entries->Entry ?? [];
    }

    /*
     * Get regions by name
     */
    public function getRegionsByName(string $region_name, string $lang = 'uk')
    {
        if (!in_array($lang, ['uk', 'en'])) {
            throw new Exception('Invalid language. Available languages: uk, en.');
        }

        $query = [];

        if ($lang == 'en') {
            $query['region_name_en'] = $region_name;
        } else {
            $query['region_name'] = $region_name;
        }

        $request = $this->client->get(self::ADDRESS_CLASSIFIER . '/get_regions_by_region_ua', [
            'query' => $query
        ]);

        $response = json_decode($request->getBody()->getContents());
        return $response->Entries->Entry ?? [];
    }

}