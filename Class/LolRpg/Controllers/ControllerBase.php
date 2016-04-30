<?php
namespace LolRpg\Controllers;

class ControllerBase
{
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
