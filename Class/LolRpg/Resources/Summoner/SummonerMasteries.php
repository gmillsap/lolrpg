<?php
namespace LolRpg\Resources\Summoner;

use LolRpg\Api\LolApi;
use LolRpg\Resources\ResourceBase;

class SummonerMasteries extends ResourceBase
{
    protected $api_url = '/api/lol/{region}/v1.4/summoner/{summonerIds}/masteries';
    protected $path_params = array(
        '{region}' => '',
        '{summonerIds}' => ''
    );
    
    public function findSummonerMasteryData($summoner_id) {
        $this->addPathParam('{summonerIds}', $summoner_id);
        $api = (new LolApi())
            ->makeRequest($this->generateApiUrl());
        if(!$api->wasRequestWasSuccessful()) {
            return array('error' => 'Failed to find summoner mastery data');
        }
        $mastery_data = $api->getResult();
        return $mastery_data;
    }
}
