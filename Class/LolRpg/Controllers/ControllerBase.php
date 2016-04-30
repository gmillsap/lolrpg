<?php
namespace LolRpg\Controllers;

class ControllerBase
{
    protected $default_region = 'na';
    protected $region;

    public function __construct() {
        if(!empty($this->findInput('lol_region'))) {
            $this->region = $this->findInput('lol_region');
        } else {
            $this->region = $this->default_region;
        }
    }

    protected function returnAsJson($data) {
        echo json_encode($data);
    }

    protected function findInput($index) {
        if(isset($_REQUEST[$index])) {
            return $_REQUEST[$index];
        }
        return '';
    }
}
