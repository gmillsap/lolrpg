$(function() {
    LOLRPG.GameStates.Battle = function() {
        LOLRPG.GameStates.GameStateBase.apply(this);
        this.content_container_selector = '#lolrpg-battle-state';
        this.enemy_battle_container_selector = '.enemy-battle-container';
        this.enemy_champion_battle_portrait_selector = '.enemy-battle-container';
        this.background_selector = '#battle-background';
        this.last_battle_background = '/img/battle_screen/tower_battle_bg.jpg';
        this.default_battle_background = '/img/battle_screens/shadow_isles.jpg';
        this.battle_type = '';
        this.player_champion = {};
        this.enemy = {};
        this.was_gank = false;
        this.action_delay = 500;
        this.slain_champions = 0;
        this.consecutive_kills = 0;
        this.enterState = function() {
            var self = this;
            var base_state = new LOLRPG.GameStates.GameStateBase();
            LOLRPG.game.player_champion.entity_display.moveToState('Battle');
            LOLRPG.game.states.WorldMap.bindPopulateChampionStats();
            this.player_champion = LOLRPG.game.player_champion;
            LOLRPG.game.game_log.clearLog();
            if(this.was_gank) {
                LOLRPG.game.game_log.logAction('Enemy Jungler has attempted to gank you!')
            }
            if(this.battle_type == 'champion') {
                if(this.slain_champions == 4) {
                    $(this.background_selector).css('background-imgage', 'url("' + this.last_battle_background + '")');
                } else {
                    $(this.background_selector).css('background-imgage', 'url("' + this.default_battle_background + '")');
                }
                $.each(LOLRPG.game.enemy_champions, function(k,v) {
                    if(v.current_health > 0) {
                        LOLRPG.game.current_enemy = v;
                        self.enemy = LOLRPG.game.current_enemy;
                        return false;
                    }
                });
                this.enemy.increaseStatsBasedOnKills(this.slain_champions)
            } else {
                this.consecutive_kills = 0;
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
            var $enemy_health = $(this.enemy_battle_container_selector);
            var enemy_health_display = new LOLRPG.Displays.Health();
            enemy_health_display.$container = $enemy_health;
            enemy_health_display.current_health = this.enemy.current_health;
            enemy_health_display.max_health = this.enemy.health.total;
            this.enemy.health_display = enemy_health_display;
            this.enemy.health_display.setToFull();
            var $enemy_battle_portrait = $(this.enemy_champion_battle_portrait_selector);
            var enemy_portrait_display = new LOLRPG.Displays.BattlePortrait();
            enemy_portrait_display.$container = $enemy_battle_portrait;
            if(typeof this.enemy.images != 'undefined') {
                var random_img = this.enemy.images[Math.floor(Math.random() * this.enemy.images.length)];
                enemy_portrait_display.setImage(random_img)
            } else {
                enemy_portrait_display.setImage('http://ddragon.leagueoflegends.com/cdn/img/champion/loading/' + this.enemy.key + '_0.jpg')
            }
            enemy_portrait_display.setName(this.enemy.name);
            this.enemy.battle_display = enemy_portrait_display;
            if(!this.was_gank && this.battle_type == 'champion' && typeof this.player_champion.tags != 'undefined' && this.player_champion.tags[0] == 'Assassin') {
                var gank_damage = Math.floor(this.enemy.current_health * LOLRPG.game.states.ChampionSelect.assassin_gank_percent);
                LOLRPG.game.game_log.logAction(this.player_champion.getNameSpan() + ' <span class="bold">ambushed</span> then enemy champion dealing ' + gank_damage + '.');
                this.enemy.battle_display.skip_animation = true;
                this.enemy.takeDamage(gank_damage, false, 'no-animation');
                this.enemy.battle_display.skip_animation = false;
            }
            base_state.enterState(this.content_container_selector);
            this.turnOnBindings();
        };

        this.leaveState = function() {
            var base_state = new LOLRPG.GameStates.GameStateBase();
            this.enemy.battle_display.clearImage();
            base_state.leaveState(this.content_container_selector);
            this.battle_type = '';
        };

        this.turnOnBindings = function() {
            this.bindChampionBasicAttack();
            if(this.player_champion.current_ability_cooldown <= 0) {
                this.bindChampionAbility();
            }
            if(this.player_champion.current_heal_cooldown <= 0) {
                this.bindChampionHeal();
            }
            this.player_champion.ability_display.unfadeActions();
        }

        this.turnOffBindings = function() {
            this.unbindChampionBasicAttack()
                .unbindChampionAbility()
                .unbindChampionHeal();
            this.player_champion.ability_display.fadeActions();
        }

        this.basic_attack_button = '.player-champion-basic-attack';
        this.bindChampionBasicAttack = function() {
            var self = this;
            $(this.basic_attack_button).off('click.basic_attack').on('click.basic_attack', function(e) {
                e.preventDefault();
                self.turnOffBindings();
                LOLRPG.game.queueModelAction(self.player_champion, 'useBasicAttack', self.enemy, function() {
                    LOLRPG.game.queueAction('delay', self.action_delay, function() {
                        LOLRPG.game.queueModelAction(self, 'changeTurn', self.enemy);
                    });
                });
            });
            return this;
        };

        this.ability_attack_button = '.champion-ability';
        this.bindChampionAbility = function() {
            var self = this;
            $(this.ability_attack_button).off('click.ability').on('click.ability', function(e) {
                e.preventDefault();
                var $btn = $(this);
                self.turnOffBindings();
                LOLRPG.game.queueModelAction(self.player_champion, 'useAbility', self.enemy, function() {
                    LOLRPG.game.queueAction('delay', self.action_delay, function() {
                        LOLRPG.game.queueModelAction(self, 'changeTurn', self.enemy);
                    });
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
                    LOLRPG.game.queueAction('delay', self.action_delay, function() {
                        LOLRPG.game.queueModelAction(self, 'changeTurn', self.enemy);
                    });
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

        this.champion_xp_multipliers = {
            '1': 1,
            '2': 2,
            '3': 3,
            '4': 5
        }
        this.changeTurn = function(champion) {
            var self = this;
            if(Object.is(champion, self.enemy)) {
                if(champion.current_health <= 0) {
                    LOLRPG.game.purgeActionQueue();
                    if(this.battle_type == 'champion') {
                        this.consecutive_kills++;
                    }
                    if(this.battle_type == 'champion') {
                        this.slain_champions = this.slain_champions + 1;
                        this.player_champion.addXp(this.champion_xp_multipliers[this.slain_champions] * champion.xp_value);
                    } else {
                        this.player_champion.addXp(champion.xp_value);
                    }
                    if(this.slain_champions >= 5) {

                        return LOLRPG.game.queueModelAction(this, 'battleVictoryScreen', function() {
                            LOLRPG.game.queueModelAction(self, 'mapVictoryScreen');
                        });
                    }
                    this.was_gank = false;
                    this.player_champion.current_ability_cooldown = this.player_champion.current_ability_cooldown > 0 ? this.player_champion.current_ability_cooldown-1 : this.player_champion.current_ability_cooldown;
                    this.player_champion.current_heal_cooldown = this.player_champion.current_heal_cooldown > 0 ? this.player_champion.current_heal_cooldown-1 : this.player_champion.current_heal_cooldown;
                    this.player_champion.ability_display.setFirstAbilityCooldown(this.player_champion.current_ability_cooldown)
                        .setSummonerHealCooldown(this.player_champion.current_heal_cooldown);
                    return LOLRPG.game.queueModelAction(this, 'battleVictoryScreen');
                }
                LOLRPG.game.queueAction('delay', self.action_delay, function() {
                    LOLRPG.game.queueModelAction(champion, 'initiateTurn', '', function() {
                        LOLRPG.game.queueAction('delay', self.action_delay, function() {
                            LOLRPG.game.queueModelAction(champion, 'regenHealth', '', function() {
                                LOLRPG.game.queueAction('delay', self.action_delay, function() {
                                    LOLRPG.game.queueModelAction(champion, 'aiAction', function(action){
                                        LOLRPG.game.queueAction('delay', self.action_delay, function() {
                                            LOLRPG.game.queueModelAction(champion, action, self.player_champion, function() {
                                                LOLRPG.game.queueAction('delay', self.action_delay, function() {
                                                    LOLRPG.game.queueModelAction(self, 'changeTurn', self.player_champion, function() {
                                                        LOLRPG.game.queueAction('delay', self.action_delay, function() {
                                                            LOLRPG.game.queueModelAction(self.player_champion, 'initiateTurn', '', function() {
                                                                LOLRPG.game.queueAction('delay', self.action_delay, function() {
                                                                    LOLRPG.game.queueModelAction(self.player_champion, 'regenHealth', '', function() {
                                                                        self.turnOnBindings();
                                                                    });
                                                                });
                                                            });
                                                        });
                                                    });
                                                });
                                            });
                                        });
                                    });
                                });
                            });
                        });
                    });
                });
            } else {
                if(champion.current_health <= 0) {
                    LOLRPG.game.purgeActionQueue();
                    return LOLRPG.game.queueModelAction(this, 'battleDefeatScreen');
                }
            }
        }

        this.victory_images = {
            '0': {'kills': '/img/shutdown.png', 'type_class': '.shutdown-kill'},
            '1': {'kills': '/img/shutdown.png', 'type_class': '.shutdown-kill'},
            '2': {'kills': '/img/double_kill.png', 'type_class': '.double-kill'},
            '3': {'kills': '/img/triple_kill.png', 'type_class': '.triple-kill'},
            '4': {'kills': '/img/quadra_kill.png', 'type_class': '.quadra-kill'},
            '5': {'kills': '/img/penta_kill.png', 'type_class': '.penta-kill'}
        }
        this.minion_victory = '/img/minion_victory.png';
        this.victory_portrait_selector = '#kill-circle';
        this.move_to_world_map_button_selector = '.victory-return-to-world-map';
        this.victory_modal_selector = '#battle-victory-modal';
        this.battleVictoryScreen = function(callback) {
            callback = callback || function() {
                return LOLRPG.game.queueAction('changeState', 'WorldMap');
            };
            $.each(this.victory_images, function(k, v) {
                var share_container = v['type_class'] + '-' + LOLRPG.game.game_difficulty;
                $(share_container).addClass('hidden');
            });
            var $modal = $(this.victory_modal_selector);
            var image = this.victory_images[this.consecutive_kills]['kills'];
            var kill_type = this.victory_images[this.consecutive_kills]['type_class'] + '-' + LOLRPG.game.game_difficulty;
            if(this.battle_type == 'minion') {
                image = this.minion_victory;
            }
            $(kill_type).removeClass('hidden');
            $(this.victory_modal_selector + ' .modal-content').css('background-image', 'url("' + image + '")');
            $(this.victory_portrait_selector).css('background-image', 'url("http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/' + this.player_champion.key + '.png")');
            $(this.move_to_world_map_button_selector).off('click.return').on('click.return', function(e) {
                e.preventDefault();
                $(this).blur();
                $modal.modal('hide');
            });
            $modal.modal('show');
            $modal.off('hidden.bs.modal.return').on('hidden.bs.modal.return', function() {
                callback();
            });
            return this;
        }

        this.defeat_image = '/img/you_are_dead.png';
        this.battleDefeatScreen = function() {
            $('body').css('-webkit-filter',  'grayscale(100%)')
                .css('filter', 'grayscale(100%');
            var $modal = $(this.victory_modal_selector).modal({
                'backdrop': 'static',
                'keyboard': false
            });
            var image = this.defeat_image;
            $(this.victory_modal_selector + ' .modal-content').css('background-image', 'url("' + image + '")');
            $(this.victory_portrait_selector).css('background-image', 'url("http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/' + this.player_champion.key + '.png")');
            $(this.move_to_world_map_button_selector).text('Return to Login Screen');
            $(this.move_to_world_map_button_selector).off('click.return').on('click.return', function(e) {
                e.preventDefault();
                $(this).blur();
                $modal.modal('hide');
                window.location.href = window.location.href;
            });
            $modal.off('hidden.bs.modal.return').on('hidden.bs.modal.return', function() {
                window.location.href = window.location.href;
            });
            $modal.modal('show');
            return this;
        }

        this.map_victory_image = '/img/map_victory.png';
        this.mapVictoryScreen = function() {
            var $modal = $(this.victory_modal_selector);
            var image = this.map_victory_image;
            $(this.victory_modal_selector + ' .modal-content').css('background-image', 'url("' + image + '")');
            $(this.victory_portrait_selector).addClass('hidden');
            $(this.move_to_world_map_button_selector).text('Return to Login Screen');
            $(this.move_to_world_map_button_selector).off('click.return').on('click.return', function(e) {
                e.preventDefault();
                $(this).blur();
                $modal.modal('hide');
                window.location.href = window.location.href;
            });
            $modal.off('hidden.bs.modal.return').on('hidden.bs.modal.return', function() {
                window.location.href = window.location.href;
            });
            $modal.modal('show');
            return this;
        }
    };
});