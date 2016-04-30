<?php
namespace LolRpg\Resources\Champion;

use LolRpg\Api\LolApi;
use LolRpg\Resources\ResourceBase;

class Champion extends ResourceBase
{
    protected $api_url = '/api/lol/{region}/v1.2/champion';
    protected $path_params = array(
        '{region}' => ''
    );
    protected $query_params = array(
        'freeToPlay' => ''
    );

    public function findFreeToPlayChampions() {
        $this->addQueryParam('freeToPlay', 'true');
        $api = (new LolApi())
            ->makeRequest($this->generateApiUrl());
        if(!$api->wasRequestWasSuccessful()) {
            return array('error' => 'Failed to find Free to Play Champions');
        }
        $data = $api->getResult();
        $free_to_play_champs = array();
        foreach($data['champions'] as $champ) {
            if($champ['freeToPlay'] == 'true') {
                $free_to_play_champs[$champ['id']] = $champ;
            }
        }
        return $free_to_play_champs;
    }
}
