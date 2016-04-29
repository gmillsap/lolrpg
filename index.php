<html>
    <head>
        <link rel="shortcut icon" href="/img/favicon.ico">
        <link rel="icon" href="/img/favicon.ico">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </head>
    <body background="/img/map1.png">
        <div class="container" style="width: 900px; height:100%; background-color:white">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1>LOLRPG</h1>
                </div>
            </div>
            <div class="row log-in-screen hidden" style="background-color: lightblue; height: 100%">
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
            <div class="row champ-select-screen" style="background-color: green; height: 100%">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h3>Choose Your Champion</h3>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 5px">
                        <div class="col-xs-2 col-xs-offset-1">
                            <div class="champ-select-1" style="background-color: #001122; height: 16.66667%">&nbsp;</div>
                        </div>
                        <div class="col-xs-2">
                            <div class="champ-select-2" style="background-color: #112233; height: 16.66667%">&nbsp;</div>
                        </div>
                        <div class="col-xs-2">
                            <div class="champ-select-3" style="background-color: #445566; height: 16.66667%">&nbsp;</div>
                        </div>
                        <div class="col-xs-2">
                            <div class="champ-select-4" style="background-color: #667788; height: 16.66667%">&nbsp;</div>
                        </div>
                        <div class="col-xs-2">
                            <div class="champ-select-5" style="background-color: #990011; height: 16.66667%">&nbsp;</div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 5px">
                        <div class="col-xs-2 col-xs-offset-1">
                            <div class="champ-select-6" style="background-color: #aabbcc; height: 16.66667%">&nbsp;</div>
                        </div>
                        <div class="col-xs-2">
                            <div class="champ-select-7" style="background-color: #ddeeff; height: 16.66667%">&nbsp;</div>
                        </div>
                        <div class="col-xs-2">
                            <div class="champ-select-8" style="background-color: #998877; height: 16.66667%">&nbsp;</div>
                        </div>
                        <div class="col-xs-2">
                            <div class="champ-select-9" style="background-color: #665544; height: 16.66667%">&nbsp;</div>
                        </div>
                        <div class="col-xs-2">
                            <div class="champ-select-10" style="background-color: #449922; height: 16.66667%">&nbsp;</div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col-xs-12 text-center">
                            <button class="btn btn-md btn-lock-in-champion"><u>Lock In</u></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row world-map-screen" style="background-color: lightseagreen; height: 100%">

            </div>
        </div>
        <script src="js/config.js"></script>
        <script src="js/test_data.js"></script>
        <script src="js/resources.js"></script>
        <script src="js/entities.js"></script>
        <script src="js/game.js"></script>
    </body>
</html>
