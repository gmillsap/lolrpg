<?php
namespace LolRpg\Resources;

abstract class ResourceBase
{
    protected $api_host = '';
    protected $api_url = '';
    protected $path_params = array();
    protected $query_params = array();
    protected $response_errors = array(
        '400' => 'Bad request',
        '401' => 'Unauthorized',
        '404' => 'Data not found',
        '429' => 'Rate limit exceeded',
        '500' => 'Internal server error',
        '503' => 'Service unavailable'
    );
    protected $region_data = array(
        'br' => array(
            'region' => 'br',
            'platformId' => 'br1',
            'api_host' => 'br.api.pvp.net'
        ),
        'eune' => array(
            'region' => 'eune',
            'platformId' => 'eun1',
            'api_host' => 'eune.api.pvp.net'
        ),
        'euw' => array(
            'region' => 'euw',
            'platformId' => 'euw1',
            'api_host' => 'euw.api.pvp.net'
        ),
        'jp' => array(
            'region' => 'jp',
            'platformId' => 'jp1',
            'api_host' => 'jp.api.pvp.net'
        ),
        'kr' => array(
            'region' => 'kr',
            'platformId' => 'kr',
            'api_host' => 'kr.api.pvp.net'
        ),
        'lan' => array(
            'region' => 'lan',
            'platformId' => 'la1',
            'api_host' => 'lan.api.pvp.net'
        ),
        'las' => array(
            'region' => 'las',
            'platformId' => 'la2',
            'api_host' => 'las.api.pvp.net'
        ),
        'na' => array(
            'region' => 'na',
            'platformId' => 'na1',
            'api_host' => 'na.api.pvp.net'
        ),
        'oce' => array(
            'region' => 'oce',
            'platformId' => 'oc1',
            'api_host' => 'oce.api.pvp.net'
        ),
        'tr' => array(
            'region' => 'tr',
            'platformId' => 'tr1',
            'api_host' => 'tr.api.pvp.net'
        ),
        'ru' => array(
            'region' => 'ru',
            'platformId' => 'ru',
            'api_host' => 'ru.api.pvp.net'
        ),
        'pbe' => array(
            'region' => 'pbe',
            'platformId' => 'pbe1',
            'api_host' => 'pbe.api.pvp.net'
        ),
        'global' => array(
            'api_host' => 'global.api.pvp.net'
        )
    );

    public function __construct($region) {
        if(isset($this->path_params['{region}']) && isset($this->region_data[$region]['region'])) {
            $this->path_params['{region}'] = $this->region_data[$region]['region'];
        }
        if(isset($this->path_params['{platformId}']) && isset($this->region_data[$region]['platformId'])) {
            $this->path_params['{platformId}'] = $this->region_data[$region]['platformId'];
        }
        if(isset($this->region_data[$region]['api_host'])) {
            $this->api_host = $this->region_data[$region]['api_host'];
        }
    }

    public function addPathParam($param, $value) {
        if(isset($this->path_params[$param])) {
            $this->path_params[$param] = $value;
        }
        return $this;
    }

    public function removePathParam($param) {
        if(!empty($this->path_params[$param])) {
            $this->path_params[$param] = '';
        }
    }

    public function addQueryParam($param, $value) {
        if(isset($this->query_params[$param])) {
            if(!is_array($value)) {
                $this->query_params[$param] = $value;
            } else {
                $query_value = '';
                foreach($value as $v) {
                    $query_value .= $v . ',';
                }
                rtrim($query_value, ',');
                $this->query_params[$param] = $query_value;
            }
        }
        return $this;
    }

    public function removeQueryParam($param) {
        if(!empty($this->query_params[$param])) {
            $this->query_params[$param] = '';
        }
    }

    public function generateApiUrl() {
        if(empty($this->api_host)) {
            throw new \Exception('Unable to find api host');
            return false;
        }
        if(empty($this->api_url)) {
            throw new \Exception('Unable to find api url');
            return false;
        }
        $url = $this->api_host . $this->api_url;
        foreach($this->path_params as $path_index => $path_param) {
            if(!empty($path_param)) {
                $url = str_replace($path_index, $path_param, $url);
            }
        }
        $has_q = false;
        foreach($this->query_params as $query_index => $query_param) {
            if(!empty($query_param)) {
                $url .= $has_q ? '&' : '?';
                $has_q = true;
                $url .= $query_index . '=' . $query_param;
            }
        }
        return $url;
    }

}
