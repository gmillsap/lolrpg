<?php
namespace LolRpg\Resources\StaticData;

use LolRpg\Api\LolApi;

class ChampionById extends StatDataBase
{
    protected $api_url = '/api/lol/static-data/{region}/v1.2/champion/{id}';
    protected $path_params = array(
        '{region}' => '',
        '{id}'
    );
    protected $query_params = array(
        'local' => '',
        'version' => '',
        'champData' => array(
            'all' => '',
            'allytips' => '',
            'altimages' => '',
            'blurb' => '',
            'enemytips' => '',
            'image' => '',
            'info' => '',
            'lore' => '',
            'partype' => '',
            'passive' => '',
            'recommended' => '',
            'skins' => '',
            'spells' => '',
            'stats' => '',
            'tags' => ''
        )
    );

    public function findStaticChampionData(array $fetch_data) {
        $this->addQueryParam('champData', $fetch_data);
        $api = (new LolApi())
            ->makeRequest($this->generateApiUrl());
        if(!$api->wasRequestWasSuccessful()) {
            return array('error' => 'Failed to find champion data');
        }
        $champ_data = $api->getResult();
        return $champ_data;
    }
}
