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
            $random_id = rand(0, count($ids) - 1);
            if(empty($enemy_champs['champions'][$ids[$random_id]]) && !empty($all_static_champs[$ids[$random_id]]) && !is_null($all_static_champs[$ids[$random_id]])) {
                $enemy_champs['champions'][$ids[$random_id]] = $all_static_champs[$ids[$random_id]];
                $i++;
            }
        }
        return $this->returnAsJson($enemy_champs);
    }

    public function getShutdownKill() {
        $GLOBALS['og_title'] = 'LOLRPG Double Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/shutdown.png';
        $GLOBALS['og_description'] = 'I just got a SHUTDOWN in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/ShutdownKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getDoubleKill() {
        $GLOBALS['og_title'] = 'LOLRPG Double Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/double_kill.png';
        $GLOBALS['og_description'] = 'I just got a DOUBLEKILL in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/DoubleKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getTripleKill() {
        $GLOBALS['og_title'] = 'LOLRPG Double Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/triple_kill.png';
        $GLOBALS['og_description'] = 'I just got a TRIPLEKILL in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/TripleKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getQuadraKill() {
        $GLOBALS['og_title'] = 'LOLRPG Double Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/quadra_kill.png';
        $GLOBALS['og_description'] = 'I just got a QUADRAKILL in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/QuadraKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getPentaKill() {
        $GLOBALS['og_title'] = 'LOLRPG Double Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/penta_kill.png';
        $GLOBALS['og_description'] = 'I just got a PENTAKILL in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/PentaKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }

}
