$(function() {
    LOLRPG.GameStates.WorldMap = function() {
        LOLRPG.GameStates.GameStateBase.apply(this);
        this.enemy_champion_data = {};
        this.champion_icon_url = 'http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/';
        this.content_container_selector = '#lolrpg-world-map-state';
        this.enterState = function() {
            this.bindPushLane()
                .bindShowEnemyChampions()
                .bindPopulateChampionStats();
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.enterState(this.content_container_selector);
            console.log('world map state');
        };

        this.leaveState = function() {
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.leaveState();
            console.log('leave world map state');
        };

        this.bindPopulateChampionStats = function() {
            var champion_stats =      
        };

        this.push_lane_button = '.button-push-lane';
        this.bindPushLane = function() {
            var self = this;
            $(LOLRPG.game_container_selector).off('click.push_lane', this.push_lane_button).on('click.push_lane', this.push_lane_button, function() {
                LOLRPG.game.queueAction('changeState', 'Battle');  
            });
            return this;
        };

        this.enemy_champion_icon = '#enemy-champion-';
        this.bindShowEnemyChampions = function () {
            var self = this;
            var count = 1;
            $.each(this.enemy_champion_data, function(k, v){
                if(LOLRPG.empty(v.image) || LOLRPG.empty(v.image.full) || LOLRPG.empty(v.key) || LOLRPG.empty(v.id)) {
                    return;
                }
                $(self.enemy_champion_icon + count).attr('src', self.champion_icon_url + v.image.full)
                    .attr('max-height', '100%')
                    .attr('width', 'auto');
                count++;
            });
            return this;
        };
    };
});