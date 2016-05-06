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
            var difficulty = typeof this.info != 'undefined' && typeof this.info.difficulty != 'undefined' ? typeof this.info.difficulty : 1;
            var damage = this.randomizer(this.attack_damage.total, difficulty);
            var was_crit = false;
            if(Math.random() * 100 <= this.critical_chance.total) {
                damage = Math.ceil(damage * this.critical_damage_multiplier);
                was_crit = true;
            }
            var target_difficulty = typeof target.info != 'undefined' && typeof target.info.difficulty != 'undefined' ? typeof target.info.difficulty : 1;
            var mitigation = this.randomizer(target.armor.total, target_difficulty);
            var calclulated_damage = damage - mitigation;
            calclulated_damage = calclulated_damage < 0 ? 0 : calclulated_damage;
            var name_span = !this.isPlayerChampion(target) ? '<span class="player-name">' : '<span class="enemy-name">';
            name_span += this.name + '</span>';
            LOLRPG.game.game_log.logAction(name_span + (was_crit ? ' <span class="bold">critically</span> ' : '') + ' attacked ' + target.name + ' with basic attack for ' + calclulated_damage + ' points of damage (' + mitigation + ' mitigated).');
            target.takeDamage(calclulated_damage);
        };

        this.useAbility = function(target) {
            var difficulty = typeof this.info != 'undefined' && typeof this.info.difficulty != 'undefined' ? typeof this.info.difficulty : 1;
            var damage = this.randomizer(this.ability_damage.total, difficulty);
            var was_crit = false;
            if(Math.random() * 100 <= this.critical_chance.total) {
                damage = Math.ceil(damage * this.critical_damage_multiplier);
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
            var name_span = !this.isPlayerChampion(target) ? '<span class="player-name">' : '<span class="enemy-name">';
            name_span += this.name + '</span>';
            LOLRPG.game.game_log.logAction(name_span + (was_crit ? ' <span class="bold">critically</span> ' : '') + ' hit ' + target.name + ' with ' + this.spells[3].name + ' for ' + calclulated_damage + ' points of damage (' + mitigation + ' mitigated).');
            target.takeDamage(calclulated_damage);
        };

        this.useHeal = function() {
            var heal = this.randomizer(this.healing.total, this.info.difficulty);
            var summoner_name = typeof LOLRPG.game.summoner_data.name != 'undefined' ? LOLRPG.game.summoner_data.name : 'Summoner';
            var name_span = this.isPlayerChampion(this) ? '<span class="player-name">' : '<span class="enemy-name">';
            name_span += this.name + '</span>';
            LOLRPG.game.game_log.logAction(summoner_name + ' healed ' + name_span + ' for ' + heal + ' hit points.');
            this.healDamage(heal);
        };

        this.regenHealth = function() {
            if(this.current_health > 0) {
                var regen = this.randomizer(this.health_regen.total, this.info.difficulty);
                // var name_span = this.isPlayerChampion(target) ? '<span class="player-name">' : '<span class="enemy-name">';
                // name_span += this.name + '</span>';
                // LOLRPG.game.game_log.logAction(name_span + ' regenerated ' + regen + ' hit points.');
                this.healDamage(regen);
            }
        };

        this.takeDamage = function(damage) {
            if(this.current_health > 0) {
                this.current_health -= damage;
                // var name_span = this.isPlayerChampion(target) ? '<span class="player-name">' : '<span class="enemy-name">';
                // name_span += this.name + '</span>';
                // LOLRPG.game.game_log.logAction(name_span + ' has ' + this.current_health + ' hit points left');
                //adjust health bar here
                if(this.current_health <= 0) {
                    this.current_health = 0;
                    LOLRPG.game.game_log.logAction(this.name + ' is dead.')
                }
                if(typeof this.entity_display.changeHealth != 'undefined') {
                    this.entity_display.changeHealth(this.current_health, this.health.total);
                    // $('.enemy-battle-container img').effect('shake', {'distance': 20, 'times': 3}, 150, function() { console.log('shook') });
                    //puff
                }
            }
        }

        this.healDamage = function(heal) {
            this.current_health += heal;
            //adjust health bar here
            if(this.current_health > this.health.total) {
                this.current_health = this.health.total;
            }
            if(typeof this.entity_display.changeHealth != 'undefined') {
                this.entity_display.changeHealth(this.current_health, this.health.total);
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

        this.aiAction = function() {
            if(this.current_ability_cooldown == 0 && Math.random() >= .5) {
                this.useAbility(LOLRPG.game.player_champion);
            } else {
                this.useBasicAttack(LOLRPG.game.player_champion);
            }
        }

        this.isPlayerChampion = function(champion) {
            if(Object.is(LOLRPG.game.player_champion, champion)) {
                return true;
            }
            return false;
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