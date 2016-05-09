<html>
    <head>
        <link rel="shortcut icon" href="/img/favicon.ico">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="http://bootswatch.com/slate/bootstrap.min.css">
        <link rel="stylesheet" href="/css/lolrpg.css?<?= rand(1,99999999) ?>" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
        <script>
            !function(d,s,id){
                var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
                if(!d.getElementById(id)){
                    js=d.createElement(s);
                    js.id=id;
                    js.src=p+'://platform.twitter.com/widgets.js';
                    fjs.parentNode.insertBefore(js,fjs);
                }
            }(document, 'script', 'twitter-wjs');
        </script>
        <meta property="og:title" content="LOLRPG" />
        <meta property="og:type" content="game" />
        <meta property="og:image" content="http://lolrpg.lol/img/league_icons/challenger.png" />
        <meta property="og:url" content="http://www.lolrpg.lol" />
        <meta property="og:description" content="Can you achieve a pentakill in challenger, summoner?" />
        <meta property="fb:app_id" content="278777029127151" />
        <?php
            if($_SERVER['SCRIPT_NAME'] == '/index.php') {
                $og_title = 'LOLRPG';
                $og_type = 'game';
                $og_image = 'http://lolrpg.lol/img/league_icons/challenger.png';
                $og_url = 'http://www.lolrpg.lol';
                $og_description = 'Can you achieve a pentakill in challenger, summoner?';
            }
            global $og_title;
            global $og_type;
            global $og_image;
            global $og_url;
            global $og_description;
        ?>
    </head>
    <body>
    <div id="fb-root"></div>
        <div id="lolrpg-container" class="container phn" style="width: 900px; min-height: 100%; background-color: inherit">
            <div class="row">
                <div class="col-xs-12 text-center lolrpg-logo-container">
                    <img class="lolrpg-logo" src="/img/lolrpg_logo.png" />
                </div>
            </div>
            <div id="lolrpg-active-state-container">
            </div>


            <div id="lolrpg-idle-state-container" class="hidden">


                <div id="lolrpg-login-state">
                    <div class="row log-in-screen ptl">
                        <div class="col-xs-6 col-xs-offset-3 ptxl">
                            <div class="login-information-container">
                                <div class="row phl">
                                    <div class="col-xs-12">
                                        <h5 class="bold">Summoner Login</h5>
                                        <hr class="mtn pts"/>
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="control-label">Summoner Name <span class="fnts italic">(In game display name)</span></label>
                                    </div>
                                    <div class="col-xs-12">
                                        <input type="text" class="form-control input-sm summoner-name" value="">
                                    </div>
                                    <div class="col-xs-12 ptl">
                                        <label class="control-label">Region</label>
                                    </div>
                                    <div class="col-xs-12">
                                        <select class="form-control input-sm region-select">
                                            <option value="na" selected>North America</option>
                                            <option value="eune">Europe Nordic &amp; East</option>
                                            <option value="euw">Europe West</option>
                                            <option value="oce">Oceania</option>
                                            <option value="jp">Japan</option>
                                            <option value="KR">Korea</option>
                                            <option value="ru">Russia</option>
                                            <option value="tr">Turkey</option>
                                            <option value="br">Brazil</option>
                                            <option value="lan">Latin America North</option>
                                            <option value="las">Latin America South</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 text-right ptl">
                                        <button class="btn btn-sm btn-warning btn-sign-in">Sign In</button>
                                    </div>
                                    <div class="col-xs-12 ptl">
                                        <p>
                                            You can choose not to log in with your summoner and instead select your champion
                                            from the current list of free to play champions. <span class="bold">Note:</span> you will not benefit
                                            from any champion mastery bonuses if you elect to do this.
                                        </p>
                                    </div>
                                    <div class="col-xs-12 text-center">
                                        <button class="btn btn-sm btn-primary btn-use-free-to-play-champions" data-toggle="modal" data-target="#baseModal" >Use Free to Play Champions</button>
                                    </div>
                                    <div class="col-xs-12 text-center pts">
                                        <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.lolrpg.lol" data-text="Pentakill! Can you get one? lolrpg.lol">Tweet</a>
                                        <div class="fb-like" data-href="http://www.lolrpg.lol" data-layout="button" data-action="like" data-show-faces="true" data-share="false"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div id="lolrpg-champion-select-state">
                    <div class="row champ-select-screen">
                        <div class="col-xs-12">
                            <div id="champ-splash">
                                <div class="row">
                                    <div class="col-xs-12 plxl ptl">
                                        <span class="bold champion-select-header selected-champion-name">Champion Selection</span>
                                    </div>
                                </div>
                                <div id="champion-stat-display" class="row">
                                    <div class="col-xs-9">
                                        <div class="row plxl pts">
                                            <div id="champion-stat-panel" class="col-xs-12">
                                                <div id="champion-mastery-data-display" class="col-xs-12">
                                                    <div class="row">
                                                        <div class="col-xs-12 pts pbm">
                                                            <div class="row pbs">
                                                                <div class="col-xs-6" style="margin-top:18px;margin-bottom:-6px;">
                                                                    <h5 class="bold mbs">Champion Mastery</h5>
                                                                </div>
                                                                <div class="col-xs-6 text-right">
                                                                    <span class="champion-role pbs">
                                                                        <img class="champion-role-image hidden" src="" />
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <hr class="mtn mbs">
                                                        </div>
                                                        <div class="col-xs-12 pln">
                                                            <div class="col-xs-6 prn text-right">
                                                                <label class="control-label">Champion Level:</label>
                                                            </div>
                                                            <div class="col-xs-2 mastery-level">-</div>
                                                            <div class="col-xs-4 mastery-level-bonus"></div>
                                                        </div>
                                                        <div class="col-xs-12 pln">
                                                            <div class="col-xs-6 prn text-right">
                                                                <label class="control-label">Highest Grade:</label>
                                                            </div>
                                                            <div class="col-xs-2 mastery-grade">-</div>
                                                            <div class="col-xs-4 mastery-grade-bonus"></div>
                                                        </div>
                                                        <div class="col-xs-12 pln">
                                                            <div class="col-xs-6 prn text-right">
                                                                <label class="control-label">Champion Points:</label>
                                                            </div>
                                                            <div class="col-xs-2 mastery-points">-</div>
                                                            <div class="col-xs-4 mastery-points-bonus"></div>
                                                        </div>
                                                        <div class="col-xs-12 pln">
                                                            <div class="col-xs-6 prn text-right">
                                                                <label class="control-label">Mastery Score:</label>
                                                            </div>
                                                            <div class="col-xs-2 mastery-score">-</div>
                                                            <div class="col-xs-4 mastery-score-bonus"></div>
                                                        </div>
                                                        <div class="col-xs-12 pln">
                                                            <div class="col-xs-6 prn text-right">
                                                                <label class="control-label">Overall Mastery Bonus:</label>
                                                            </div>
                                                            <div class="col-xs-2 overall-mastery-bonus bold">-</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 ptxl pbm">
                                                    <h5 class="bold mbn">Champion Stats</h5>
                                                    <hr class="mtn mbs">
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="row">
                                                        <div class="col-xs-5 prn"></div>
                                                        <div class="col-xs-2 phs fnts underline text-center">Base</div>
                                                        <div class="col-xs-2 plm fnts underline text-center">Bonus</div>
                                                        <div class="col-xs-2 phs fnts underline text-center">Total</div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="row">
                                                        <div class="col-xs-5 prn"></div>
                                                        <div class="col-xs-2 phs fnts underline text-center">Base</div>
                                                        <div class="col-xs-2 plm fnts underline text-center">Bonus</div>
                                                        <div class="col-xs-2 phs fnts underline text-center">Total</div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="row">
                                                        <div class="col-xs-5 prn">
                                                            <label class="control-label">Attack Damage:</label>
                                                        </div>
                                                        <div class="col-xs-2 phs base-attack-damage text-center">-</div>
                                                        <div class="col-xs-2 plm bonus-attack-damage text-center">-</div>
                                                        <div class="col-xs-2 phs total-attack-damage text-center">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="row">
                                                        <div class="col-xs-5 prn text-right">
                                                            <label class="control-label">Health:</label>
                                                        </div>
                                                        <div class="col-xs-2 phs base-health text-center">-</div>
                                                        <div class="col-xs-2 plm bonus-health text-center">-</div>
                                                        <div class="col-xs-2 phs total-health text-center">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="row">
                                                        <div class="col-xs-5 prn">
                                                            <label class="control-label">Ability Damage:</label>
                                                        </div>
                                                        <div class="col-xs-2 phs base-ability-damage text-center">-</div>
                                                        <div class="col-xs-2 plm bonus-ability-damage text-center">-</div>
                                                        <div class="col-xs-2 phs total-ability-damage text-center">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="row">
                                                        <div class="col-xs-5 prn text-right">
                                                            <label class="control-label">Health Regen:</label>
                                                        </div>
                                                        <div class="col-xs-2 phs base-health-regen text-center">-</div>
                                                        <div class="col-xs-2 plm bonus-health-regen text-center">-</div>
                                                        <div class="col-xs-2 phs total-health-regen text-center">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="row">
                                                        <div class="col-xs-5 prn">
                                                            <label class="control-label">Critical Chance:</label>
                                                        </div>
                                                        <div class="col-xs-2 phs base-critical-chance text-center">-</div>
                                                        <div class="col-xs-2 plm bonus-critical-chance text-center">-</div>
                                                        <div class="col-xs-2 phs total-critical-chance text-center">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="row">
                                                        <div class="col-xs-5 prn text-right">
                                                            <label class="control-label">Armor:</label>
                                                        </div>
                                                        <div class="col-xs-2 phs base-armor text-center">-</div>
                                                        <div class="col-xs-2 plm bonus-armor text-center">-</div>
                                                        <div class="col-xs-2 phs total-armor text-center">-</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ptm">
                                    <div class="col-xs-4 plxl">
                                        <button class="btn btn-md btn-primary btn-switch-to-free-to-play-champions underline w250">Switch to Free to Play Champions</button>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <button class="btn btn-md btn-warning btn-return-to-sign-in underline w250">Return to Summoner Sign In</button>
                                    </div>
                                    <div class="col-xs-4 text-right prxl">
                                        <button class="btn btn-md btn-danger btn-lock-in-champion underline hidden w250">Lock In</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 ptm">
                            <div class="row" style="padding-top: 5px;">
                                <div class="col-xs-2 col-xs-offset-1">
                                    <img id="champ-select-1" class="champion" src="" />
                                </div>
                                <div class="col-xs-2">
                                    <img id="champ-select-2" class="champion" src="" />
                                </div>
                                <div class="col-xs-2">
                                    <img id="champ-select-3" class="champion" src="" />
                                </div>
                                <div class="col-xs-2">
                                    <img id="champ-select-4" class="champion" src="" />
                                </div>
                                <div class="col-xs-2">
                                    <img id="champ-select-5" class="champion" src="" />
                                </div>
                            </div>
                            <div class="row" style="padding-top: 5px;">
                                <div class="col-xs-2 col-xs-offset-1">
                                    <img id="champ-select-6" class="champion" src="" />
                                </div>
                                <div class="col-xs-2">
                                    <img id="champ-select-7" class="champion" src="" />
                                </div>
                                <div class="col-xs-2">
                                    <img id="champ-select-8" class="champion" src="" />
                                </div>
                                <div class="col-xs-2">
                                    <img id="champ-select-9" class="champion" src="" />
                                </div>
                                <div class="col-xs-2">
                                    <img id="champ-select-10" class="champion" src="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mastery-calculation-screen hidden" style="background-color: darkgoldenrod; height: 90%">
                    </div>
                </div>


                <div id="lolrpg-world-map-state">
                    <div class="row world-map-screen">
                        <div class="col-xs-12 hidden" style="z-index: 10">
                            <div class="row" style="margin-bottom: -150px;">
                                <div class="col-xs-2 prn text-right">
                                    <img src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/Jhin.png" />
                                </div>
                                <div class="col-xs-2 pln" style="padding-top: 100px">
                                    <div>
                                        <span class=""></span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" style="width: 100%">
                                            <span class="enemy-hp-current-level">100</span>/<span class="enemy-hp-total">100</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-10">
                            <img src="/img/world_map.png" style="width: auto; height: 530px; opacity: .55"/>
                        </div>
                        <div class="col-xs-2">
                            <div class="row enemy-container">
                                <div class="col-xs-12">
                                    <img id="enemy-champion-1" class="enemy-champion-icon" src="" />
                                    <div class="dead-enemy hidden"></div>
                                </div>
                                <div class="col-xs-12 pts">
                                    <img id="enemy-champion-2" class="enemy-champion-icon" src="" />
                                    <div class="dead-enemy hidden"></div>
                                </div>
                                <div class="col-xs-12 pts">
                                    <img id="enemy-champion-3" class="enemy-champion-icon" src="" />
                                    <div class="dead-enemy hidden"></div>
                                </div>
                                <div class="col-xs-12 pts">
                                    <img id="enemy-champion-4" class="enemy-champion-icon" src="" />
                                    <div class="dead-enemy hidden"></div>
                                </div>
                                <div class="col-xs-12 pts">
                                    <img id="enemy-champion-5" class="enemy-champion-icon" src="" />
                                    <div class="dead-enemy hidden"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-10" style="margin-top: -530px;">
                            <div  style="width: 100%; height: 530px; position: relative;">
                                <img class="small-circle locked-in-champion" src="" style="position: relative; top: 400px; left: 185px;" />
                                <img class="small-circle map-enemy-champion-1" src="" style="position: relative; top: 319px; left: 220px;" />
                                <img class="small-circle map-enemy-champion-2" src="" style="position: relative; top: 244px; left: 240px;" />
                                <img class="small-circle map-enemy-champion-3" src="" style="position: relative; top: 172px; left: 260px;" />
                                <img class="small-circle map-enemy-champion-4" src="" style="position: relative; top: 98px; left: 280px;" />
                                <img class="small-circle map-enemy-champion-5" src="" style="position: relative; top: 22px; left: 300px;" />
                            </div>
                        </div>
                        <div class="col-xs-12" style="margin-top: -70px">
                            <div class="row battle-buttons">
                                <div class="col-xs-10">
                                    <div class="row">
                                        <div class="col-xs-3 col-xs-offset-5 plxl">
                                            <button class="btn btn-md btn-warning w180 button-farm-minion underline" title="Roam your lane killing minions for xp and recuperating after a fight">Farm Minion</button>
                                        </div>
                                        <div class="col-xs-4 plxl">
                                            <button class="btn btn-mg btn-danger w180 button-push-lane underline" title="Aggressively pursue your next opponent">Push Lane</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="player-champion-container">
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="game-log"></div>
                        </div>
                    </div>
                    <div class="row battle-end-screen hidden" style="background-color: mediumturquoise; height: 90%">
                        <div class="col-xs-12">
                            <h2>VICTORY</h2>
                        </div>
                        <div class="col-xs-12">
                            <h2>DEFEAT</h2>
                        </div>
                        <div class="col-xs-12">
                            <button class="btn btn-md btn-continue">Continue</button>
                            <button class="btn btn-md btn-try-again">Try Again</button>
                        </div>
                    </div>
                </div>


                <div id="lolrpg-battle-state">
                    <div class="row battle-screen">
                        <div class="col-xs-12">
                            <div id="battle-background">
                                <div class="row ptxl">
                                    <div class="col-xs-5">
                                        <div class="row champion-battle-container player-battle-container">
                                            <div class="col-xs-10 col-xs-offset-2">
                                                <div class="row">
                                                    <div class="col-xs-9 col-xs-offset-3 text-center pbm">
                                                        <span class="bold champion-battle-header">Name 1</span>
                                                    </div>
                                                    <div class="col-xs-8 col-xs-offset-3 pll text-center">
                                                        <img class="champion-battle-image" src="" />
                                                    </div>
                                                    <div class="action-text text-center"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-5 col-xs-offset-2">
                                        <div class="row champion-battle-container champion-status-container enemy-battle-container">
                                            <div class="col-xs-10">
                                                <div class="row">
                                                    <div class="col-xs-9 col-xs-offset-1 text-center pbm">
                                                        <span class="bold champion-battle-header">Name 2</span>
                                                    </div>
                                                    <div class="col-xs-8 col-xs-offset-1 prl text-center">
                                                        <img class="champion-battle-image" src="" />
                                                    </div>
                                                    <div class="col-xs-12 phn health-bar-container">
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-success health-bar" role="progressbar">
                                                                <span class="hp-current-level pts">100</span><span class="slash-span">/</span><span class="hp-total pts">100</span>
                                                            </div>
                                                            <div class="progress-bar yellow-health-bar" role="progressbar">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="action-text text-center"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="player-champion-container">
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="game-log"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div id="lolrpg-completion-state">

            </div>


        </div>


        <div id="base-modal" class="modal fade">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="loading-modal" class="modal fade">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <h4 class="loader-text"></h4>
                            </div>
                            <div class="col-xs-12 text-center">
                                <img src="img/loader_96x96_1.gif" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="difficulty-selection-modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body lolrpg-only-one-check">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <h4>Select Game Difficulty</h4>
                            </div>
                        </div>
                        <div class="row difficulty lolrpg-row-check">
                            <div class="col-xs-1 text-right ptl">
                                <input type="checkbox" data-difficulty="bronze" value="1" />
                            </div>
                            <div class="col-xs-3 text-center pln">
                                <img src="img/league_icons/bronze.png" class="diffiuclty-select-icon" />
                            </div>
                            <div class="col-xs-8 ptm pln">
                                <div class="row">
                                    <div class="col-xs-12 pln">
                                        <h3 class="mvn pt3">Bronze</h3>
                                    </div>
                                    <div class="col-xs-12 pln fnts italic">
                                        Recommended: Beginners to LOL RPG
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row difficulty lolrpg-row-check">
                            <div class="col-xs-1 text-right ptl">
                                <input type="checkbox" data-difficulty="silver" value="1" />
                            </div>
                            <div class="col-xs-3 text-center pln">
                                <img src="img/league_icons/silver.png" class="diffiuclty-select-icon" />
                            </div>
                            <div class="col-xs-8 ptm pln">
                                <div class="row">
                                    <div class="col-xs-12 pln">
                                        <h3 class="mvn pt3">Silver</h3>
                                    </div>
                                    <div class="col-xs-12 pln fnts italic">
                                        Recommended: Overall Mastery Bonus > 50%
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row difficulty lolrpg-row-check">
                            <div class="col-xs-1 text-right ptl">
                                <input type="checkbox" data-difficulty="gold" value="1" />
                            </div>
                            <div class="col-xs-3 text-center pln">
                                <img src="img/league_icons/gold.png" class="diffiuclty-select-icon" />
                            </div>
                            <div class="col-xs-8 ptm pln">
                                <div class="row">
                                    <div class="col-xs-12 pln">
                                        <h3 class="mvn pt3">Gold</h3>
                                    </div>
                                    <div class="col-xs-12 pln fnts italic">
                                        Recommended: Overall Mastery Bonus > 125%
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row difficulty lolrpg-row-check">
                            <div class="col-xs-1 text-right ptl">
                                <input type="checkbox" data-difficulty="platinum" value="1" />
                            </div>
                            <div class="col-xs-3 text-center pln">
                                <img src="/img/league_icons/platinum.png" class="diffiuclty-select-icon" />
                            </div>
                            <div class="col-xs-8 ptm pln">
                                <div class="row">
                                    <div class="col-xs-12 pln">
                                        <h3 class="mvn pt3">Platinum</h3>
                                    </div>
                                    <div class="col-xs-12 pln fnts italic">
                                        Recommended: Overall Mastery Bonus > 200%
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row difficulty lolrpg-row-check">
                            <div class="col-xs-1 text-right ptl">
                                <input type="checkbox" data-difficulty="diamond" value="1" />
                            </div>
                            <div class="col-xs-3 text-center pln">
                                <img src="//league_icons/diamond.png" class="diffiuclty-select-icon" />
                            </div>
                            <div class="col-xs-8 ptm pln">
                                <div class="row">
                                    <div class="col-xs-12 pln">
                                        <h3 class="mvn pt3">Diamond</h3>
                                    </div>
                                    <div class="col-xs-12 pln fnts italic">
                                        Recommended: Overall Mastery Bonus > 350%
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row difficulty lolrpg-row-check">
                            <div class="col-xs-1 text-right ptl">
                                <input type="checkbox" data-difficulty="master" value="1" />
                            </div>
                            <div class="col-xs-3 text-center pln">
                                <img src="/img/league_icons/master.png" class="diffiuclty-select-icon" />
                            </div>
                            <div class="col-xs-8 ptm pln">
                                <div class="row">
                                    <div class="col-xs-12 pln">
                                        <h3 class="mvn pt3">Master</h3>
                                    </div>
                                    <div class="col-xs-12 pln fnts italic">
                                        Recommended: Overall Mastery Bonus > 500%
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row difficulty lolrpg-row-check">
                            <div class="col-xs-1 text-right ptl">
                                <input type="checkbox" data-difficulty="challenger" value="1" />
                            </div>
                            <div class="col-xs-3 text-center pln">
                                <img src="/img/league_icons/challenger.png" class="diffiuclty-select-icon" />
                            </div>
                            <div class="col-xs-8 ptm pln">
                                <div class="row">
                                    <div class="col-xs-12 pln">
                                        <h3 class="mvn pt3">Challenger</h3>
                                    </div>
                                    <div class="col-xs-12 pln fnts italic">
                                        Recommended: Overall Mastery Bonus > 700%
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ptl">
                            <div class="col-xs-5 col-xs-offset-1">
                                <button class="btn btn-primary underline w120" data-dismiss="modal">Cancel</button>
                            </div>
                            <div class="col-xs-5">
                                <button class="btn btn-danger btn-begin-match underline w120">Begin Match!</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="player-champion-idle-container" class="hidden">
            <div id="player-champion-display">
                <div class="row">
                    <div class="col-xs-9">
                        <div class="row">
                            <div class="col-xs-2 ptl plxl" style="margin-top:-2px;position:relative;">
                                <img id="player-champion-icon" src="" />
                                <div class="attribute-point-container hidden">
                                    <div class="unspent-attribute-points" title="Unspent Attribute Points">0</div>
                                </div>
                                <div class="level-container">
                                    <div class="level-text" title="Champion Level">1</div>
                                </div>
                            </div>
                            <div class="col-xs-9 col-xs-offset-1">
                                <div class="row champion-status-container">
                                    <div class="col-xs-5 prn">
                                        <div class="row ptl">
                                            <div class="col-xs-11  champ-stats-container pls">
                                                <div class="row">
                                                    <div class="col-xs-7 prn">
                                                        <label class="control-label">Attack Damage:</label>
                                                    </div>
                                                    <div class="col-xs-4 attribute-controls text-center phn">
                                                        <label class="control-label player-attack-damage">-</label>
                                                        <a class="increase-attribute hidden" data-stat-name="attack_damage" title="Increase Attack Damage with Attribute Point"></a>
                                                    </div>
                                                    <div class="col-xs-7 prn">
                                                        <label class="control-label">Ability Power:</label>
                                                    </div>
                                                    <div class="col-xs-4 attribute-controls text-center phn">
                                                        <label class="control-label player-ability-damage">-</label>
                                                        <a class="increase-attribute hidden" data-stat-name="ability_damage" title="Increase Ability Damage with Attribute Point"></a>
                                                    </div>
                                                    <div class="col-xs-7 prn">
                                                        <label class="control-label">Armor:</label>
                                                    </div>
                                                    <div class="col-xs-4 attribute-controls text-center phn">
                                                        <label class="control-label player-armor">-</label>
                                                        <a class="increase-attribute hidden" data-stat-name="armor" title="Increase Armor with Attribute Point"></a>
                                                    </div>
                                                    <div class="col-xs-7 prn">
                                                        <label class="control-label">Critical Chance:</label>
                                                    </div>
                                                    <div class="col-xs-4 attribute-controls text-center phn">
                                                        <label class="control-label player-critical-chance">-</label>
                                                        <a class="increase-attribute hidden" data-stat-name="critical_chance" title="Increase Critical Chance with Attribute Point"></a>
                                                    </div>
                                                    <div class="col-xs-7 prn">
                                                        <label class="control-label">Health Regen:</label>
                                                    </div>
                                                    <div class="col-xs-4 attribute-controls text-center phn">
                                                        <label class="control-label player-health-regen">-</label>
                                                        <a class="increase-attribute hidden" data-stat-name="health_regen" title="Increase Health Regen with Attribute Point"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-xs-offset-1 ptl phn">
                                        <div class="row ability-display">
                                            <div class="attribute-controls">
                                                <a class="increase-attribute hidden" data-stat-name="health" title="Increase Health with Attribute Point"></a>
                                            </div>
                                            <div class="col-xs-4 pts pll prn">
                                                <div class="row action-container">
                                                    <div class="col-xs-12 chamion-action-container phn">
                                                        <img class="champion-action player-champion-basic-attack" title="Make a basic attack against your enemy" src="" />
                                                    </div>
                                                    <div class="col-xs-12 cooldown-overlay phn hidden">
                                                        <div class="cooldown-text"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-4 pts plm prn">
                                                <div class="row action-container">
                                                    <div class="col-xs-12 champion-action-container phn">
                                                        <img class="champion-action champion-ability" title="Use your Champion's ability against your enemy (3 round cooldown)" src="" />
                                                    </div>
                                                    <div class="col-xs-12 cooldown-overlay phn hidden">
                                                        <div class="cooldown-text"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-4 pts phn">
                                                <div class="row action-container">
                                                    <div class="col-xs-12 champion-action-container phn">
                                                        <img class="champion-action summoner-heal" src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/spell/SummonerHeal.png"  title="Heal yourself (12(10 for mages) round cooldown" />
                                                    </div>
                                                    <div class="col-xs-12 cooldown-overlay phn hidden">
                                                        <div class="cooldown-text"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ptm" style="margin-right: 6px;">
                                            <div class="col-xs-11 phn health-bar-container">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-success health-bar pts" role="progressbar">
                                                        <span class="hp-current-level">100</span>&nbsp;/&nbsp;<span class="hp-total">100</span>
                                                    </div>
                                                    <div class="progress-bar yellow-health-bar" role="progressbar">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3 text-center pln">
                        <div class="row">
                            <div class="col-xs-12">
                                <img class="difficult-icon" src="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="enemy-idle-container" class="hidden">
            <div id="enemy-display" class="row">
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" style="width: 60%; display: block; float: right">
                        <span class="enemy-hp-current-level">100</span>/<span class="enemy-hp-total">100</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden">

        </div>
        <div id="battle-victory-modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <div id="kill-circle"></div>
                                <button class="btn btn-warning btn-sm underline victory-return-to-world-map">Return to Summoner's Rift Map</button>
                                <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.lolrpg.lol" data-text="Pentakill! Can you get one? lolrpg.lol">Tweet</a>
                                <div class="fb-like" data-href="http://www.lolrpg.lol" data-layout="button" data-action="like" data-show-faces="true" data-share="false"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script type="text/javascript" src="/js/config.js?<?= rand(1,100000); ?>"></script>
        <script type="text/javascript" src="/js/test_data.js?<?= rand(1,100000); ?>"></script>
        <script type="text/javascript" src="/js/game_ajax.js?<?= rand(1,100000); ?>"></script>
        <script type="text/javascript" src="/js/resources.js?<?= rand(1,100000); ?>"></script>
        <script type="text/javascript" src="/js/entities/entity_base.js?<?= rand(1,100000); ?>"></script>
        <script type="text/javascript" src="/js/entities/champion.js?<?= rand(1,100000); ?>"></script>
        <script type="text/javascript" src="/js/entities/minion_base.js?<?= rand(1,100000); ?>"></script>
        <script type="text/javascript" src="/js/entities/mage_minion.js?<?= rand(1,100000); ?>"></script>
        <script type="text/javascript" src="/js/entities/fighter_minion.js?<?= rand(1,100000); ?>"></script>
        <script type="text/javascript" src="/js/entities/cannon_minion.js?<?= rand(1,100000); ?>"></script>
        <script type="text/javascript" src="/js/game_states.js?<?= rand(1,100000); ?>"></script>
        <script type="text/javascript" src="/js/game_states/login_state.js?<?= rand(1,100000); ?>"></script>
        <script type="text/javascript" src="/js/game_states/champion_select_state.js?<?= rand(1,100000); ?>"></script>
        <script type="text/javascript" src="/js/game_states/world_map_state.js?<?= rand(1,100000); ?>"></script>
        <script type="text/javascript" src="/js/game_states/battle_state.js?<?= rand(1,100000); ?>"></script>
        <script type="text/javascript" src="/js/game_log.js?<?= rand(1,100000); ?>"></script>
        <script type="text/javascript" src="/js/displays/display_base.js?<?= rand(1,100000); ?>"></script>
        <script type="text/javascript" src="/js/displays/health.js?<?= rand(1,100000); ?>"></script>
        <script type="text/javascript" src="/js/displays/ability.js?<?= rand(1,100000); ?>"></script>
        <script type="text/javascript" src="/js/displays/battle_portrait.js?<?= rand(1,100000); ?>"></script>
        <script type="text/javascript" src="/js/displays/player_champion_display.js?<?= rand(1,100000); ?>"></script>
        <script type="text/javascript" src="/js/game.js?<?= rand(1,100000); ?>"></script>
    </body>
</html>
