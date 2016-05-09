$(function() {
    LOLRPG.Entities.Champion = function() {
        LOLRPG.Entities.EntityBase.apply(this);

        this.info = {};
        this.stats = {};
        this.spells = {};
        this.tags = {};
        this.healing = {};
        this.key = '';
        this.current_xp = 0;
        this.current_level = 1;
        this.xp_value = 5;
        this.unspent_attribute_points = 0;

        this.champion_base_health_modifier = 500;
        this.champion_base_healing_modifier = 29;
        this.mage_base_healing_modifier = 34;
        this.champion_stat_coefficients = {
            'info_attack_damage': 2.4,
            'info_magic_attack_damage': 1.3,
            'stats_attack_damage': .65,
            'attack_speed': -5.2,

            'info_magic_ability_power': 15,
            'info_attack_ability_power': 9.5,

            'stats_attack_damager_per_level_critical_chance': 1,
            'info_attack_critical_chance': .2,
            'info_magic_critical_chance': .2,

            'info_defense_health': 17,
            'stats_hp_health': .45,

            'stats_health_regen': 1.2,
            'info_defense_health_regen': .65,
            'info_magic_health_regen': .5,

            'info_defense_armor': 1.35,
            'stats_armor': .4,

            'info_magic_healing': .26
        };
        this.marksman_bonus_true_damage = 13;

        this.loadLolRpgStats = function(stats) {
            this.attack_damage = !LOLRPG.empty(stats.attack_damage) ? stats.attack_damage : this.createEmptyStat();
            this.ability_damage = !LOLRPG.empty(stats.ability_damage) ? stats.ability_damage : this.createEmptyStat();
            this.critical_chance = !LOLRPG.empty(stats.critical_chance) ? stats.critical_chance : this.createEmptyStat();
            this.health = !LOLRPG.empty(stats.health) ? stats.health : this.createEmptyStat();
            this.health_regen = !LOLRPG.empty(stats.health_regen) ? stats.health_regen : this.createEmptyStat();
            this.current_health = !LOLRPG.empty(stats.health.total) ? stats.health.total : this.createEmptyStat();
            this.armor = !LOLRPG.empty(stats.armor) ? stats.armor : this.createEmptyStat();
            this.healing = !LOLRPG.empty(stats.healing) ? stats.healing : this.createEmptyStat();
            return this;
        }
        
        this.loadLolChampData = function(champion_data) {
            this.name = !LOLRPG.empty(champion_data.name) ? champion_data.name : '';
            this.info = !LOLRPG.empty(champion_data.info) ? champion_data.info : {};
            this.stats = !LOLRPG.empty(champion_data.stats) ? champion_data.stats : {};
            this.spells = !LOLRPG.empty(champion_data.spells) ? champion_data.spells : {};
            this.tags = !LOLRPG.empty(champion_data.tags) ? champion_data.tags : {};
            this.image = !LOLRPG.empty(champion_data.image) ? champion_data.image : {};
            this.key = !LOLRPG.empty(champion_data.key) ? champion_data.key : {};
            if(typeof champion_data.tags != 'undefined' && champion_data.tags[0] == 'Mage') {
                this.base_heal_cooldown = 10;
            }
            return this;
        }

        this.calculateLolRpgStats = function(champion_data, modifier) {
            this.attack_damage = this.calculateAttackDamage(champion_data, modifier);
            this.ability_damage = this.calculateAbilityDamage(champion_data, modifier);
            this.critical_chance = this.calculateCriticalChance(champion_data, modifier);
            this.health = this.calculateHealth(champion_data, modifier);
            this.health_regen = this.calculateHealthRegen(champion_data, modifier);
            this.armor = this.calculateArmor(champion_data, modifier);
            this.current_health = this.health.total;
        }

        this.calculateAttackDamage = function(champion_data, modifier) {
            var stat = this.createEmptyStat();
            var champ_base_attack = champion_data.stats.attackdamage;
            var champ_info_attack = champion_data.info.attack;
            var calculated_base_attack = Math.ceil(champ_base_attack * this.champion_stat_coefficients.stats_attack_damage);
            var calculated_info_attack = champ_info_attack * this.champion_stat_coefficients.info_attack_damage;
            stat.base = (calculated_base_attack + calculated_info_attack);
            stat.base += this.champion_stat_coefficients.info_magic_attack_damage * champion_data.info.magic;
            var attack_speed_offset = champion_data.stats.attackspeedoffset;
            if(attack_speed_offset != 0) {
                stat.base = stat.base * (1 + (attack_speed_offset * this.champion_stat_coefficients.attack_speed));
            }
            stat.base = Math.ceil(stat.base);
            stat.bonus = modifier != 0 ? Math.ceil((modifier / 100) * stat.base) : 0;
            stat.total = Math.ceil(stat.bonus + stat.base);
            return stat;
        }

        this.calculateAbilityDamage = function(champion_data, modifier) {
            var stat = this.createEmptyStat();
            var champ_info_magic = champion_data.info.magic;
            var champ_info_attack = champion_data.info.attack;
            stat.base =  this.champion_stat_coefficients.info_magic_ability_power * champ_info_magic;
            stat.base = Math.ceil(stat.base + (this.champion_stat_coefficients.info_attack_ability_power * champ_info_attack));
            stat.bonus = modifier != 0 ? Math.ceil((modifier / 100) * stat.base) : 0;
            stat.total = stat.base + stat.bonus;
            return stat;
        }

        this.calculateCriticalChance = function(champion_data, modifier) {
            var stat = this.createEmptyStat();
            stat.base = champion_data.stats.attackdamageperlevel;
            var attack_crit_modifier = champion_data.info.attack * this.champion_stat_coefficients.info_attack_critical_chance;
            var magic_crit_modifier = champion_data.info.attack * this.champion_stat_coefficients.info_attack_critical_chance;
            stat.base = Math.ceil(stat.base + attack_crit_modifier + magic_crit_modifier);
            stat.base = stat.base;
            stat.bonus = modifier != 0 ? (modifier / 100) * stat.base : 0;
            stat.bonus = Math.ceil(stat.bonus);
            stat.total = stat.bonus + stat.base;
            stat.total = stat.total >= 100 ? 100 : stat.total;
            return stat;
        }

        this.calculateHealth = function(champion_data, modifier) {
            var stat = this.createEmptyStat();
            stat.base = this.champion_base_health_modifier;
            var champ_state_hp_health = Math.ceil(champion_data.stats.hp * this.champion_stat_coefficients.stats_hp_health);
            var champ_defense_health = Math.ceil(champion_data.info.defense * this.champion_stat_coefficients.info_defense_health);
            stat.base += champ_state_hp_health + champ_defense_health;
            stat.base = Math.ceil(stat.base);
            stat.bonus = modifier != 0 ? Math.ceil((modifier / 100) * stat.base) : 0;
            stat.total = stat.base + stat.bonus;
            return stat;
        }

        this.calculateHealthRegen = function(champion_data, modifier) {
            var stat = this.createEmptyStat();
            stat.base = champion_data.stats.hpregen;
            stat.base = Math.ceil(stat.base * this.champion_stat_coefficients.stats_health_regen);
            stat.base += Math.ceil(champion_data.info.defense * this.champion_stat_coefficients.info_defense_health_regen);
            stat.base += Math.ceil(champion_data.info.magic * this.champion_stat_coefficients.info_magic_health_regen);
            stat.bonus = modifier != 0 ? Math.ceil((modifier / 100) * stat.base) : 0;
            stat.total = stat.base + stat.bonus;
            return stat;
        }

        this.calculateArmor = function(champion_data, modifier) {
            var stat = this.createEmptyStat();
            stat.base = champion_data.stats.armor;
            stat.base = Math.ceil(stat.base * this.champion_stat_coefficients.stats_armor);
            stat.base += Math.ceil(champion_data.info.defense * this.champion_stat_coefficients.info_defense_armor);
            stat.bonus = modifier != 0 ? Math.ceil((modifier / 100) * stat.base) : 0;
            stat.total = stat.base + stat.bonus;
            return stat;
        }

        this.calculateHealing = function(champion_data, health_regen_total) {
            var stat = this.createEmptyStat();
            stat.base = this.champion_base_healing_modifier * health_regen_total;
            if(typeof champion_data.tags != 'undefined' && champion_data.tags[0] == 'Mage') {
                if(typeof champion_data.tags[1] == 'undefined' || champion_data.tags[1] != 'Tank') {
                    stat.base = this.mage_base_healing_modifier * health_regen_total;
                }
            }
            stat.base = Math.ceil(stat.base * (1 + ((champion_data.info.magic * this.champion_stat_coefficients.info_magic_healing) / 100)));
            stat.total = stat.base;
            return stat;
        }
        
        this.increaseStatsBasedOnKills = function(kills) {
            var multiplier = LOLRPG.game.states.ChampionSelect.difficulty_increases_per_kill;
            this.overall_bonus = kills > 0 ? this.overall_bonus + (multiplier[LOLRPG.game.game_difficulty] * kills) : this.overall_bonus;
            this.calculateLolRpgStats(this, this.overall_bonus);
            return this;
        }

        this.xp_per_level = {
            '1': 0,
            '2': 1,
            '3': 3,
            '4': 6,
            '5': 10,
            '6': 15,
            '7': 20,
            '8': 25,
            '9': 30,
            '10': 35,
            '11': 40,
            '12': 45,
            '13': 50,
            '14': 55,
            '15': 60,
            '16': 65,
            '17': 70,
            '18': 75
        }
        this.attribute_points_per_level = {
            '1': 1,
            '2': 1,
            '3': 1,
            '4': 1,
            '5': 1,
            '6': 1,
            '7': 1,
            '8': 1,
            '9': 1,
            '10': 1,
            '11': 1,
            '12': 1,
            '13': 1,
            '14': 1,
            '15': 1,
            '16': 1,
            '17': 1,
            '18': 1
        }
        this.attribute_point_coefficients = {
            'attack_damage': 2,
            'ability_damage': 3,
            'critical_chance': .1,
            'health': 20,
            'health_regen': 1,
            'armor': 1
        }
        this.addXp = function(xp_to_add) {
            var self = this;
            if(xp_to_add > 0) {
                LOLRPG.game.game_log.logAction(this.getNameSpan() + ' gained ' + xp_to_add + ' experience points.');
            }
            this.current_xp = this.current_xp + xp_to_add;
            var next_xp = typeof this.xp_per_level[this.current_level + 1] != 'undefined' ? this.xp_per_level[this.current_level + 1] : false;
            if(next_xp && this.current_xp >= next_xp) {
                this.levelUp();
            }
            return this;
        }

        this.level_text_selector = '.level-text';
        this.levelUp = function() {
            LOLRPG.game.game_log.logAction(this.getNameSpan() + ' leveled up to ' + (this.current_level + 1) + '.');
            this.current_level = this.current_level + 1;
            $(this.level_text_selector).text(this.current_level);
            LOLRPG.game.game_log.logAction(this.getNameSpan() + ' gained ' + this.attribute_points_per_level[this.current_level] + ' attribute points.');
            this.unspent_attribute_points = this.unspent_attribute_points + this.attribute_points_per_level[this.current_level];
            this.entity_display.showHideAttributeButtonsAndData();
            this.addXp(0);
        }

        this.spendAttributePoint = function(stat) {
            LOLRPG.game.player_champion.unspent_attribute_points--;
            var new_stat_total;
            switch(stat) {
                case 'attack_damage':
                    var addition = this.attribute_point_coefficients['attack_damage'];
                    var addition_bonus = Math.ceil(addition * (this.overall_modifier / 100));
                    this.attack_damage.base += addition;
                    this.attack_damage.bonus += addition_bonus;
                    this.attack_damage.total += addition + addition_bonus;
                    new_stat_total = this.attack_damage.total;
                    this.entity_display.updateStat(stat, new_stat_total);
                    break;
                case 'ability_damage':
                    var addition = this.attribute_point_coefficients['ability_damage'];
                    var addition_bonus = Math.ceil(addition * (this.overall_modifier / 100));
                    this.ability_damage.base += addition;
                    this.ability_damage.bonus += addition_bonus;
                    this.ability_damage.total += addition + addition_bonus;
                    new_stat_total = this.ability_damage.total;
                    this.champion_base_healing_modifier++;
                    this.mage_base_healing_modifier++;
                    this.healing = this.calculateHealing(this, this.health_regen.total);
                    this.entity_display.updateStat(stat, new_stat_total);
                    break;
                case 'health':
                    var addition = this.attribute_point_coefficients['health'];
                    var addition_bonus = Math.ceil(addition * (this.overall_modifier / 100));
                    this.health.base += addition;
                    this.health.bonus += addition_bonus;
                    this.health.total += addition + addition_bonus;
                    new_stat_total = this.health.total;
                    this.current_health += addition + addition_bonus;
                    this.health_display.changeMaxHealth(new_stat_total);
                    break;
                case 'health_regen':
                    var addition = this.attribute_point_coefficients['health_regen'];
                    var addition_bonus = Math.ceil(addition * (this.overall_modifier / 100));
                    this.health_regen.base += addition;
                    this.health_regen.bonus += addition_bonus;
                    this.health_regen.total += addition + addition_bonus;
                    new_stat_total = this.health_regen.total;
                    this.healing = this.calculateHealing(this, this.health_regen.total);
                    this.entity_display.updateStat(stat, new_stat_total);
                    break;
                case 'critical_chance':
                    var addition = this.attribute_point_coefficients['critical_chance'];
                    var addition_bonus = Math.ceil(addition * (this.overall_modifier / 100));
                    this.critical_chance.base += addition;
                    this.critical_chance.bonus += addition_bonus;
                    this.critical_chance.total += addition + addition_bonus;
                    new_stat_total = this.critical_chance.total;
                    this.entity_display.updateStat(stat, new_stat_total);
                    break;
                case 'armor':
                    var addition = this.attribute_point_coefficients['armor'];
                    var addition_bonus = Math.ceil(addition * (this.overall_modifier / 100));
                    this.armor.base += addition;
                    this.armor.bonus += addition_bonus;
                    this.armor.total += addition + addition_bonus;
                    new_stat_total = this.armor.total;
                    this.entity_display.updateStat(stat, new_stat_total);
                    break;
            }
        }

    };

});