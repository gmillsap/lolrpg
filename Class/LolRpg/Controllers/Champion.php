<?php
namespace LolRpg\Controllers;

class Champion extends ControllerBase
{
    public function getFindFreeToPlayChampions() {
        $champion = new \LolRpg\Resources\Champion\Champion($this->region);
        $free_champs = $champion->findFreeToPlayChampions();
        $static_champion = new \LolRpg\Resources\StaticData\Champion($this->region);
        $fetch_data = array(
            'image',
            'spells',
            'stats',
            'tags',
            'info'
        );
        $all_static_champs = $static_champion->findStaticChampionData($fetch_data);
        if(!empty($all_static_champs['error'])) {
            return $this->returnAsJson($all_static_champs);
        }
        $free_champ_data = array();
        foreach($free_champs as $id => $champ_data) {
            $free_champ_data[$id] = $all_static_champs[$id];
        }
        return $this->returnAsJson($free_champ_data);
    }

    public function getEnemyChampions() {
        $static_champion = new \LolRpg\Resources\StaticData\Champion($this->region);
        $fetch_data = array(
            'image',
            'spells',
            'stats',
            'tags',
            'info'
        );
        $all_static_champs = $static_champion->findStaticChampionData($fetch_data);
        if(!empty($all_static_champs['error'])) {
            return $this->returnAsJson($all_static_champs);
        }
        $ids = array_keys($all_static_champs);
        $enemy_champs = array();
        $enemy_champs['champions'] = array();
        $i = 0;
        while($i < 5) {
            $random_id = rand(0, count($ids));
            if(empty($enemy_champs['champions'][$ids[$random_id]]) && !is_null($all_static_champs[$random_id]) && !empty($all_static_champs[$random_id])) {
                $enemy_champs['champions'][$ids[$random_id]] = $all_static_champs[$random_id];
                $i++;
            }
        }
        return $this->returnAsJson($enemy_champs);
    }
}
