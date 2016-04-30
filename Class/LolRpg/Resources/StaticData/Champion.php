<?php
namespace LolRpg\Resources\StaticData;

use LolRpg\Api\LolApi;

class Champion extends StaticDataBase
{
    protected $api_url = '/api/lol/static-data/{region}/v1.2/champion';
    protected $path_params = array(
        '{region}' => ''
    );
    protected $query_params = array(
        'local' => '',
        'version' => '',
        'dataById' => '',
        'champData' => array()
    );

    public function findStaticChampionData(array $fetch_data, $by_id = true) {
        $this->addQueryParam('champData', $fetch_data);
        if($by_id) {
            $this->addQueryParam('dataById', 'true');
        }
        $api = (new LolApi())
            ->makeRequest($this->generateApiUrl());
        if(!$api->wasRequestWasSuccessful()) {
            return array('error' => 'Failed to find champion data');
        }
        $data = $api->getResult();
        $champ_data = $data['data'];
        return $champ_data;
    }
}
