$(function() {
    LOLRPG.Entities = {};
    
    LOLRPG.Entities.EntityBase = function() {
        this.attack_damage = 0;
        this.ability_damage = 0;
        this.critical_chance = 0;
        this.health = 0;
        this.health_regen = 0;
        this.armor = 0;
        this.overall_modifier = 0;
        this.image = {};
        this.current_ability_cooldown = 0;
        this.current_heal_cooldown = 0;
        this.base_random_modifier = 4;
        this.entity_display = {};
        
        this.createEmptyStat = function() {
            return {'base': 0, 'bonus': 0, 'total': 0};
        }

        this.useBasicAttack = function(target) {
            var damage = this.randomizer(this.attack_damage.total, this.info.difficulty);
            var mitigation = this.randomizer(target.armor.total, target.info.difficulty);
            var calclulated_damage = damage - mitigation;
            calclulated_damage = calclulated_damage < 0 ? 0 : calclulated_damage;
            LOLRPG.game.game_log.logAction(this.name + ' attacked ' + target.name + ' with basic attack for ' + calclulated_damage + ' points of damage (' + mitigation + ' mitigated).');
            target.takeDamage(calclulated_damage);
        };

        this.useAbility = function(target) {
            var damage = this.randomizer(this.ability_damage.total, this.info.difficulty);
            var is_mage = false;
            $.each(this.tags, function(k,v) {
                if(v == 'Mage') {
                    is_mage = true;
                }
            });
            var mitigation = 0;
            if(!is_mage) {
                mitigation = this.randomizer(target.armor.total, target.info.difficulty);
            }
            var calclulated_damage = damage - mitigation;
            LOLRPG.game.game_log.logAction(this.name + ' attacked ' + target.name + ' with ' + this.spells[3].name + ' for ' + calclulated_damage + ' points of damage (' + mitigation + ' mitigated).');
            target.takeDamage(calclulated_damage);
        };

        this.useHeal = function() {
            var heal = this.randomizer(this.healing.total, this.info.difficulty);
            var summoner_name = typeof LOLRPG.game.summoner_data.name != 'undefined' ? LOLRPG.game.summoner_data.name : 'Summoner';
            LOLRPG.game.game_log.logAction(summoner_name + ' healed ' + this.name + ' for ' + heal + ' hit points.');
            this.healDamage(heal);
        };

        this.regenHealth = function() {
            if(this.current_health > 0) {
                var regen = this.randomizer(this.health_regen.total, this.info.difficulty);
                LOLRPG.game.game_log.logAction(this.name + ' regenerated ' + regen + ' hit points.');
                this.healDamage(regen);
            }
        };

        this.takeDamage = function(damage) {
            if(this.current_health > 0) {
                this.current_health -= damage;
                LOLRPG.game.game_log.logAction(this.name + ' has ' + this.current_health + ' hit points left');
                //adjust health bar here
                if(this.current_health <= 0) {
                    this.current_health = 0;
                    LOLRPG.game.game_log.logAction(this.name + ' is dead.')
                }
                if(typeof this.entity_display.changeHealth != 'undefined') {
                    this.entity_display.changeHealth(this.current_health, this.health.total);
                }
            }
        }

        this.healDamage = function(heal) {
            console.log(heal);
            this.current_health += heal;
            //adjust health bar here
            if(this.current_health > this.health.total) {
                this.current_health = this.health.total;
            }
            if(typeof this.entity_display.changeHealth != 'undefined') {
                this.entity_display.changeHealth(this.current_health, this.health.total);
            }
            console.log(this.current_health);
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

        this.aiAction = function() {
            if(this.current_ability_cooldown == 0 && Math.random() >= .5) {
                this.useAbility(LOLRPG.game.player_champion);
            } else {
                this.useBasicAttack(LOLRPG.game.player_champion);
            }
        }
    };

    LOLRPG.Entities.EntityBase.prototype.constructor = function() {
        this.attack_damage = this.createEmptyStat();
        this.ability_damage = this.createEmptyStat();
        this.critical_chance = this.createEmptyStat();
        this.health = this.createEmptyStat();
        this.health_regen = this.createEmptyStat();
        this.armor = this.createEmptyStat();
    }

});