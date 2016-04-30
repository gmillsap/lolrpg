<?php
namespace LolRpg\Resources\Summoner;

use LolRpg\Api\LolApi;
use LolRpg\Resources\ResourceBase;

class SummonerByName extends ResourceBase
{
    protected $api_url = '/api/lol/{region}/v1.4/summoner/by-name/{summonerNames}';
    protected $path_params = array(
        '{region}' => '',
        '{summonerNames}' => ''
    );

    public function findSummonerData($summoner_name) {
        $this->addPathParam('{summonerNames}', $summoner_name);
        lolrpg_log($this->generateApiUrl());
        $api = (new LolApi())
            ->makeRequest($this->generateApiUrl());
        if(!$api->wasRequestWasSuccessful()) {
            return array('error' => 'Failed to find summoner data');
        }
        $summoner_data = $api->getResult();
        return $summoner_data[$summoner_name];
    }
}
