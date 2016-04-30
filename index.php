<html>
    <head>
        <link rel="shortcut icon" href="/img/favicon.ico">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="http://bootswatch.com/slate/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </head>
    <body background="/img/map1.png">
        <div class="container" style="width: 900px; min-height: 100%; background-color: inherit">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1>LOLRPG</h1>
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
                <div class="col-xs-4">
                    <img id="champ-splash" src="" style="width: auto; height: 45%" />
                </div>
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            Choose Your Champion
                        </div>
                    </div>
                    <div class="row" style="padding-top: 5px;">
                        <div class="col-xs-2 col-xs-offset-1">
                            <img id="champ-select-1" src="" />
                        </div>
                        <div class="col-xs-2">
                            <img id="champ-select-2" src="" />
                        </div>
                        <div class="col-xs-2">
                            <img id="champ-select-3" src="" />
                        </div>
                        <div class="col-xs-2">
                            <img id="champ-select-4" src="" />
                        </div>
                        <div class="col-xs-2">
                            <img id="champ-select-5" src="" />
                        </div>
                    </div>
                    <div class="row" style="padding-top: 5px;">
                        <div class="col-xs-2 col-xs-offset-1">
                            <img id="champ-select-6" src="" />
                        </div>
                        <div class="col-xs-2">
                            <img id="champ-select-7" src="" />
                        </div>
                        <div class="col-xs-2">
                            <img id="champ-select-8" src="" />
                        </div>
                        <div class="col-xs-2">
                            <img id="champ-select-9" src="" />
                        </div>
                        <div class="col-xs-2">
                            <img id="champ-select-10" src="" />
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
        <script src="js/game.js"></script>
        <script type="text/javascript">
            $(function() {
                var ftp_champs = {
                    '1': {
                        'id': 14,
                        "name":"Sion",
                        'image': {
                            'full': 'Sion.png',
                            "sprite":"champion0.png",
                        }
                    },
                    '2': {
                        'id': 14,
                        'image': {
                            'full': 'Sivir.png'
                        }
                    },
                    '3': {
                        'id': 14,
                        'image': {
                            'full': 'Kassadin.png'
                        }
                    },
                    '4': {
                        'id': 14,
                        'image': {
                            'full': 'Blitzcrank.png'
                        }
                    },
                    '5': {
                        'id': 14,
                        'image': {
                            'full': 'Orianna.png'
                        }
                    },
                    '6': {
                        'id': 14,
                        'image': {
                            'full': 'Skarner.png'
                        }
                    },
                    '7': {
                        'id': 14,
                        'image': {
                            'full': 'Gragas.png'
                        }
                    },
                    '8': {
                        'id': 14,
                        'image': {
                            'full': 'Lulu.png'
                        }
                    },
                    '9': {
                        'id': 14,
                        'image': {
                            'full': 'TahmKench.png'
                        }
                    },
                    '10': {
                        'id': 14,
                        'image': {
                            'full': 'Kalista.png'
                        }
                    }
                };
                var count = 1;
                $.each(ftp_champs, function(k, v){
                    $('#champ-select-' + count).attr('src', 'http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/' + v.image.full)
                        .attr('max-height', '100%')
                        .addClass('champion')
                        .attr('width', 'auto')
                        .attr('data-champion-splash', 'http://ddragon.leagueoflegends.com/cdn/img/champion/loading/' + v.name + '_0.jpg');
                    count++;
                });
                $('.btn-sign-in').off('click.enter_champ_select').on('click.enter_champ_select', function() {
                    var modal = $('#baseModal');
                    modal.on('shown.bs.modal', function() {
                        var modal = $(this)
                        modal.find('.modal-title').text('Loading Champion Data');
                    })
                    modal.on('hide.bs.modal', function(){
                        $('.log-in-screen').addClass('hidden');
                        $('.champ-select-screen').removeClass('hidden');
                    })
                });
                $('.champion').off('click.load_mastery').on('click.load_mastery', function() {
                    $('#champ-splash').attr('src', $(this).attr('data-champion-splash'));
                });
            });
        </script>
    </body>
</html>
