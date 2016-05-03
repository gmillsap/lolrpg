$(function() {
    LOLRPG.GameStates.ChampionSelect = function() {
        LOLRPG.GameStates.GameStateBase.apply(this);

        this.content_container_selector = '#lolrpg-champion-select-state';
        this.splash_image_url = 'http://ddragon.leagueoflegends.com/cdn/img/champion/splash/'
        this.champion_icon_url = 'http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/';
        this.champion_data = {};
        this.mastery_data = {};
        this.mastery_score = 0;
        this.summoner_data = {};
        this.current_champion_id = 0;
        this.calculated_mastery = {
            'level_bonus': 0,
            'grade_bonus': 0,
            'points_bonus': 0,
            'score_bonus': 0,
            'overall_bonus': 0
        }
        this.mastery_level_coefficients = {
            '1': 20,
            '2': 40,
            '3': 60,
            '4': 80,
            '5': 100
        }
        this.mastery_grade_coefficients = {
            'S+': 75,
            'S': 70,
            'S-': 65,
            'A+': 60,
            'A': 55,
            'A-': 50,
            'B+': 45,
            'B': 40,
            'B-': 35,
            'C+': 30,
            'C': 25,
            'C-': 20,
            'D+': 15,
            'D': 10,
            'D-': 5
        }
        this.mastery_points_coefficient = .002;
        this.mastery_score_coefficient = 1;
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
        }
        this.calculated_champion_stats = {
            'attack_damage': {
                'base': 0,
                'bonus': 0,
                'total': 0
            },
            'ability_damage': {
                'base': 0,
                'bonus': 0,
                'total': 0
            },
            'critical_chance': {
                'base': 0,
                'bonus': 0,
                'total': 0
            },
            'health': {
                'base': 0,
                'bonus': 0,
                'total': 0
            },
            'health_regen': {
                'base': 0,
                'bonus': 0,
                'total': 0
            },
            'armor': {
                'base': 0,
                'bonus': 0,
                'total': 0
            },
            'healing': {
                'total': 0
            }
        }

        this.enterState = function() {
            var $container = $(this.content_container_selector);
            this.loadChampions()
                .bindPreviewChampion()
                .bindReturnToSignIn();
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.enterState(this.content_container_selector);
        }

        this.leaveState = function() {
            var base_state = new LOLRPG.GameStates.GameStateBase();
            var $container = $(this.content_container_selector);
            base_state.leaveState(this.content_container_selector);
        }

        this.champion_id_attr = 'data-champion-id';
        this.champion_splash_attr = 'data-champion-splash';
        this.champion_select_image_prefix = '#champ-select-';
        this.loadChampions = function() {
            var self = this;
            this.hideAllChampionImages();
            var count = 1;
            $.each(this.champion_data, function(k, v){
                if(LOLRPG.empty(v.image) || LOLRPG.empty(v.image.full) || LOLRPG.empty(v.key) || LOLRPG.empty(v.id)) {
                    return;
                }
                $(self.champion_select_image_prefix + count).attr('src', self.champion_icon_url + v.image.full)
                    .attr('max-height', '100%')
                    .attr('width', 'auto')
                    .attr('data-champion-splash', self.splash_image_url + v.key + '_0.jpg')
                    .attr('data-champion-id', v.id)
                    .removeClass('hidden');
                count++;
            });
            return this;
        }

        this.hideAllChampionImages = function() {
            for(var i=1; i<=10; i++) {
                $('#champ-select-' + i).addClass('hidden');
            }
            return this;
        }

        this.champion_select_class = '.champion';
        this.champion_splash_container_selector = '#champ-splash';
        this.bindPreviewChampion = function() {
            var self = this;
            $(LOLRPG.game_container_selector).off('click.load_mastery', this.champion_select_class).on('click.load_mastery', this.champion_select_class, function() {
                $(self.champion_splash_container_selector).css('background-image', 'url("' + $(this).attr(self.champion_splash_attr) + '")');
                self.current_champion_id = $(this).attr(self.champion_id_attr);
                self.loadSummonerMasteryData()
                    .loadChampionStats();
            });
            return this;
        }

        this.mastery_level_selector = '.mastery-level';
        this.mastery_level_bonus_selector = '.mastery-level-bonus';
        this.mastery_grade_selector = '.mastery-grade';
        this.mastery_grade_bonus_selector = '.mastery-grade-bonus';
        this.mastery_points_selector = '.mastery-points';
        this.mastery_points_bonus_selector = '.mastery-points-bonus';
        this.mastery_score_selector = '.mastery-score';
        this.mastery_score_bonus_selector = '.mastery-score-bonus';
        this.overall_mastery_bonus_selector = '.overall-mastery-bonus';
        this.loadSummonerMasteryData = function() {
            if(typeof this.mastery_data[this.current_champion_id] == 'undefined' || typeof this.champion_data[this.current_champion_id] == 'undefined') {
                $(this.mastery_level_selector).text('-');
                $(this.mastery_level_bonus_selector).text('');
                $(this.mastery_grade_selector).text('-');
                $(this.mastery_grade_bonus_selector).text('');
                $(this.mastery_points_selector).text('-');
                $(this.mastery_points_bonus_selector).text('');
                $(this.mastery_score_selector).text('-');
                $(this.mastery_score_bonus_selector).text('');
                $(this.overall_mastery_bonus_selector).text('-');
            } else {
                this.loadSummonerMasteryLevelData()
                    .loadSummonerMasteryGradeData()
                    .loadSummonerMasteryPointsData()
                    .loadSummonerMasteryScoreData()
                    .loadSummonerMasteryOverallBonus();
            }
            return this;
        }

        this.loadSummonerMasteryLevelData = function() {
            var champ_mastery = this.mastery_data[this.current_champion_id];
            $(this.mastery_level_selector).text('-');
            $(this.mastery_level_bonus_selector).text('');
            if(typeof champ_mastery.championLevel != 'undefined') {
                var level_bonus = 0;
                if(typeof this.mastery_level_coefficients[champ_mastery.championLevel] != 'undefined') {
                    level_bonus = this.mastery_level_coefficients[champ_mastery.championLevel];
                }
                this.calculated_mastery.level_bonus = level_bonus;
                $(this.mastery_level_selector).text(champ_mastery.championLevel);
                if(level_bonus > 0) {
                    $(this.mastery_level_bonus_selector).text('(+' + level_bonus + '%)');
                }
            }
            return this;
        }

        this.loadSummonerMasteryGradeData = function() {
            var champ_mastery = this.mastery_data[this.current_champion_id];
            $(this.mastery_grade_selector).text('-');
            $(this.mastery_grade_bonus_selector).text('');
            if(typeof champ_mastery.highestGrade != 'undefined') {
                var grade_bonus = 0;
                if(typeof this.mastery_grade_coefficients[champ_mastery.highestGrade] != 'undefined') {
                    grade_bonus = this.mastery_grade_coefficients[champ_mastery.highestGrade];
                }
                this.calculated_mastery.grade_bonus = grade_bonus;
                $(this.mastery_grade_selector).text(champ_mastery.highestGrade);
                if(grade_bonus > 0) {
                    $(this.mastery_grade_bonus_selector).text('(+' + grade_bonus + '%)');
                }
            }
            return this;
        }

        this.loadSummonerMasteryPointsData = function() {
            var champ_mastery = this.mastery_data[this.current_champion_id];
            $(this.mastery_points_selector).text('-');
            $(this.mastery_points_bonus_selector).text('');
            if(typeof champ_mastery.championPoints != 'undefined') {
                var points_bonus = 0;
                points_bonus = Math.ceil(champ_mastery.championPoints * this.mastery_points_coefficient);
                this.calculated_mastery.points_bonus = points_bonus;
                $(this.mastery_points_selector).text(champ_mastery.championPoints);
                if(points_bonus > 0) {
                    $(this.mastery_points_bonus_selector).text('(+' + points_bonus + '%)');
                }
            }
            return this;
        }

        this.loadSummonerMasteryScoreData = function() {
            $(this.mastery_score_selector).text('-');
            $(this.mastery_score_bonus_selector).text('');
            if(typeof this.mastery_score != 'undefined') {
                this.calculated_mastery.score_bonus = this.mastery_score;
                $(this.mastery_score_selector).text(this.mastery_score);
                if(this.mastery_score > 0) {
                    $(this.mastery_score_bonus_selector).text('(+' + this.mastery_score + '%)');
                }
            }
            return this;
        }

        this.loadSummonerMasteryOverallBonus = function() {
            $(this.overall_mastery_bonus_selector).text('-');
            var overall_bonus = 0;
            overall_bonus += this.calculated_mastery.level_bonus;
            overall_bonus += this.calculated_mastery.grade_bonus;
            overall_bonus += this.calculated_mastery.points_bonus;
            overall_bonus += this.calculated_mastery.score_bonus;
            overall_bonus = overall_bonus * this.mastery_score_coefficient;
            if(overall_bonus > 0) {
                $(this.overall_mastery_bonus_selector).text(overall_bonus + '%');
                this.calculated_mastery.overall_bonus = overall_bonus;
            }
            return this;
        }

        this.base_attack_damage_selector = '.base-attack-damage';
        this.bonus_attack_damage_selector = '.bonus-attack-damage';
        this.total_attack_damage_selector = '.total-attack-damage';
        this.base_ability_damage_selector = '.base-ability-damage';
        this.bonus_ability_damage_selector = '.bonus-ability-damage';
        this.total_ability_damage_selector = '.total-ability-damage';
        this.base_critical_chance_selector = '.base-critical-chance';
        this.bonus_critical_chance_selector = '.bonus-critical-chance';
        this.total_critical_chance_selector = '.total-critical-chance';
        this.base_health_selector = '.base-health';
        this.bonus_health_selector = '.bonus-health';
        this.total_health_selector = '.total-health';
        this.base_health_regen_selector = '.base-health-regen';
        this.bonus_health_regen_selector = '.bonus-health-regen';
        this.total_health_regen_selector = '.total-health-regen';
        this.base_armor_selector = '.base-armor';
        this.bonus_armor_selector = '.bonus-armor';
        this.total_armor_selector = '.total-armor';

        this.loadChampionStats = function() {
            this.loadChampionAttackDamage()
                .loadChampionAbilityDamage()
                .loadChampionCriticalChance()
                .loadChampionHealth()
                .loadChampionHealthRegen()
                .loadChampionArmor()
                .loadChampionHealing();
        }

        this.loadChampionAttackDamage = function() {
            $(this.base_attack_damage_selector).text('-');
            $(this.bonus_attack_damage_selector).text('-');
            $(this.total_attack_damage_selector).text('-');
            var attack_speed_offset = this.champion_data[this.current_champion_id].stats.attackspeedoffset;
            var champ_base_attack = this.champion_data[this.current_champion_id].stats.attackdamage;
            var champ_info_attack = this.champion_data[this.current_champion_id].info.attack;
            var calculated_base_attack = Math.ceil(champ_base_attack * this.champion_stat_coefficients.stats_attack_damage);
            var calculated_info_attack = champ_info_attack * this.champion_stat_coefficients.info_attack_damage;
            var base_attack_damage = (calculated_base_attack + calculated_info_attack)
            if(attack_speed_offset != 0) {
                base_attack_damage = Math.ceil(base_attack_damage * (1 + (attack_speed_offset * this.champion_stat_coefficients.attack_speed)));
            }
            this.calculated_champion_stats.attack_damage.base = base_attack_damage > 0 ? base_attack_damage : 0;
            var bonus_attack_damage = this.calculated_mastery.overall_bonus > 0 ? Math.ceil((this.calculated_mastery.overall_bonus / 100) * base_attack_damage) : 0;
            this.calculated_champion_stats.attack_damage.bonus = bonus_attack_damage > 0 ? bonus_attack_damage : 0;
            var total_attack_damage = Math.ceil(this.calculated_champion_stats.attack_damage.bonus + base_attack_damage);
            this.calculated_champion_stats.attack_damage.total = total_attack_damage > 0 ? total_attack_damage : 0;
            if(base_attack_damage > 0) {
                $(this.base_attack_damage_selector).text(base_attack_damage);
            }
            if(this.calculated_champion_stats.attack_damage.bonus > 0) {
                $(this.bonus_attack_damage_selector).text(bonus_attack_damage);
            }
            if(this.calculated_champion_stats.attack_damage.total > 0) {
                $(this.total_attack_damage_selector).text(total_attack_damage);
            }
            return this;
        }

        this.loadChampionAbilityDamage = function() {
            $(this.base_ability_damage_selector).text('-');
            $(this.bonus_ability_damage_selector).text('-');
            $(this.total_ability_damage_selector).text('-');
            var champ_info_magic = this.champion_data[this.current_champion_id].info.magic;
            var champ_info_attack = this.champion_data[this.current_champion_id].info.attack;
            var calculated_champ_ability_damage = this.champion_stat_coefficients.info_magic_ability_power * champ_info_magic;
            calculated_champ_ability_damage = Math.ceil(calculated_champ_ability_damage + (this.champion_stat_coefficients.info_attack_ability_power * champ_info_attack));
            this.calculated_champion_stats.ability_damage.base = calculated_champ_ability_damage;
            if(calculated_champ_ability_damage > 0) {
                $(this.base_ability_damage_selector).text(calculated_champ_ability_damage);
            }
            var bonus_champ_ability_damage = this.calculated_mastery.overall_bonus > 0 ? Math.ceil((this.calculated_mastery.overall_bonus / 100) * calculated_champ_ability_damage) : 0
            this.calculated_champion_stats.ability_damage.bonus = bonus_champ_ability_damage;
            if(bonus_champ_ability_damage > 0) {
                $(this.bonus_ability_damage_selector).text(bonus_champ_ability_damage);
            }
            var total_champ_ability_damage = calculated_champ_ability_damage + bonus_champ_ability_damage;
            this.calculated_champion_stats.ability_damage.total = total_champ_ability_damage;
            if(total_champ_ability_damage > 0) {
                $(this.total_ability_damage_selector).text(total_champ_ability_damage);
            }
            return this;
        }

        this.loadChampionCriticalChance = function() {
            $(this.base_critical_chance_selector).text('-');
            $(this.bonus_critical_chance_selector).text('-');
            $(this.total_critical_chance_selector).text('-');
            var champ_base_crit = this.champion_data[this.current_champion_id].stats.attackdamageperlevel;
            var attack_crit_modifier = this.champion_data[this.current_champion_id].info.attack * this.champion_stat_coefficients.info_attack_critical_chance;
            var magic_crit_modifier = this.champion_data[this.current_champion_id].info.attack * this.champion_stat_coefficients.info_attack_critical_chance;
            var champ_base_crit = champ_base_crit + attack_crit_modifier + magic_crit_modifier;
            champ_base_crit = champ_base_crit.toFixed(1);
            this.calculated_champion_stats.critical_chance.base = parseFloat(champ_base_crit);
            if(champ_base_crit > 0) {
                $(this.base_critical_chance_selector).text(parseFloat(champ_base_crit).toFixed(0) + '%');
            }
            var champ_bonus_crit = this.calculated_mastery.overall_bonus > 0 ? (this.calculated_mastery.overall_bonus / 100) * champ_base_crit : 0;
            champ_bonus_crit = champ_bonus_crit.toFixed(1);
            this.calculated_champion_stats.critical_chance.bonus = parseFloat(champ_bonus_crit);
            if(champ_bonus_crit > 0) {
                $(this.bonus_critical_chance_selector).text(parseFloat(champ_bonus_crit).toFixed(0) + '%');
            }
            var champ_total_crit = (parseFloat(champ_bonus_crit) + parseFloat(champ_base_crit)).toFixed(1);
            this.calculated_champion_stats.critical_chance.total = parseFloat(champ_total_crit);
            if(champ_total_crit > 0) {
                $(this.total_critical_chance_selector).text(parseFloat(champ_total_crit).toFixed(0) + '%');
            }
            return this;
        }

        this.loadChampionHealth = function() {
            $(this.base_health_selector).text('-');
            $(this.bonus_health_selector).text('-');
            $(this.total_health_selector).text('-');
            var champ_base_health = this.champion_base_health_modifier;
            var champ_state_hp_health = Math.ceil(this.champion_data[this.current_champion_id].stats.hp * this.champion_stat_coefficients.stats_hp_health);
            var champ_defense_health = Math.ceil(this.champion_data[this.current_champion_id].info.defense * this.champion_stat_coefficients.info_defense_health);
            champ_base_health += champ_state_hp_health + champ_defense_health;
            champ_base_health = Math.ceil(champ_base_health);
            this.calculated_champion_stats.health.base = champ_base_health;
            if(champ_base_health > 0) {
                $(this.base_health_selector).text(champ_base_health);
            }
            var champ_bonus_health = this.calculated_mastery.overall_bonus > 0 ? Math.ceil((this.calculated_mastery.overall_bonus / 100) * champ_base_health) : 0;
            this.calculated_champion_stats.health.bonus = champ_bonus_health;
            if(champ_bonus_health > 0) {
                $(this.bonus_health_selector).text(champ_bonus_health);
            }
            var champ_total_health = champ_base_health + champ_bonus_health;
            this.calculated_champion_stats.health.total = champ_total_health;
            if(champ_total_health > 0) {
                $(this.total_health_selector).text(champ_total_health);
            }
            return this;
        }

        this.loadChampionHealthRegen = function() {
            $(this.base_health_regen_selector).text('-');
            $(this.bonus_health_regen_selector).text('-');
            $(this.total_health_regen_selector).text('-');
            var champ_base_health_regen = this.champion_data[this.current_champion_id].stats.hpregen;
            champ_base_health_regen = Math.ceil(champ_base_health_regen * this.champion_stat_coefficients.stats_health_regen);
            champ_base_health_regen += Math.ceil(this.champion_data[this.current_champion_id].info.defense * this.champion_stat_coefficients.info_defense_health_regen);
            this.calculated_champion_stats.health_regen.base = champ_base_health_regen;
            if(champ_base_health_regen > 0) {
                $(this.base_health_regen_selector).text(champ_base_health_regen);
            }
            var champ_bonus_health_regen = this.calculated_mastery.overall_bonus > 0 ? Math.ceil((this.calculated_mastery.overall_bonus / 100) * champ_base_health_regen) : 0;
            this.calculated_champion_stats.health_regen.bonus = champ_bonus_health_regen;
            if(champ_bonus_health_regen > 0) {
                $(this.bonus_health_regen_selector).text(champ_bonus_health_regen);
            }
            var champ_total_health_regen = champ_base_health_regen + champ_bonus_health_regen;
            this.calculated_champion_stats.health_regen.total = champ_total_health_regen;
            if(champ_total_health_regen > 0) {
                $(this.total_health_regen_selector).text(champ_total_health_regen);
            }
            return this;
        }

        this.loadChampionArmor = function() {
            $(this.base_armor_selector).text('-');
            $(this.bonus_armor_selector).text('-');
            $(this.total_armor_selector).text('-');
            var champ_base_armor = this.champion_data[this.current_champion_id].stats.armor;
            champ_base_armor = Math.ceil(champ_base_armor * this.champion_stat_coefficients.stats_armor);
            champ_base_armor += Math.ceil(this.champion_data[this.current_champion_id].info.defense * this.champion_stat_coefficients.info_defense_armor);
            this.calculated_champion_stats.armor.base = champ_base_armor;
            if(champ_base_armor > 0) {
                $(this.base_armor_selector).text(champ_base_armor);
            }
            var champ_bonus_armor = this.calculated_mastery.overall_bonus > 0 ? Math.ceil((this.calculated_mastery.overall_bonus / 100) * champ_base_armor) : 0;
            this.calculated_champion_stats.armor.bonus = champ_bonus_armor;
            if(champ_bonus_armor > 0) {
                $(this.bonus_armor_selector).text(champ_bonus_armor);
            }
            var champ_total_armor = champ_base_armor + champ_bonus_armor;
            this.calculated_champion_stats.armor.total = champ_total_armor;
            if(champ_total_armor > 0) {
                $(this.total_armor_selector).text(champ_total_armor);
            }
            return this;
        }

        this.loadChampionHealing = function() {
            var base_healing_modifier = this.champion_base_healing_modifier;
            var base_healing = base_healing_modifier * this.calculated_champion_stats.health_regen.total;
            var modified_healing = Math.ceil(base_healing * (this.champion_data[this.current_champion_id].info.magic * this.champion_stat_coefficients.info_magic_healing));
            this.calculated_champion_stats.healing.total = modified_healing;
            return this;
        }

        this.return_to_sign_in_btn_class = '.btn-return-to-sign-in';
        this.bindReturnToSignIn = function() {
            $(LOLRPG.game_container_selector).off('click.return', this.return_to_sign_in_btn_class).on('click.return', this.return_to_sign_in_btn_class, function(e) {
                e.preventDefault();
                $(this).blur();
                console.log('here');
                LOLRPG.game.queueAction('changeState', 'Login');
            });
            return this;
        }

        this.bindLockInChampion = function() {
            return this;
        }

    };

});
