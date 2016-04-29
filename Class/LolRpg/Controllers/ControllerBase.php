<?php
namespace LolRpg\Controllers;

class ControllerBase
{
    protected function returnAsJson($data) {
        echo json_encode($data);
    }
}
