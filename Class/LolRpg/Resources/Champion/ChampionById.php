<?php
namespace LolRpg\Resources\Champion;

use LolRpg\Resources\ResourceBase;

class ChampionById extends ResourceBase
{
    protected $api_url = '/api/lol/{region}/v1.2/champion/{id}';
    protected $path_params = array(
        '{region}' => '',
        '{id}' => ''
    );
}
