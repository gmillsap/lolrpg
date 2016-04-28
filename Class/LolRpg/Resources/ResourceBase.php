<?php
namespace LolRpg\Resources;

abstract class ResourceBase
{
    protected $api_url = null;

    public function __construct() {
    }

    public function generateApiUrl() {
        return $this->base_api_url;
    }
}
