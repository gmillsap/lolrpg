<?php
namespace LolRpg\Controllers;

use LolRpg\Resources\ChampionMastery\Score;
use LolRpg\Resources\ChampionMastery\TopChampions;
use LolRpg\Resources\Summoner\SummonerByName;

class Summoner extends ControllerBase
{
    public function getSummonerData() {
        $summoner = new SummonerByName($this->region);
        $summoner_name = strtolower($this->findInput('lol_summoner_name'));
        $base_summoner_data = $summoner->findSummonerData($summoner_name);
        return $this->returnAsJson($base_summoner_data);
    }
    
    public function getTopTenChampionMasteryData() {
        $summoner = new SummonerByName($this->region);
        $summoner_name = strtolower($this->findInput('lol_summoner_name'));
        $base_summoner_data = $summoner->findSummonerData($summoner_name);
        if(empty($base_summoner_data) || !empty($base_summoner_data['error'])) {
            return $this->returnAsJson(array('error' => 'invalid_summoner_name'));
        }
        $mastery_score = new Score($this->region);
        $champion_mastery_score = $mastery_score->findForPlayer($base_summoner_data['id']);
        if(empty($champion_mastery_score) || !empty($champion_mastery_score['error'])) {
            return $this->returnAsJson(array('error' => 'empty_mastery_data'));
        }
        $top_champ_mastery = new TopChampions($this->region);
        $top_ten_champ_mastery_data = $top_champ_mastery->findTopTenForPlayer($base_summoner_data['id']);
        if(!empty($top_ten_champ_mastery_data['error'])) {
            return $this->returnAsJson(array('error' => 'empty_mastery_data'));
        }

        $static_champion = new \LolRpg\Resources\StaticData\Champion($this->region);
        $fetch_data = array(
            'image',
            'spells',
            'stats',
            'info',
            'tags'
        );
        $all_static_champs = $static_champion->findStaticChampionData($fetch_data);
        $champ_data = array();
        foreach($top_ten_champ_mastery_data as $key => $champ_mastery_data) {
            $champ_data[$champ_mastery_data['championId']] = $all_static_champs[$champ_mastery_data['championId']];
        }
        $return_data = array(
            'summoner_data' => $base_summoner_data,
            'champion_mastery_score' => $champion_mastery_score,
            'top_ten_champion_mastery_data' => $top_ten_champ_mastery_data,
            'champion_data' => $champ_data
        );
        return $this->returnAsJson($return_data);
    }
}
