<?php
namespace LolRpg\Resources\StaticData;

use LolRpg\Resources\ResourceBase;

abstract class StaticDataBase extends ResourceBase
{
    public function __construct($region) {
        parent::__construct($region);
        $this->api_host = $this->region_data['global']['api_host'];
    }
}
