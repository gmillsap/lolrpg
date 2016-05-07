$(function() {
    LOLRPG.Entities = {};
    
    LOLRPG.Entities.EntityBase = function() {
        this.attack_damage = 0;
        this.ability_damage = 0;
        this.critical_chance = 0;
        this.health = 0;
        this.health_regen = 0;
        this.armor = 0;
        this.critical_damage_multiplier = 1.5;
        this.fighter_ciritical_damage_multiplier = 2;
        this.overall_modifier = 0;
        this.image = {};
        this.current_ability_cooldown = 0;
        this.base_ability_cooldown = 3;
        this.current_heal_cooldown = 0;
        this.base_heal_cooldown = 12;
        this.base_random_modifier = 4;
        this.entity_display = {};
        this.health_display = null;
        this.battle_display = null;
        this.ability_display = null;
        this.marksman_bonus_true_damage = 0;
        this.support_ability_bonus = false;
        this.support_ability_modifier = .2;

        this.createEmptyStat = function() {
            return {'base': 0, 'bonus': 0, 'total': 0};
        }
        
        this.initiateTurn = function() {
            var self = this;
            LOLRPG.game.game_log.logAction(self.getNameSpan() + '\'s turn.');
            if(this.current_ability_cooldown > 0) {
                self.current_ability_cooldown--;
                console.log(self.tags);
                if(typeof self.tags != 'undefined' && self.tags[0] == 'Mage') {
                    if(typeof self.tags[1] == 'undefined' || self.tags[1] != 'Fighter') {
                        var random = Math.random();
                        if(random > .6) {
                            var name_span = this.getNameSpan();
                            LOLRPG.game.game_log.logAction(name_span + ' <span class="bold">focused</span> and quickened their spell recover by one round.');
                            self.current_ability_cooldown--;
                        }
                    }
                }
            }
            if(this.current_heal_cooldown > 0) {
                self.current_heal_cooldown--;
            }
            if(!LOLRPG.empty(self.ability_display)) {
                self.ability_display.setFirstAbilityCooldown(self.current_ability_cooldown)
                    .setSummonerHealCooldown(self.current_heal_cooldown);
            }
        }

        this.useBasicAttack = function(target) {
            var difficulty = typeof this.info != 'undefined' && typeof this.info.difficulty != 'undefined' ? typeof this.info.difficulty : 1;
            var damage = this.randomizer(this.attack_damage.total, difficulty);
            var empowered_damage = 0;
            if(this.support_ability_bonus) {
                this.support_ability_bonus = false;
                empowered_damage = Math.ceil(damage * this.support_ability_modifier);
            }
            damage += empowered_damage;
            var was_crit = false;
            if(Math.random() * 100 <= this.critical_chance.total) {
                var crit_multiplier = this.critical_damage_multiplier
                var crit_word = 'critically';
                if(typeof this.tags != 'undefined' && this.tags[0] == 'Fighter') {
                    crit_multiplier = this.fighter_ciritical_damage_multiplier;
                    crit_word = 'devastatingly';
                }
                damage = Math.ceil(damage * crit_multiplier);
                was_crit = true;
            }
            var target_difficulty = typeof target.info != 'undefined' && typeof target.info.difficulty != 'undefined' ? typeof target.info.difficulty : 1;
            var true_damage = 0;
            var mitigation = this.randomizer(target.armor.total, target_difficulty);
            if(typeof this.tags != 'undefined' && this.tags[0] == 'Marksman' && LOLRPG.game.states.Battle.battle_type == 'champion') {
                var true_damage = this.overall_modifier != 0 ? Math.ceil(this.marksman_bonus_true_damage * this.overall_modifier / 24) : this.marksman_bonus_true_damage;
                if(was_crit) {
                    true_damage = Math.ceil(this.randomizer(true_damage * this.critical_damage_multiplier, difficulty));
                }
            }
            damage += true_damage;
            var calclulated_damage = damage - mitigation;
            calclulated_damage = calclulated_damage < 0 ? 0 : calclulated_damage;
            var name_span = this.getNameSpan();
            LOLRPG.game.game_log.logAction(name_span + (was_crit ? ' <span class="bold">' + crit_word + '</span> ' : '') + ' attacked ' + target.name + ' with basic attack for ' + calclulated_damage + ' points of damage (' + mitigation + ' mitigated' + (true_damage > 0 ? ', ' + true_damage + ' points of true damage' : '') + (empowered_damage > 0 ? ', ' + empowered_damage + ' bonus empowered damage' : '') + ').');
            if(typeof this.tags != 'undefined' && this.tags[0] == 'Tank') {
                if(target.current_ability_cooldown > 0) {
                    if(Math.random() > .5) {
                        target.current_ability_cooldown = target.current_ability_cooldown + 1;
                        LOLRPG.game.game_log.logAction(this.getNameSpan() + ' slammed into ' + target.getNameSpan() + ' interrupting their concentration and increasing their ability cooldown by 1 round.');
                    }
                }
            }
            target.takeDamage(calclulated_damage, was_crit);
        };

        this.useAbility = function(target) {
            this.current_ability_cooldown = this.base_ability_cooldown;
            if(!LOLRPG.empty(this.ability_display)) {
                this.ability_display.setFirstAbilityCooldown(this.current_ability_cooldown);
            }
            var difficulty = typeof this.info != 'undefined' && typeof this.info.difficulty != 'undefined' ? typeof this.info.difficulty : 1;
            var damage = this.randomizer(this.ability_damage.total, difficulty);
            var was_crit = false;
            if(Math.random() * 100 <= this.critical_chance.total) {
                var crit_multiplier = this.critical_damage_multiplier
                var crit_word = 'critically';
                if(typeof this.tags != 'undefined' && this.tags[0] == 'Fighter') {
                    crit_multiplier = this.fighter_ciritical_damage_multiplier;
                    crit_word = 'devastatingly';
                }
                damage = Math.ceil(damage * crit_multiplier);
                was_crit = true;
            }
            var is_mage = false;
            $.each(this.tags, function(k,v) {
                if(v == 'Mage') {
                    is_mage = true;
                }
            });
            var mitigation = 0;
            if(!is_mage) {
                var target_difficulty = typeof target.info != 'undefined' && typeof target.info.difficulty != 'undefined' ? typeof target.info.difficulty : 1;
                mitigation = this.randomizer(target.armor.total, target_difficulty);
            }
            var calclulated_damage = damage - mitigation;
            var name_span = this.getNameSpan();
            if(typeof this.tags != 'undefined' && this.tags[0] == 'Support') {
                this.support_ability_bonus = true;
                LOLRPG.game.game_log.logAction(this.getNameSpan() + ' empowers their next attack.');
            }
            LOLRPG.game.game_log.logAction(name_span + (was_crit ? ' <span class="bold">' + crit_word + '</span> ' : '') + ' hit ' + target.name + ' with ' + this.spells[3].name + ' for ' + calclulated_damage + ' points of damage (' + mitigation + ' mitigated).');
            target.takeDamage(calclulated_damage, was_crit);
        };

        this.useHeal = function() {
            this.current_heal_cooldown = this.base_heal_cooldown;
            if(!LOLRPG.empty(this.ability_display)) {
                this.ability_display.setSummonerHealCooldown(this.current_heal_cooldown);
            }
            var heal = this.randomizer(this.healing.total, this.info.difficulty);
            var empowered_heal = 0;
            if(this.support_ability_bonus) {
                this.support_ability_bonus = false;
                empowered_heal = Math.ceil(heal * this.support_ability_modifier);
            }
            heal += empowered_heal;
            var summoner_name = typeof LOLRPG.game.summoner_data.name != 'undefined' ? LOLRPG.game.summoner_data.name : 'Summoner';
            var name_span = this.getNameSpan();
            LOLRPG.game.game_log.logAction(summoner_name + ' healed ' + name_span + ' for ' + heal + ' hit points' + (empowered_heal > 0 ? ' (' + empowered_heal + ' empowered healing)' : '') + '.');
            LOLRPG.game.queueAction('delay', 250);
            this.healDamage(heal);
        };

        this.regenHealth = function() {
            if(this.current_health > 0) {
                var regen = this.randomizer(this.health_regen.total, this.info.difficulty);
                if(regen <= 0) {
                    return;
                }
                var name_span = this.getNameSpan();
                if(this.current_health < this.health.total) {
                    LOLRPG.game.game_log.logAction(name_span + ' regenerated ' + regen)
                    this.healDamage(regen);
                }
            }
        };

        this.takeDamage = function(damage, was_crit) {
            if(this.current_health > 0) {
                if(!LOLRPG.empty(this.health_display)) {
                    this.health_display.updateDisplay(-1 * damage);
                }
                if(!LOLRPG.empty(this.battle_display)) {
                    if(was_crit) {
                        this.battle_display.critChampion(damage);
                    } else {
                        this.battle_display.hitChampion(damage);
                    }
                }
                this.current_health -= damage;
                if(this.current_health <= 0) {
                    this.current_health = 0;
                    LOLRPG.game.purgeActionQueue();
                    LOLRPG.game.game_log.logAction(this.name + ' is dead.')
                }
            }
        }

        this.healDamage = function(heal) {
            this.current_health += heal;
            if(!LOLRPG.empty(this.battle_display)) {
                this.battle_display.healChampion(heal);
            }
            if(!LOLRPG.empty(this.health_display)) {
                this.health_display.updateDisplay(heal);
            }
            if(this.current_health > this.health.total) {
                this.current_health = this.health.total;
            }
        }

        this.randomizer = function(num, difficulty) {
            difficulty = parseInt(difficulty) || 0;
            var total_random_modifier = this.base_random_modifier + difficulty;
            var random_percent = parseFloat((total_random_modifier / 2 * 5).toFixed(2));
            var min = random_percent > 0 ? num - (num * (random_percent / 100)) : num;
            var max = random_percent > 0 ? num + (num * (random_percent / 100)) : num;
            var spread = max - min;
            var additional = Math.ceil(Math.random() * spread);
            var total = Math.ceil(min + additional);
            return total;
        }

        this.aiAction = function(callback) {
            if(this.current_ability_cooldown == 0 && Math.random() >= .5) {
                callback('useAbility');
            } else {
                callback('useBasicAttack');
            }
        }

        this.isPlayerChampion = function(champion) {
            if(Object.is(LOLRPG.game.player_champion, champion)) {
                return true;
            }
            return false;
        }

        this.getNameSpan = function() {
            var name_span = '<span class="';
            if(this.isPlayerChampion(this)) {
                name_span += 'player-name">';
            } else {
                name_span += 'enemy-name">';
            }
            name_span += this.name + '</span>';
            return name_span;
        }
    };

});