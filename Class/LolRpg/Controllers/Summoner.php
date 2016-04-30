<?php
namespace LolRpg\Controllers;

use LolRpg\Resources\Summoner\SummonerByName;
use LolRpg\Resources\Summoner\SummonerMasteries;

class Summoner extends ControllerBase
{
    public function getMasteryData() {
        $summoner = new SummonerByName();
        $base_summoner_data = $summoner->findSummonerData($this->findInput('lol_summoner_name'));
        $masteries = new SummonerMasteries();
        return $this->returnAsJson($base_summoner_data);
    }
}
