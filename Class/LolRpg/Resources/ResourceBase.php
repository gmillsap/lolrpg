<?php
namespace LolRpg\Resources;

abstract class ResourceBase
{
    protected $api_url = '';
    protected $path_params = array();
    protected $query_params = array();
    protected $response_errors = array(
        '400' => 'Bad request',
        '401' => 'Unauthorized',
        '429' => 'Rate limit exceeded',
        '500' => 'Internal server error',
        '503' => 'Service unavailable'
    );

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
            $this->query_params[$param] = $value;
        }
        return $this;
    }

    public function removeQueryParam($param) {
        if(!empty($this->query_params[$param])) {
            $this->query_params[$param] = '';
        }
    }

    public function generateApiUrl() {
        $url = $this->api_url;
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
        return $this->api_url;
    }

}
