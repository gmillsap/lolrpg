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

    public function getShutdownKillBronze() {
        $GLOBALS['og_title'] = 'LOLRPG Shutdown';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/shutdown.png';
        $GLOBALS['og_description'] = 'I just got a SHUTDOWN on Bronze difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/ShutdownKillBronze';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getShutdownKillSilver() {
        $GLOBALS['og_title'] = 'LOLRPG Shutdown';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/shutdown.png';
        $GLOBALS['og_description'] = 'I just got a SHUTDOWN on Silver difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/ShutdownKillSilver';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getShutdownKillGold() {
        $GLOBALS['og_title'] = 'LOLRPG Shutdown';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/shutdown.png';
        $GLOBALS['og_description'] = 'I just got a SHUTDOWN on Gold difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/ShutdownKillGold';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getShutdownKillPlatinum() {
        $GLOBALS['og_title'] = 'LOLRPG Shutdown';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/shutdown.png';
        $GLOBALS['og_description'] = 'I just got a SHUTDOWN on Platinum difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/ShutdownKillPlatinum';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getShutdownKillDiamond() {
        $GLOBALS['og_title'] = 'LOLRPG Shutdown';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/shutdown.png';
        $GLOBALS['og_description'] = 'I just got a SHUTDOWN on Diamond difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/ShutdownKillDiamond';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getShutdownKillMaster() {
        $GLOBALS['og_title'] = 'LOLRPG Shutdown';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/shutdown.png';
        $GLOBALS['og_description'] = 'I just got a SHUTDOWN on Master difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/ShutdownKillMaster';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getShutdownKillChallenger() {
        $GLOBALS['og_title'] = 'LOLRPG Shutdown';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/shutdown.png';
        $GLOBALS['og_description'] = 'I just got a SHUTDOWN on Challenger difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/ShutdownKillChallenger';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }

    public function getDoubleKillBronze() {
        $GLOBALS['og_title'] = 'LOLRPG Double Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/double_kill.png';
        $GLOBALS['og_description'] = 'I just got a DOUBLEKILL on Bronze difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/DoubleKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getDoubleKillSilver() {
        $GLOBALS['og_title'] = 'LOLRPG Double Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/double_kill.png';
        $GLOBALS['og_description'] = 'I just got a DOUBLEKILL on Silver difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/DoubleKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getDoubleKillGold() {
        $GLOBALS['og_title'] = 'LOLRPG Double Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/double_kill.png';
        $GLOBALS['og_description'] = 'I just got a DOUBLEKILL on Gold difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/DoubleKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getDoubleKillPlatinum() {
        $GLOBALS['og_title'] = 'LOLRPG Double Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/double_kill.png';
        $GLOBALS['og_description'] = 'I just got a DOUBLEKILL on Platinum difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/DoubleKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getDoubleKillDiamond() {
        $GLOBALS['og_title'] = 'LOLRPG Double Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/double_kill.png';
        $GLOBALS['og_description'] = 'I just got a DOUBLEKILL on Diamond difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/DoubleKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getDoubleKillMaster() {
        $GLOBALS['og_title'] = 'LOLRPG Double Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/double_kill.png';
        $GLOBALS['og_description'] = 'I just got a DOUBLEKILL on Master difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/DoubleKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getDoubleKillChallenger() {
        $GLOBALS['og_title'] = 'LOLRPG Double Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/double_kill.png';
        $GLOBALS['og_description'] = 'I just got a DOUBLEKILL on Challenger difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/DoubleKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }

    public function getTripleKillBronze() {
        $GLOBALS['og_title'] = 'LOLRPG Triple Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/triple_kill.png';
        $GLOBALS['og_description'] = 'I just got a TRIPLEKILL on Bronze difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/TripleKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getTripleKillSilver() {
        $GLOBALS['og_title'] = 'LOLRPG Triple Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/triple_kill.png';
        $GLOBALS['og_description'] = 'I just got a TRIPLEKILL on Silver difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/TripleKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getTripleKillGold() {
        $GLOBALS['og_title'] = 'LOLRPG Triple Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/triple_kill.png';
        $GLOBALS['og_description'] = 'I just got a TRIPLEKILL on Gold difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/TripleKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getTripleKillPlatinum() {
        $GLOBALS['og_title'] = 'LOLRPG Triple Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/triple_kill.png';
        $GLOBALS['og_description'] = 'I just got a TRIPLEKILL on Platinum difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/TripleKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getTripleKillDiamond() {
        $GLOBALS['og_title'] = 'LOLRPG Triple Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/triple_kill.png';
        $GLOBALS['og_description'] = 'I just got a TRIPLEKILL on Diamond difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/TripleKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getTripleKillMaster() {
        $GLOBALS['og_title'] = 'LOLRPG Triple Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/triple_kill.png';
        $GLOBALS['og_description'] = 'I just got a TRIPLEKILL on Master difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/TripleKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getTripleKillChallenger() {
        $GLOBALS['og_title'] = 'LOLRPG Triple Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/triple_kill.png';
        $GLOBALS['og_description'] = 'I just got a TRIPLEKILL on Challenger difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/TripleKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }


    public function getQuadraKillBronze() {
        $GLOBALS['og_title'] = 'LOLRPG Quadra Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/quadra_kill.png';
        $GLOBALS['og_description'] = 'I just got a QUADRAKILL on Bronze difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/QuadraKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getQuadraKillSilver() {
        $GLOBALS['og_title'] = 'LOLRPG Quadra Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/quadra_kill.png';
        $GLOBALS['og_description'] = 'I just got a QUADRAKILL on Silver difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/QuadraKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getQuadraKillGold() {
        $GLOBALS['og_title'] = 'LOLRPG Quadra Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/quadra_kill.png';
        $GLOBALS['og_description'] = 'I just got a QUADRAKILL on Gold difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/QuadraKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getQuadraKillPlatinum() {
        $GLOBALS['og_title'] = 'LOLRPG Quadra Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/quadra_kill.png';
        $GLOBALS['og_description'] = 'I just got a QUADRAKILL on Platinum difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/QuadraKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getQuadraKillDiamond() {
        $GLOBALS['og_title'] = 'LOLRPG Quadra Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/quadra_kill.png';
        $GLOBALS['og_description'] = 'I just got a QUADRAKILL on Diamond difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/QuadraKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getQuadraKillMaster() {
        $GLOBALS['og_title'] = 'LOLRPG Quadra Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/quadra_kill.png';
        $GLOBALS['og_description'] = 'I just got a QUADRAKILL on Master difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/QuadraKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getQuadraKillChallenger() {
        $GLOBALS['og_title'] = 'LOLRPG Quadra Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/quadra_kill.png';
        $GLOBALS['og_description'] = 'I just got a QUADRAKILL on Challenger difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/QuadraKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }




    public function getPentaKillBronze() {
        $GLOBALS['og_title'] = 'LOLRPG Penta Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/penta_kill.png';
        $GLOBALS['og_description'] = 'I just got a PENTAKILL on Bronze difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/PentaKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getPentaKillSilver() {
        $GLOBALS['og_title'] = 'LOLRPG Penta Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/penta_kill.png';
        $GLOBALS['og_description'] = 'I just got a PENTAKILL on Silver difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/PentaKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getPentaKillGold() {
        $GLOBALS['og_title'] = 'LOLRPG Penta Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/penta_kill.png';
        $GLOBALS['og_description'] = 'I just got a PENTAKILL on Gold difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/PentaKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getPentaKillPlatinum() {
        $GLOBALS['og_title'] = 'LOLRPG Penta Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/penta_kill.png';
        $GLOBALS['og_description'] = 'I just got a PENTAKILL on Platinum difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/PentaKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getPentaKillDiamond() {
        $GLOBALS['og_title'] = 'LOLRPG Penta Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/penta_kill.png';
        $GLOBALS['og_description'] = 'I just got a PENTAKILL on Diamond difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/PentaKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getPentaKillMaster() {
        $GLOBALS['og_title'] = 'LOLRPG Penta Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/penta_kill.png';
        $GLOBALS['og_description'] = 'I just got a PENTAKILL on Master difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/PentaKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }
    public function getPentaKillChallenger() {
        $GLOBALS['og_title'] = 'LOLRPG Penta Kill';
        $GLOBALS['og_type'] = 'game';
        $GLOBALS['og_image'] = 'http://lolrpg.lol/img/penta_kill.png';
        $GLOBALS['og_description'] = 'I just got a PENTAKILL on Challenger difficulty in LOLRPG!';
        $GLOBALS['og_url'] = 'http://www.lolrpg.lol/Champion/PentaKill';
        include($_SERVER['DOCUMENT_ROOT'] . '/index.php');
        return;
    }



}
