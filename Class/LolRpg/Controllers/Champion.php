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
            'tags'
        );
        $all_static_champs = $static_champion->findStaticChampionData($fetch_data);
        $free_champ_data = array();
        foreach($free_champs as $id => $champ_data) {
            $free_champ_data[$id] = $all_static_champs[$id];
        }
        return $this->returnAsJson($free_champ_data);
    }
}
