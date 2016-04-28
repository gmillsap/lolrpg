<?php
namespace LolRpg\Api;

class LolApi
{
    protected $api_base_url = 'https://na.api.pvp.net';

    public function makeRequest($url) {
        $url = str_replace('{region}', LOL_REGION, $url);
        $full_url = $this->api_base_url . $url . '?api_key=' . LOL_API_KEY;
        error_log($full_url);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $full_url,

        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    
}
