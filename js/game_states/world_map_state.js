$(function() {
    LOLRPG.GameStates.WorldMap = function() {
        LOLRPG.GameStates.GameStateBase.apply(this);
        this.champion_icon_url = 'http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/';
        this.content_container_selector = '#lolrpg-world-map-state';
        this.game_log = '.game-log';
        this.current_enemy_champion = {};
        this.enterState = function() {
            this.bindPushLane()
                .bindShowEnemyChampions()
                .bindPopulateChampionStats()
                .bindFillMapIcons()
                .bindFarmMinion();
            this.current_enemy_champion = this.findCurrentEnemy();
            LOLRPG.game.player_champion.entity_display.moveToState('WorldMap');
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.enterState(this.content_container_selector);
            $(this.game_log).animate({scrollTop: $(this.game_log).prop('scrollHeight')}, 1)
        };

        this.leaveState = function() {
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.leaveState(this.content_container_selector);
        };

        this.findCurrentEnemy = function() {
            var self = this;
            var enemy = '';
            $.each(LOLRPG.game.enemy_champions, function(k, v){
                if(v.current_health > '0' && LOLRPG.empty(enemy)) {
                    enemy = LOLRPG.game.enemy_champions[k];
                }
            });
            return enemy;
        };

        this.player_champion_icon = '#player-champion-icon';
        this.player_attack_damage = '.player-attack-damage';
        this.player_ability_damage = '.player-ability-damage';
        this.player_armor = '.player-armor';
        this.player_critical_chance = '.player-critical-chance';
        this.player_health_regen = '.player-health-regen';
        this.player_champion_basic_attack = '.player-champion-basic-attack';
        this.player_champion_ability = '.champion-ability';
        this.bindPopulateChampionStats = function() {
            var champion_stats = LOLRPG.game.player_champion;
            $(this.player_champion_icon).attr('src', 'http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/' + champion_stats.image.full);
            $(this.player_attack_damage).text(champion_stats.attack_damage.total);
            $(this.player_ability_damage).text(champion_stats.ability_damage.total);
            $(this.player_armor).text(champion_stats.armor.total);
            $(this.player_critical_chance).text(champion_stats.critical_chance.total);
            $(this.player_health_regen).text(champion_stats.health_regen.total);
            // $(this.player_total_health).text(champion_stats.health.total);
            $(this.player_champion_basic_attack).attr('src', 'http://ddragon.leagueoflegends.com/cdn/6.9.1/img/spell/' + champion_stats.spells[0].image.full);
            $(this.player_champion_ability).attr('src', 'http://ddragon.leagueoflegends.com/cdn/6.9.1/img/spell/' + champion_stats.spells[3].image.full);
            // $(this.player_current_health).text(champion_stats.current_health);
            // this.managePlayerHealthBar(champion_stats.current_health);
            return this;
        };

        // this.managePlayerHealthBar = function(player_health) {
        //     var self = this;
        //     var health_percentage = (player_health / LOLRPG.game.player_champion.health.total) * 100;
            // $(this.player_health_bar).attr('width', health_percentage + '%');
        //     return this;
        // }

        this.enemy_map_icon = '.map-enemy-champion-';
        this.player_champion_map_icon = '.locked-in-champion';
        this.push_lane_button = '.button-push-lane';
        this.bindPushLane = function() {
            var self = this;
            $(LOLRPG.game_container_selector).off('click.push_lane', this.push_lane_button).on('click.push_lane', this.push_lane_button, function() {
                var position = $('[data-dead-enemy="0"]').first().position();
                if(LOLRPG.empty(position)) {
                    position = $('.map-enemy-champion-1').position();
                }
                LOLRPG.game.queueAction('delay', 1350);
                $(self.player_champion_map_icon).animate({top:position.top +30, left:position.left - 50}, 1000);
                LOLRPG.game.states.Battle.battle_type = 'champion';
                LOLRPG.game.queueAction('changeState', 'Battle');
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
                $(self.enemy_champion_icon + count).attr('src', 'http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/' + v.image.full)
                    .attr('max-height', '100%')
                    .attr('width', 'auto')
                if(v.current_health <= '0') {
                    $(self.enemy_champion_icon + count).parent().find('.dead-enemy').removeClass('hidden');
                }
                count++;
            });
            return this;
        };

        this.bindFillMapIcons = function(){
            var self = this;
            $(this.player_champion_map_icon).attr('src', 'http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/' + LOLRPG.game.player_champion.image.full);
            var count = 1;
            $.each(LOLRPG.game.enemy_champions, function(k, v) {
                if (LOLRPG.empty(v.image) || LOLRPG.empty(v.image.full)) {
                    return;
                }
                $(self.enemy_map_icon + count).attr('src', 'http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/' + v.image.full).attr('data-dead-enemy', '0')
                if(v.current_health <= 0) {
                    $(self.enemy_map_icon + count).attr('data-dead-enemy', '1');
                    $(self.enemy_map_icon + count).animate({opacity: 0}, 350);
                }
                count++;
            });
            return this;
        }

        this.farm_minion_btn_selector = '.button-farm-minion';
        this.bindFarmMinion = function() {
            var self = this;
            $(LOLRPG.game_container_selector).off('click.farm', this.farm_minion_btn_selector).on('click.farm', this.farm_minion_btn_selector, function(e) {
                e.preventDefault();
                LOLRPG.game.queueAction('delay', 3500);
                var current_position = $(self.player_champion_map_icon).position();
                $(self.player_champion_map_icon).animate({top: current_position.top -30, left: current_position.left +25}, 500)
                $(self.player_champion_map_icon).animate({top: current_position.top +30, left: current_position.left -25}, 1000)
                $(self.player_champion_map_icon).animate({top: current_position.top, left: current_position.left}, 500)
                $(this).blur();
                self.farmMinion();
            });
            return this;
        }

        this.gank_chance = 0;
        this.base_gank_chance = 5;
        this.gank_chance_increment = 7;
        this.gankable_difficulties = {
            'bronze': false,
            'silver': false,
            'gold': true,
            'platinum': true,
            'diamond': true,
            'master': true,
            'challenger': true
        }
        this.farmMinion = function() {
            var self = this;
            var can_get_ganked = false;
            if(this.gankable_difficulties[LOLRPG.game.game_difficulty] != false) {
                self.gank_chance = self.gank_chance == 0 ? self.base_gank_chance : self.gank_chance;
                var rand = Math.random() * 100;
                can_get_ganked = true;
            }
            if(!can_get_ganked || rand >= self.gank_chance) {
                LOLRPG.game.states.Battle.battle_type = 'minion';
                self.gank_chance += self.gank_chance_increment;
                LOLRPG.game.queueAction('changeState', 'Battle');
            } else {
                LOLRPG.game.states.Battle.battle_type = 'champion';
                LOLRPG.game.states.Battle.was_gank = true;
                self.gank_chance = self.base_gank_chance;
                LOLRPG.game.queueAction('changeState', 'Battle');
            }
            return this;
        }
    };
});