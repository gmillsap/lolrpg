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
                                <div class="col-xs-12 bbd">
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
                <div class="row champ-select-screen" style="background-color: inherit; height: 90%">
                    <div class="col-xs-12">
                        <img id="champ-splash" src="" style="max-width: 100%; height: auto" />
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
                        <div class="row" style="padding-top: 10px;">
                            <div class="col-xs-12 text-center">
                                <button class="btn btn-md btn-danger btn-lock-in-champion underline">Lock In</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mastery-calculation-screen hidden" style="background-color: darkgoldenrod; height: 90%">
                </div>
            </div>


            <div id="lolrpg-world-map-state">
                <div class="row world-map-screen" style="background-color: plum; height: 90%">
                    <div class="col-xs-12 text-center">
                        <img src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/map/map12.png"/>
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
