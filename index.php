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
        <div class="container" style="width: 900px; min-height: 100%; background-color: inherit">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <img src="/img/lolrpg_logo.png" />
                </div>
            </div>
            <div class="row log-in-screen">
                <div class="col-xs-12 text-center">
                    <div class="row" style="padding-top: 10px">
                        <div class="col-xs-3 text-right" style="padding-top: 7px;">
                            <label class="form-label">Enter Summoner Name:</label>
                        </div>
                        <div class="col-xs-4" style="padding-right: 0px;">
                            <input type="text" class="form-control summoner-name" value="">
                        </div>
                        <div class="col-xs-1" style="padding-top: 7px;">
                            <label class="form-label">Region:</label>
                        </div>
                        <div class="col-xs-2">
                            <select class="form-control region-select">
                                <option value="na" selected>NA</option>
                                <option value="br">BR</option>
                                <option value="eune">EUNE</option>
                                <option value="euw">EUW</option>
                                <option value="jp">JP</option>
                                <option value="KR">KR</option>
                                <option value="lan">LAN</option>
                                <option value="las">LAS</option>
                                <option value="oce">OCE</option>
                                <option value="ru">RU</option>
                                <option value="tr">TR</option>
                            </select>
                        </div>
                        <div class="col-xs-2" style="padding-top: 4px;">
                            <button class="btn btn-sm btn-warning btn-sign-in" data-toggle="modal" data-target="#baseModal" >Sign In</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row champ-select-screen hidden" style="background-color: inherit; height: 90%">
                <div class="col-xs-12">
                    <img id="champ-splash" src="" style="max-width: 100%; height: auto; opacity: .5" />
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
                            <button class="btn btn-md btn-danger btn-lock-in-champion"><u>Lock In</u></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mastery-calculation-screen hidden" style="background-color: darkgoldenrod; height: 90%">
            </div>
            <div class="row world-map-screen hidden" style="background-color: plum; height: 90%">
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
        <div id="baseModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
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
        <script src="js/config.js"></script>
        <script src="js/test_data.js"></script>
        <script src="js/game_ajax.js"></script>
        <script src="js/resources.js"></script>
        <script src="js/entities.js"></script>
        <script src="js/game_states.js"></script>
        <script src="js/game.js"></script>
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
