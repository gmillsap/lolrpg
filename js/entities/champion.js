$(function() {
    LOLRPG.Entities.Champion = function() {
        LOLRPG.Entities.EntityBase.apply(this);

        this.info = {};
        this.stats = {};
        this.spells = {};
        this.tags = {};

        this.champion_base_health_modifier = 500;
        this.champion_base_healing_modifier = 35;
        this.champion_stat_coefficients = {
            'info_attack_damage': 2.4,
            'stats_attack_damage': .7,
            'attack_speed': -4,

            'info_magic_ability_power': 15,
            'info_attack_ability_power': 8.5,

            'stats_attack_damager_per_level_critical_chance': 1,
            'info_attack_critical_chance': .2,
            'info_magic_critical_chance': .2,

            'info_defense_health': 45,
            'stats_hp_health': 1,

            'stats_health_regen': 1.6,
            'info_defense_health_regen': .65,

            'info_defense_armor': 1.5,
            'stats_armor': .5,

            'info_magic_healing': .15
        };


        this.loadLolRpgStats = function(stats) {
            this.attack_damage = !LOLRPG.empty(stats.attack_damage) ? stats.attack_damage : 0;
            this.ability_damage = !LOLRPG.empty(stats.ability_damage) ? stats.ability_damage : 0;
            this.critical_chance = !LOLRPG.empty(stats.critical_chance) ? stats.critical_chance : 0;
            this.health = !LOLRPG.empty(stats.health) ? stats.health : 0;
            this.health_regen = !LOLRPG.empty(stats.health_regen) ? stats.health_regen : 0;
            this.armor = !LOLRPG.empty(stats.armor) ? stats.armor : 0;
            return this;
        }
        
        this.loadLolChampData = function(champion_data) {
            this.info = !LOLRPG.empty(champion_data.info) ? champion_data.info : {};
            this.stats = !LOLRPG.empty(champion_data.stats) ? champion_data.stats : {};
            this.spells = !LOLRPG.empty(champion_data.spells) ? champion_data.spells : {};
            this.tags = !LOLRPG.empty(champion_data.tags) ? champion_data.tags : {};
            this.image = !LOLRPG.empty(champion_data.image) ? champion_data.image : {};
            return this;
        }

        this.calculateLolRpgStats = function(champion_data, modifier) {
            this.attack_damage = this.calculateAttackDamage(champion_data, modifier);
            this.ability_damage = this.calculateAbilityDamage(champion_data, modifier);
            this.critical_chance = this.calculateCriticalChance(champion_data, modifier);
            this.health = this.calculateHealth(champion_data, modifier);
            this.health_regen = this.calculateHealthRegen(champion_data, modifier);
            this.armor = this.calculateArmor(champion_data, modifier);
        }

        this.createEmptyStat = function() {
            return {'base': 0, 'bonus': 0, 'total': 0};
        }

        this.calculateAttackDamage = function(champion_data, modifier) {
            var stat = this.createEmptyStat();
            var champ_base_attack = champion_data.stats.attackdamage;
            var champ_info_attack = champion_data.info.attack;
            var calculated_base_attack = Math.ceil(champ_base_attack * this.champion_stat_coefficients.stats_attack_damage);
            var calculated_info_attack = champ_info_attack * this.champion_stat_coefficients.info_attack_damage;
            stat.base = (calculated_base_attack + calculated_info_attack);
            var attack_speed_offset = champion_data.stats.attackspeedoffset;
            if(attack_speed_offset != 0) {
                stat.base = stat.base * (1 + (attack_speed_offset * this.champion_stat_coefficients.attack_speed));
            }
            stat.base = Math.ceil(stat.base);
            stat.bonus = modifier > 0 ? Math.ceil((modifier / 100) * stat.base) : 0;
            stat.total = Math.ceil(stat.bonus + stat.base);
            return stat;
        }

        this.calculateAbilityDamage = function(champion_data, modifier) {
            var stat = this.createEmptyStat();
            var champ_info_magic = champion_data.info.magic;
            var champ_info_attack = champion_data.info.attack;
            stat.base =  this.champion_stat_coefficients.info_magic_ability_power * champ_info_magic;
            stat.base = Math.ceil(stat.base + (this.champion_stat_coefficients.info_attack_ability_power * champ_info_attack));
            stat.bonus = modifier > 0 ? Math.ceil((modifier / 100) * stat.base) : 0;
            stat.total = stat.base + stat.bonus;
            return stat;
        }

        this.calculateCriticalChance = function(champion_data, modifier) {
            var stat = this.createEmptyStat();
            return stat;
        }

        this.calculateHealth = function(champion_data, modifier) {
            var stat = this.createEmptyStat();
            return stat;
        }

        this.calculateHealthRegen = function(champion_data, modifier) {
            var stat = this.createEmptyStat();
            return stat;
        }

        this.calculateArmor = function(champion_data, modifier) {
            var stat = this.createEmptyStat();
            return stat;
        }

    };

});