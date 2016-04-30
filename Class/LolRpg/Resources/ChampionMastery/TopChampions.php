<?php
namespace LolRpg\Resources\ChampionMastery;

use LolRpg\Api\LolApi;
use LolRpg\Resources\ResourceBase;

class TopChampions extends ResourceBase
{
    protected $api_url = '/championmastery/location/{platformId}/player/{playerId}/topchampions';
    protected $path_params = array(
        '{platformId}' => '',
        '{playerId}' => ''
    );
    protected $query_params = array(
        'count' => ''
    );
    
    public function findTopTenForPlayer($player_id) {
        return $this->findForPlayer($player_id, 10);
    }

    public function findForPlayer($player_id, $count) {
        if(empty($player_id) || intval($player_id) <= 0) {
            return array('error' => 'Invalid player id');
        }
        if(empty($count) || intval($count) <= 0) {
            return array('error' => 'Invalid top champion count');
        }
        $this->addPathParam('{playerId}', $player_id)
            ->addQueryParam('count', $count);
        $api = (new LolApi())
            ->makeRequest($this->generateApiUrl());
        if(!$api->wasRequestWasSuccessful()) {
            return array('error' => 'Failed to find Free to Play Champions');
        }
        $top_champ_data = $api->getResult();
        return $top_champ_data;
    }

}
