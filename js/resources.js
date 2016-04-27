$(function() {
    var Resources = function() {
        this.findChampionData = function(champion_name) {
            if(LOLRPG.game.use_test_data) {
                console.log('here');
                if(typeof LOLRPG.TEST_DATA.champions[champion_name] != 'undefined') {
                    return LOLRPG.TEST_DATA.champions[champion_name]
                }
            } else {
                //api
            }
        }
    };
    LOLRPG.Resources = new Resources();
});
