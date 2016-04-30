<?php
namespace LolRpg\Controllers;

use LolRpg\Resources\ChampionMastery\Score;
use LolRpg\Resources\ChampionMastery\TopChampions;
use LolRpg\Resources\Summoner\SummonerByName;

class Summoner extends ControllerBase
{
    public function getTopTenChampionMasteryData() {
        $summoner = new SummonerByName($this->region);
        $summoner_name = strtolower($this->findInput('lol_summoner_name'));
        $base_summoner_data = $summoner->findSummonerData($summoner_name);
        $mastery_score = new Score($this->region);
        $champion_mastery_score = $mastery_score->findForPlayer($base_summoner_data[$summoner_name]['id']);
        $top_champ_mastery = new TopChampions($this->region);
        $top_ten_champ_mastery_data = $top_champ_mastery->findTopTenForPlayer($base_summoner_data[$summoner_name]['id']);
        $return_data = array(
            'summoner_data' => $base_summoner_data,
            'champion_mastery_score' => $champion_mastery_score,
            'top_ten_champion_mastery_data' => $top_ten_champ_mastery_data
        );
        return $this->returnAsJson($return_data);
    }
}
