<?php
namespace LolRpg\Resources\ChampionMastery;

use LolRpg\Api\LolApi;
use LolRpg\Resources\ResourceBase;

class Score extends ResourceBase
{
    protected $api_url = '/championmastery/location/{platformId}/player/{playerId}/score';
    protected $path_params = array(
        '{platformId}' => '',
        '{playerId}' => ''
    );
    
    public function findForPlayer($player_id) {
        if(empty($player_id) || intval($player_id) <= 0) {
            return array('error' => 'Invalid player id');
        }
        $this->addPathParam('{playerId}', $player_id);
        $api = (new LolApi())
            ->makeRequest($this->generateApiUrl());
        if(!$api->wasRequestWasSuccessful()) {
            return array('error' => 'Failed to find Free to Play Champions');
        }
        $score = $api->getResult();
        return $score;
    }

}
