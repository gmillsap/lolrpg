<?php
namespace LolRpg\Api;

class LolApi
{
    protected $api_protocol = 'https://';
    protected $result = null;
    protected $curl_info = null;
    protected $curl_error = null;
    protected $request_was_successful = false;

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

    /**
     * Short Description: Get $this->request_was_successful
     *
     * @return boolean
     *
     * @author Cole Millsap
     */
    public function wasRequestWasSuccessful() {
        return $this->request_was_successful;
    }

    public function makeRequest($url) {
        $a_or_q = strpos($url, '?') === false ? '?' : '&';
        $full_url = $this->api_protocol . $url . $a_or_q . 'api_key=' . LOL_API_KEY;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $full_url,
            CURLOPT_SSLVERSION => 4,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_CIPHER_LIST => 'SSLv3'
        ));
        $result = curl_exec($curl);
        if($result === false || is_null($result)) {
            $this->request_was_successful = false;
            $this->curl_error = curl_error($curl);
        } else {
            $this->request_was_successful = true;
            $this->result = json_decode($result, true);
        }
        $this->curl_info = curl_getinfo($curl);
        curl_close($curl);
        return $this;
    }

}
