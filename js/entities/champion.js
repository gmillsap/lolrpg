$(function() {
    LOLRPG.Entities.Champion = function() {
        LOLRPG.Entities.EntityBase.apply(this);
        this.loadChampion = function(champion_name) {
            var champion_data = LOLRPG.Resources.findChampionData(champion_name);
            console.log(champion_data);
        }
    };

});