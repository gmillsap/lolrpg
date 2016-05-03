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


        <div class="lolrpg-idle-state-container hidden">


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
                            <div id="champion-stat-display" class="row">
                                <div class="col-xs-9">
                                    <div class="row plxl ptxl">
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
                            <div class="row phl">
                                <div class="col-xs-6">
                                    <button class="btn btn-md btn-primary btn-switch-to-free-to-play-champions underline hidden">Switch to Free to Play Champions</button>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <button class="btn btn-md btn-danger btn-lock-in-champion underline ">Lock In</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-12">
                                Choose Your Champion
                            </div>
                        </div>
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
                    <div class="col-xs-12 text-center">
                        <img src="/img/world_map.png" style="width:90%; height: auto; opacity: .55"/>
                    </div>
                    <div class="col-xs-12 text-center" style="margin-top: -265px; padding-right: 70px">
                        <img src="/img/minion.png" />
                    </div>
                    <div class="col-xs-12 text-center" style="margin-top: -325px; padding-left: 80px">
                        <img src="/img/minion.png" />
                    </div>
                    <div class="col-xs-12 text-center" style="margin-top: -385px; padding-left: 200px">
                        <img src="/img/minion.png" />
                    </div>
                    <div class="col-xs-12 text-center" style="margin-top: -440px; padding-left: 320px">
                        <img src="/img/champion.png" />
                    </div>
                    <div class="col-xs-12 text-center" style="margin-top: -525px; padding-left: 425px">
                        <img src="/img/tower.png" />
                    </div>
                    <div class="col-xs-12 text-center current-champion-stage" style="margin-top: -290px; padding-right: 215px">
                        <img class="circular locked-in-champion" src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/Jhin.png" />
                    </div>
                </div>
                <div class="row battle-screen hidden" style="background-color: lightslategrey; height: 90%">
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

        <script type="text/javascript" src="js/config.js"></script>
        <script type="text/javascript" src="js/test_data.js"></script>
        <script type="text/javascript" src="js/game_ajax.js"></script>
        <script type="text/javascript" src="js/resources.js"></script>
        <script type="text/javascript" src="js/entities.js"></script>
        <script type="text/javascript" src="js/game_states.js"></script>
        <script type="text/javascript" src="js/game_states/login_state.js"></script>
        <script type="text/javascript" src="js/game_states/champion_select_state.js"></script>
        <script type="text/javascript" src="js/game_states/world_map_state.js"></script>
        <script type="text/javascript" src="js/game.js"></script>
        <script type="text/javascript">
            $(function() {
                var count = 1;
                $('.btn-sign-in').off('click.enter_champ_select').on('click.enter_champ_select', function() {
                    var modal = $('#baseModal');
                    modal.on('shown.bs.modal', function() {
                        var modal = $(this)
                        modal.find('.modal-title').text('Loading Champion Data');
                    })
                    modal.on('hide.bs.modal', function(){
                        var ftp_champs = {};
                        $.ajax({
                            'url': 'Champion/findFreeToPlayChampions',
                            'type': 'GET',
                            'success': function (response) {
                                ftp_champs = response;
                                $.each(ftp_champs, function(k, v){
                                    var profile_name = v.name.replace(' ', '');
                                    $('#champ-select-' + count).attr('src', 'http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/' + v.image.full)
                                        .attr('max-height', '100%')
                                        .attr('width', 'auto')
                                        .attr('data-champion-splash', 'http://ddragon.leagueoflegends.com/cdn/img/champion/splash/' + profile_name + '_0.jpg');
                                    count++;
                                });

                                $('.log-in-screen').addClass('hidden');
                                $('.champ-select-screen').removeClass('hidden');
                            },
                            'dataType': 'json',
                        });
                    })
                });
                $('.champion').off('click.load_mastery').on('click.load_mastery', function() {
                    $('#champ-splash').attr('src', $(this).attr('data-champion-splash')).style('opacity', '0.5');
                });
            });
        </script>
    </body>
</html>
