$(function() {
    var Resources = function() {

        this.findSummonerData = function(summoner_name, region, callback) {
            var callback = callback || function() {};
            var params = {
                'url': '/Summoner/SummonerData',
                'data': {
                    'lol_region': region,
                    'lol_summoner_name': summoner_name
                }
            }
            /*summoner_mastery_data will be formatted like this:
             {
                 'summoner_data': {
                     'id': integer - value for summoner id,
                     'name': string - name of summoner,
                     'profileIcondId': integer - profile icon id number,
                     'revisionsDate': timestamp,
                     'summonerLevel': integer - level of summoner
                 }
             }
             */
            LOLRPG.ajaxData.fetchData(params, function(summoner_data) {
                callback(summoner_data);
            });
        }

        this.findSummonerMasteryData = function(summoner_name, region, callback) {
            var callback = callback || function() {};
            var params = {
                'url': '/Summoner/TopTenChampionMasteryData',
                'data': {
                    'lol_region': region,
                    'lol_summoner_name': summoner_name
                }
            }
            LOLRPG.ajaxData.fetchData(params, function(summoner_mastery_data) {
                /*summoner_mastery_data will be formatted like this:
                    {
                        'champion_mastery_score': integer - value of summoner mastery score
                        'summoner_data': {
                            'id': integer - value for summoner id,
                            'name': string - name of summoner,
                            'profileIcondId': integer - profile icon id number,
                            'revisionsDate': timestamp,
                            'summonerLevel': integer - level of summoner
                        },
                        'top_ten_champion_mastery_data': {
                            championId: {
                                'championId': integer - id of champion,
                                'championLevel': integer - mastery level of champion,
                                'championPoints': integer - total champion mastery points for champion,
                                'championPointsSinceLastLevel': integer - champion points earned since last level,
                                'championPointsUntilNextLevel': integer - champion points until next level,
                                'chestGranted': boolean - champion S rating chest earned,
                                'highestGrade': string - highest grade earned on champion,
                                'lastPlayTime': timestamp - last time the champion was played,
                                'playerId': integer - id - of player mastery belongs to
                            }
                        }
                    }
                */
                callback(summoner_mastery_data);
            });
        }

        this.findFreeToPlayChampionData = function(region, callback) {
            var callback = callback || function() {};
            var params = {
                'url': '/Champion/FindFreeToPlayChampions',
                'data': {
                    'lol_region': region
                }
            }
            LOLRPG.ajaxData.fetchData(params, function(champion_data) {
                callback(champion_data);
            });
        }
    };
    LOLRPG.Resources = new Resources();
});
