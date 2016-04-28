<?php
namespace LolRpg\Api;

class LolApi
{
    protected $api_base_url = 'https://na.api.pvp.net';
    protected $result = null;

    /**
     * Short Description: Get $this->result
     *
     * @return string
     *
     * @author Cole Millsap
     */
    public function getResult() {
        return $this->result;
    }

    public function makeRequest($url) {
        $url = str_replace('{region}', LOL_REGION, $url);
        $full_url = $this->api_base_url . $url . '?api_key=' . LOL_API_KEY;
        error_log($full_url);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $full_url,

        ));
        $this->result = curl_exec($curl);
        error_log(print_r($this->result, true));
        curl_close($curl);
        return $this;
    }

}
