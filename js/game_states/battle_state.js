$(function() {
    LOLRPG.GameStates.Battle = function() {
        LOLRPG.GameStates.GameStateBase.apply(this);
        this.content_container_selector = '#lolrpg-battle-state';
        this.enemy_champion_splash = '#enemy-champion-splash';
        this.battle_type = '';
        this.player_champion = {};
        this.enemy = {};
        this.was_gank = false;
        this.enterState = function() {
            var self = this;
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.enterState(this.content_container_selector);
            LOLRPG.game.player_champion_display.moveToState('Battle');
            LOLRPG.game.states.WorldMap.bindPopulateChampionStats();
            this.player_champion = LOLRPG.game.player_champion;
            if(this.was_gank) {
                LOLRPG.game.game_log.logAction('Enemy Jungler has attempted to gank you!')
                this.was_gank = false;
            }
            this.turnOnBindings();
            if(this.battle_type == 'champion') {
                $.each(LOLRPG.game.enemy_champions, function(k,v) {
                    // LOLRPG.game.current_enemy = Object.assign({}, v);
                    if(v.current_health > 0) {
                        LOLRPG.game.current_enemy = v;
                        self.enemy = LOLRPG.game.current_enemy;
                        // delete LOLRPG.game.enemy_champions[k];
                        return false;
                    }
                });
            } else {
                var chance = Math.random() * 100;
                if(chance < 50) {
                    self.enemy = new LOLRPG.Entities.FighterMinion();
                } else if(chance < 80) {
                    self.enemy = new LOLRPG.Entities.MageMinion();
                } else {
                    self.enemy = new LOLRPG.Entities.CannonMinion();
                }
                var modifier = LOLRPG.game.states.ChampionSelect.difficulty_coefficients[LOLRPG.game.game_difficulty];
                self.enemy.generateMinion(modifier)
            }
        };

        this.leaveState = function() {
            var base_state = new LOLRPG.GameStates.GameStateBase();
            LOLRPG.game.game_log.clearLog();
            base_state.leaveState(this.content_container_selector);
            this.battle_type = '';
        };

        this.turnOnBindings = function() {
            this.bindChampionBasicAttack()
                .bindChampionAbility()
                .bindChampionHeal();
        }

        this.turnOffBindings = function() {
            this.unbindChampionBasicAttack()
                .unbindChampionAbility()
                .unbindChampionHeal();
        }

        this.basic_attack_button = '.player-champion-basic-attack';
        this.bindChampionBasicAttack = function() {
            var self = this;
            $(this.basic_attack_button).off('click.basic_attack').on('click.basic_attack', function(e) {
                e.preventDefault();
                self.turnOffBindings();
                LOLRPG.game.queueModelAction(self.player_champion, 'useBasicAttack', self.enemy, function() {
                    self.changeTurn(self.enemy);
                });
            });
            return this;
        };

        this.ability_attack_button = '.player-champion-ability';
        this.bindChampionAbility = function() {
            var self = this;
            $(this.ability_attack_button).off('click.ability').on('click.ability', function(e) {
                e.preventDefault();
                var $btn = $(this);
                self.turnOffBindings();
                LOLRPG.game.queueModelAction(self.player_champion, 'useAbility', self.enemy, function() {
                    self.changeTurn(self.enemy);
                });
            });
            return this;
        };

        this.heal_button = '.summoner-heal';
        this.bindChampionHeal = function() {
            var self = this;
            $(this.heal_button).off('click.heal').on('click.heal', function(e) {
                e.preventDefault();
                var $btn = $(this);
                self.turnOffBindings();
                LOLRPG.game.queueModelAction(self.player_champion, 'useHeal', self.enemy, function() {
                    self.changeTurn(self.enemy);
                });
            });
            return this;
        };


        this.unbindChampionBasicAttack = function() {
            $(this.basic_attack_button).off('click.basic_attack');
            return this;
        };

        this.unbindChampionAbility = function() {
            $(this.ability_attack_button).off('click.ability')
            return this;
        };

        this.unbindChampionHeal = function() {
            $(this.heal_button).off('click.heal');
            return this;
        };

        this.changeTurn = function(champion) {
            var self = this;
            LOLRPG.game.queueAction('delay', 1350);
            LOLRPG.game.queueModelAction(champion, 'regenHealth', '', function() {
                if(Object.is(champion, self.enemy)) {
                    if(champion.current_health <= 0) {
                        console.log('YOU WIN');
                        return LOLRPG.game.queueAction('changeState', 'WorldMap');
                    }
                    console.log('enemy action');
                    LOLRPG.game.queueAction('delay', 500);
                    LOLRPG.game.queueModelAction(champion, 'aiAction');
                    self.changeTurn(self.player_champion);
                } else {
                    if(champion.current_health <= 0) {
                        console.log('YOU FUCKING DIED');
                        return LOLRPG.game.queueAction('enterState', 'Login');
                    }
                    self.turnOnBindings();
                }
            });
        }
    };
});