<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 8/18/16
 * Time: 8:02 PM
 */

namespace HallsApplication\Service;


use Elasticsearch\ClientBuilder;

class ElasticSearchService
{
    public function search($term)
    {
        $client = ClientBuilder::create()->build();

        $params = [
            'index' => 'hall',
            'type' => 'hall',
            'body' => [
                'query' => [
                    'bool' => [
                        'should' => [
                            ['fuzzy' => ['name' => $term]],
                            ['fuzzy' => ['address_first_line' => $term]],
                            ['fuzzy' => ['address_second_line' => $term]],
                            ['fuzzy' => ['address_city' => $term]],
                            ['fuzzy' => ['address_postcode' => $term]]
                        ]
                    ]
                ]
            ]
        ];

        $response = $client->search($params);

        return $response;
    }
}