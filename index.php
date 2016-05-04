<html>
    <head>
        <link rel="shortcut icon" href="/img/favicon.ico">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="http://bootswatch.com/slate/bootstrap.min.css">
        <link rel="stylesheet" href="css/lolrpg.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        
    </head>
    <body>
        <div id="lolrpg-container" class="container phn" style="width: 900px; min-height: 100%; background-color: inherit">
            <div class="row">
                <div class="col-xs-12 text-center lolrpg-logo-container">
                    <img class="lolrpg-logo" src="/img/lolrpg_logo.png" />
                </div>
            </div>
            <div id="lolrpg-active-state-container">
            </div>
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
                                    <span class="bold champion-select-header">Champion Selection</span>
                                </div>
                            </div>
                            <div id="champion-stat-display" class="row">
                                <div class="col-xs-9">
                                    <div class="row plxl pts">
                                        <div id="champion-stat-panel" class="col-xs-12">
                                            <div id="champion-mastery-data-display" class="col-xs-12">
                                                <div class="row">
                                                    <div class="col-xs-12 ptl pbm">
                                                        <h5 class="bold mbs">Champion Mastery</h5>
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
                        <div class="row">
                            <div class="col-xs-12 enemy-container">
                                <img id="enemy-champion-1" class="large-circle" src="" />
                                <div class="dead-enemy"></div>
                            </div>
                            <div class="col-xs-12">
                                <img id="enemy-champion-2" class="large-circle" src="" />
                            </div>
                            <div class="col-xs-12">
                                <img id="enemy-champion-3" class="large-circle" src="" />
                            </div>
                            <div class="col-xs-12">
                                <img id="enemy-champion-4" class="large-circle" src="" />
                            </div>
                            <div class="col-xs-12">
                                <img id="enemy-champion-5" class="large-circle" src="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 text-center current-champion-stage" style="margin-top: -290px; padding-right: 215px">
                        <img class="small-circle locked-in-champion" src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/Jhin.png" />
                    </div>
                    <div class="col-xs-12" style="margin-top: -45px">
                        <div class="row battle-buttons">
                            <div class="col-xs-6 plxl">
                                <button class="btn btn-md btn-warning w250"><u>Farm Minion</u></button>
                            </div>
                            <div class="col-xs-6 pls">
                                <button class="btn btn-mg btn-danger w250 button-push-lane"><u>Push Lane</u></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="row player-champion-row">
                            <div class="col-xs-2 ptn">
                                <img id="player-champion-icon" src="" />
                            </div>
                            <div class="col-xs-10 pln ">
                                <div class="row champion-status-container">
                                    <div class="col-xs-3 champ-stats-container">
                                        <div class="row">
                                            <div class="col-xs-8 prn">
                                                <label class="control-label">Attack Damage:</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <label class="control-label player-attack-damage">-</label>
                                            </div>
                                            <div class="col-xs-8 prn">
                                                <label class="control-label">Ability Power:</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <label class="control-label player-ability-damage">-</label>
                                            </div>
                                            <div class="col-xs-8 prn">
                                                <label class="control-label">Armor:</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <label class="control-label player-armor">-</label>
                                            </div>
                                            <div class="col-xs-8 prn">
                                                <label class="control-label">Critical Chance:</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <label class="control-label player-critical-chance">-</label>
                                            </div>
                                            <div class="col-xs-8 prn">
                                                <label class="control-label">Health Regen:</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <label class="control-label player-health-regen">-</label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="row">
                                            <div class="col-xs-2 pts">
                                                <img class="player-champion-ability" src="" />
                                            </div>
                                            <div class="col-xs-2 pts">
                                                <img class="summoner-heal" src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/spell/SummonerHeal.png" />
                                            </div>
                                            <div class="col-xs-12 pln ptm">
                                                <label class="control-label">Hit Points:</label>
                                            </div>
                                            <div class="col-xs-12 pln">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-success player-health-bar" role="progressbar" style="width: 100%">
                                                        <span class="player-hp-current-level">100</span>/<span class="player-hp-total">100</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                            <div class="row enemy-champion-row pbxl ptm">
                                <div class="col-xs-10">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" style="width: 60%; display: block; float: right">
                                            <span class="enemy-hp-current-level">100</span>/<span class="enemy-hp-total">100</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-2 text-right prxl">
                                    <img id="enemy-champion-splash" class="battle-splash-art" />
                                </div>
                            </div>
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
                                <img src="img/league_icons/platinum.png" class="diffiuclty-select-icon" />
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
                                <img src="img/league_icons/diamond.png" class="diffiuclty-select-icon" />
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
                                <img src="img/league_icons/master.png" class="diffiuclty-select-icon" />
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
                                <img src="img/league_icons/challenger.png" class="diffiuclty-select-icon" />
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

        <script type="text/javascript" src="js/config.js"></script>
        <script type="text/javascript" src="js/test_data.js"></script>
        <script type="text/javascript" src="js/game_ajax.js"></script>
        <script type="text/javascript" src="js/resources.js"></script>
        <script type="text/javascript" src="js/entities/entity_base.js"></script>
        <script type="text/javascript" src="js/entities/champion.js"></script>
        <script type="text/javascript" src="js/entities/mage_minion.js"></script>
        <script type="text/javascript" src="js/entities/fighter_minion.js"></script>
        <script type="text/javascript" src="js/game_states.js"></script>
        <script type="text/javascript" src="js/game_states/login_state.js"></script>
        <script type="text/javascript" src="js/game_states/champion_select_state.js"></script>
        <script type="text/javascript" src="js/game_states/world_map_state.js"></script>
        <script type="text/javascript" src="js/game_states/battle_state.js"></script>
        <script type="text/javascript" src="js/game.js"></script>
    </body>
</html>
