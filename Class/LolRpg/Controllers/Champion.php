<?php
namespace LolRpg\Controllers;

class Champion extends ControllerBase
{
    public function getIndex() {
        echo 'champ';
    }

    public function getFindFreeToPlayChampions() {
        $champion = new \LolRpg\Resources\Champion();
        $free_champs = $champion->findFreeToPlayChampions('image,spells,stats,tags');
        return $this->returnAsJson($free_champs);
    }
}
