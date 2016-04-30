<html>
    <head>
        <link rel="shortcut icon" href="/img/favicon.ico">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </head>
    <body background="/img/map1.png">
        <div class="container" style="width: 900px; height:100%; background-color:white">
            <div class="row" style="height:10%">
                <div class="col-xs-12 text-center">
                    <h1>LOLRPG</h1>
                </div>
            </div>
            <div class="row log-in-screen hidden" style="background-color: lightblue; height: 90%">
                <div class="col-xs-12">
                    <div class="row" style="padding-top: 10px">
                        <div class="col-xs-3" style="padding-top: 4px;">
                            <label class="form-label">Enter Summoner Name:</label>
                        </div>
                        <div class="col-xs-6">
                            <input type="text" class="form-control" value="">
                        </div>
                        <div class="col-xs-2">
                            <button class="btn btn-sm">Sign In</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row champ-select-screen" style="background-color: green; height: 90%">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h3>Choose Your Champion</h3>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(function() {
                            var ftp_champs = {
                              '1': {
                                  'id': 14,
                                  'image': {
                                      'full': 'Sion.png'
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
                                $('.champ-select-' + count).attr('src', 'http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/' + v.image.full);
                                count++;
                            });
                        });
                    </script>
                    <div class="row" style="padding-top: 5px">
                        <div class="col-xs-2 col-xs-offset-1">
                            <img class="champ-select-1" src="" />
                        </div>
                        <div class="col-xs-2">
                            <img class="champ-select-2" src="" />
                        </div>
                        <div class="col-xs-2">
                            <img class="champ-select-3" src="" />
                        </div>
                        <div class="col-xs-2">
                            <img class="champ-select-4" src="" />
                        </div>
                        <div class="col-xs-2">
                            <img class="champ-select-5" src="" />
                        </div>
                    </div>
                    <div class="row" style="padding-top: 5px">
                        <div class="col-xs-2 col-xs-offset-1">
                            <img class="champ-select-6" src="" />
                        </div>
                        <div class="col-xs-2">
                            <img class="champ-select-7" src="" />
                        </div>
                        <div class="col-xs-2">
                            <img class="champ-select-8" src="" />
                        </div>
                        <div class="col-xs-2">
                            <img class="champ-select-9" src="" />
                        </div>
                        <div class="col-xs-2">
                            <img class="champ-select-10" src="" />
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col-xs-12 text-center">
                            <button class="btn btn-md btn-lock-in-champion"><u>Lock In</u></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mastery-calculation-screen hidden" style="background-color: darkgoldenrod; height: 90%">
            </div>
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
        <script src="js/config.js"></script>
        <script src="js/test_data.js"></script>
        <script src="js/game_ajax.js"></script>
        <script src="js/resources.js"></script>
        <script src="js/entities.js"></script>
        <script src="js/game.js"></script>
    </body>
</html>
