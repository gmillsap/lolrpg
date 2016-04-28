<?php
namespace LolRpg\Resources;

use LolRpg\Api\LolApi;

class Champion extends ResourceBase
{
    protected $champion_ids = array();
    protected $api_url = '/api/lol/static-data/{region}/v1.2/champion';

    /**
     * Short Description: Get $this->champion_ids
     *
     * @return array
     *
     * @author Cole Millsap
     */
    public function getChampionIds() {
        return $this->champion_ids;
    }

    /**
     * Short Description: Set $this->champion_ids
     *
     * @param $champion_ids
     * @return $this
     *
     * @author Cole Millsap
     */
    public function setChampionIds(array $champion_ids) {
        $this->champion_ids = $champion_ids;
        return $this;
    }

    public function generateApiUrl() {
        if(empty($this->champion_ids) || is_null($this->champion_ids)) {
            $this->findFreeToPlayChampions();
        }
        return $this->base_api_url;
    }
    
    public function findFreeToPlayChampions() {
        $free_to_play_champs = array();
        
    }

    public function testFindChampions() {
        $api = new LolApi();
        $data = json_decode($api->makeRequest($this->api_url), true);
        error_log(print_r($data, true));
    }

}
