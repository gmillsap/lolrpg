$(function() {
    LOLRPG.GameStates.WorldMap = function() {
        LOLRPG.GameStates.GameStateBase.apply(this);
        this.champion_icon_url = 'http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/';
        this.content_container_selector = '#lolrpg-world-map-state';
        this.enterState = function() {
            this.bindPushLane()
                .bindShowEnemyChampions()
                .bindPopulateChampionStats()
                .bindFillMapIcons();
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.enterState(this.content_container_selector);
            console.log('world map state');
        };

        this.leaveState = function() {
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.leaveState();
            console.log('leave world map state');
        };

        this.player_champion_icon = '#player-champion-icon';
        this.player_attack_damage = '.player-attack-damage';
        this.player_ability_damage = '.player-ability-damage';
        this.player_armor = '.player-armor';
        this.player_critical_chance = '.player-critical-chance';
        this.player_health_regen = '.player-health-regen';
        this.player_total_health = '.player-hp-total';
        this.player_current_health = '.player-hp-current-level';
        this.player_champion_ability = '.player-champion-ability';
        this.player_health_bar = '.player-health-bar';
        this.bindPopulateChampionStats = function() {
            var champion_stats = LOLRPG.game.player_champion;
            $(this.player_champion_icon).attr('src', 'http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/' + champion_stats.image.full);
            $(this.player_attack_damage).text(champion_stats.attack_damage.total);
            $(this.player_ability_damage).text(champion_stats.ability_damage.total);
            $(this.player_armor).text(champion_stats.armor.total);
            $(this.player_critical_chance).text(champion_stats.critical_chance.total);
            $(this.player_health_regen).text(champion_stats.health_regen.total);
            $(this.player_total_health).text(champion_stats.health.total);
            $(this.player_champion_ability).attr('src', 'http://ddragon.leagueoflegends.com/cdn/6.9.1/img/spell/' + champion_stats.spells[0].image.full);
            $(this.player_current_health).text(champion_stats.current_health);
            this.managePlayerHealthBar(champion_stats.current_health);
            return this;
        };

        this.managePlayerHealthBar = function(player_health) {
            var self = this;
            var health_percentage = (player_health / LOLRPG.game.player_champion.health.total) * 100;
            $(this.player_health_bar).attr('width', health_percentage + '%');
            return this;
        }

        this.enemy_map_icon = '.map-enemy-champion-';
        this.player_champion_map_icon = '.locked-in-champion';
        this.push_lane_button = '.button-push-lane';
        this.bindPushLane = function() {
            var self = this;
            $(LOLRPG.game_container_selector).off('click.push_lane', this.push_lane_button).on('click.push_lane', this.push_lane_button, function() {
                var position_1 = $('.map-enemy-champion-1').position();
                $(self.player_champion_map_icon).animate({top:position_1.top +30, left:position_1.left - 50}, 1000);
                // LOLRPG.game.states.Battle.battle_type = 'champion'
                // LOLRPG.game.queueAction('changeState', 'Battle');
            });
            return this;
        };

        this.enemy_champion_icon = '#enemy-champion-';
        this.bindShowEnemyChampions = function () {
            var self = this;
            var count = 1;
            $.each(LOLRPG.game.enemy_champions, function(k, v){
                if(LOLRPG.empty(v.image) || LOLRPG.empty(v.image.full)) {
                    return;
                }
                $(self.enemy_map_icon + count).attr('src', 'http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/' + v.image.full);
                $(self.enemy_champion_icon + count).attr('src', 'http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/' + v.image.full)
                    .attr('max-height', '100%')
                    .attr('width', 'auto');
                if($(self.enemy_champion_icon + count).attr('data-enemy-defeated') == 'true') {
                    
                }
                count++;
            });
            return this;
        };


        this.bindFillMapIcons = function(){
            $(this.player_champion_map_icon).attr('src', 'http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/' + LOLRPG.game.player_champion.image.full)
        }
    };
});