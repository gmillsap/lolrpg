<?php
namespace LolRpg\Resources;

use LolRpg\Api\LolApi;

class Champion extends ResourceBase
{
    protected $api_url = '/api/lol/{region}/v1.2/champion/{id}';
    protected $path_params = array(
        '{region}' => '',
        '{id}' => ''
    );

    public function findFreeToPlayChampions($champData = 'all') {
        $api = (new LolApi())
            ->makeRequest($this->api_url . '?freeToPlay=true');
        if(!$api->wasRequestWasSuccessful()) {
            return array('error' => 'API Failed to find Free to Play Champions');
        }
        $data = $api->getResult();
        $free_to_play_champs = array();
        foreach($data as $champs) {
            foreach($champs as $key => $champ) {
                $free_to_play_champs[$champ['id']] = $champ;
            }
        }
        foreach($free_to_play_champs as $key => $champ) {
            $free_to_play_champs[$key] = $this->findStaticChampionData($key, $champData);
        }
        return $free_to_play_champs;
    }

    public function findStaticChampionData($champion_id = null, $champData = 'all') {
        $url = $this->static_url;
        if(!is_null($champion_id)) {
            $url .= '/' . $champion_id;
        }
        $url .= '?champData=' . $champData;
        $api = (new LolApi())
            ->makeRequest($url);
        if(!$api->wasRequestWasSuccessful()) {
            return array('error' => 'API Failed to find champion data');
        }
        $data = $api->getResult();
        $champs_by_id = array();
        foreach($data as $key => $champ) {
            if(is_null($champion_id)) {
                $champs_by_id[$champion_id][$key] = $champ;
            } else {
                $champs_by_id[$key] = $champ;
            }
        }
        return $champs_by_id;
    }
}
