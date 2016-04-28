<?php
namespace LolRpg\Controllers;

class ProfileIcons extends ControllerBase {
    public function getIndex() {
        for($i=0; $i<28; $i++) {
            echo '<h1>IMAGE: ' . $i . '</h1>';
            echo '<img src="http://ddragon.leagueoflegends.com/cdn/6.8.1/img/profileicon/' . $i . '.png" />';
        }

        for($i=500; $i<900; $i++) {
            echo '<h1>IMAGE: ' . $i . '</h1>';
            echo '<img src="http://ddragon.leagueoflegends.com/cdn/6.8.1/img/profileicon/' . $i . '.png" />';
        }
    }
}
