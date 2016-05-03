$(function() {
    LOLRPG.GameStates.ChampionSelect = function() {
        LOLRPG.GameStates.GameStateBase.apply(this);

        this.content_container_selector = '#lolrpg-champion-select-state';
        this.splash_image_url = 'http://ddragon.leagueoflegends.com/cdn/img/champion/splash/';
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
        };
        this.mastery_level_coefficients = {
            '1': 20,
            '2': 40,
            '3': 60,
            '4': 80,
            '5': 100
        };
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
        };
        this.mastery_points_coefficient = .002;
        this.mastery_score_coefficient = 1;
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
        };
        this.suggested_difficulties = {
            'bronze': 0,
            'silver': 50,
            'gold': 125,
            'platinum': 200,
            'diamond': 350,
            'master': 500,
            'challenger': 700
        };

        this.using_free_to_play = false;
        this.switch_to_f2p_champions_btn_class = '.btn-switch-to-free-to-play-champions';
        this.enterState = function() {
            var $container = $(this.content_container_selector);
            this.loadChampions()
                .bindPreviewChampion()
                .bindReturnToSignIn()
                .bindUseFreeToPlayChampions()
                .bindLockInChampion()
                .bindBeginMatch();
            if(this.using_free_to_play) {
                $container.find(this.switch_to_f2p_champions_btn_class).addClass('hidden');
            } else {
                $container.find(this.switch_to_f2p_champions_btn_class).removeClass('hidden');
            }
            $container.find(this.lock_in_champion_btn_class).addClass('hide-me');
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.enterState(this.content_container_selector);
        };

        this.lock_in_champion_btn_class = '.btn-lock-in-champion';
        this.champion_splash_container_selector = '#champ-splash';
        this.default_splash_img = 'url("/img/champ_select_splash_1.jpg")';
        this.leaveState = function() {
            var base_state = new LOLRPG.GameStates.GameStateBase();
            var $container = $(this.content_container_selector);
            $(this.champion_splash_container_selector).css('background-image', this.default_splash_img);
            $container.find(this.lock_in_champion_btn_class).addClass('hidden');
            $container.find(this.switch_to_f2p_champions_btn_class).addClass('hidden');
            base_state.leaveState(this.content_container_selector);
        };

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
        };

        this.hideAllChampionImages = function() {
            for(var i=1; i<=10; i++) {
                $('#champ-select-' + i).addClass('hidden');
            }
            return this;
        };

        this.champion_select_selector = '.champion';
        this.champion_selected_class = 'selected-champion';
        this.bindPreviewChampion = function() {
            var self = this;
            $(LOLRPG.game_container_selector).off('click.load_mastery', this.champion_select_selector).on('click.load_mastery', this.champion_select_selector, function() {
                $(self.champion_splash_container_selector).css('background-image', 'url("' + $(this).attr(self.champion_splash_attr) + '")');
                $('.' + self.champion_selected_class).removeClass(self.champion_selected_class);
                $(this).addClass(self.champion_selected_class);
                self.current_champion_id = $(this).attr(self.champion_id_attr);
                self.loadSummonerMasteryData()
                    .loadChampionStats();
                $(self.content_container_selector + ' ' + self.lock_in_champion_btn_class).removeClass('hidden');
            });
            return this;
        };

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
            this.resetSummonerMasteryData();
            if(typeof this.mastery_data[this.current_champion_id] != 'undefined' && typeof this.champion_data[this.current_champion_id] != 'undefined') {
                this.loadSummonerMasteryLevelData()
                    .loadSummonerMasteryGradeData()
                    .loadSummonerMasteryPointsData();
            }
            this.loadSummonerMasteryScoreData();
            this.loadSummonerMasteryOverallBonus();
            return this;
        };

        this.resetSummonerMasteryData = function() {
            this.calculated_mastery = {
                'level_bonus': 0,
                'grade_bonus': 0,
                'points_bonus': 0,
                'score_bonus': 0,
                'overall_bonus': 0
            };
            $(this.mastery_level_selector).text('-');
            $(this.mastery_level_bonus_selector).text('');
            $(this.mastery_grade_selector).text('-');
            $(this.mastery_grade_bonus_selector).text('');
            $(this.mastery_points_selector).text('-');
            $(this.mastery_points_bonus_selector).text('');
            $(this.mastery_score_selector).text('-');
            $(this.mastery_score_bonus_selector).text('');
            $(this.overall_mastery_bonus_selector).text('-');
            return this;
        };

        this.loadSummonerMasteryLevelData = function() {
            var champ_mastery = this.mastery_data[this.current_champion_id];
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
        };

        this.loadSummonerMasteryGradeData = function() {
            var champ_mastery = this.mastery_data[this.current_champion_id];
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
        };

        this.loadSummonerMasteryPointsData = function() {
            var champ_mastery = this.mastery_data[this.current_champion_id];
            if(typeof champ_mastery.championPoints != 'undefined') {
                var points_bonus = Math.ceil(champ_mastery.championPoints * this.mastery_points_coefficient);
                this.calculated_mastery.points_bonus = points_bonus;
                $(this.mastery_points_selector).text(champ_mastery.championPoints);
                if(points_bonus > 0) {
                    $(this.mastery_points_bonus_selector).text('(+' + points_bonus + '%)');
                }
            }
            return this;
        };

        this.loadSummonerMasteryScoreData = function() {
            if(typeof this.mastery_score != 'undefined') {
                this.calculated_mastery.score_bonus = this.mastery_score;
                if(this.mastery_score > 0) {
                    $(this.mastery_score_selector).text(this.mastery_score);
                    $(this.mastery_score_bonus_selector).text('(+' + this.mastery_score + '%)');
                }
            }
            return this;
        };

        this.loadSummonerMasteryOverallBonus = function() {
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
        };

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
            this.resetChampionStats()
                .loadChampionAttackDamage()
                .loadChampionAbilityDamage()
                .loadChampionCriticalChance()
                .loadChampionHealth()
                .loadChampionHealthRegen()
                .loadChampionArmor()
                .loadChampionHealing();
        };

        this.resetChampionStats = function() {
            $(this.base_attack_damage_selector).text('-');
            $(this.bonus_attack_damage_selector).text('-');
            $(this.total_attack_damage_selector).text('-');
            $(this.base_ability_damage_selector).text('-');
            $(this.bonus_ability_damage_selector).text('-');
            $(this.total_ability_damage_selector).text('-');
            $(this.base_critical_chance_selector).text('-');
            $(this.bonus_critical_chance_selector).text('-');
            $(this.total_critical_chance_selector).text('-');
            $(this.base_health_selector).text('-');
            $(this.bonus_health_selector).text('-');
            $(this.total_health_selector).text('-');
            $(this.base_health_regen_selector).text('-');
            $(this.bonus_health_regen_selector).text('-');
            $(this.total_health_regen_selector).text('-');
            $(this.base_armor_selector).text('-');
            $(this.bonus_armor_selector).text('-');
            $(this.total_armor_selector).text('-');
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
            };
            return this;
        };

        this.loadChampionAttackDamage = function() {
            var champion_model = new LOLRPG.Entities.Champion();
            var attack_damage = champion_model.calculateAttackDamage(this.champion_data[this.current_champion_id], this.calculated_mastery.overall_bonus);
            this.calculated_champion_stats.attack_damage = attack_damage;
            if(attack_damage.base > 0) {
                $(this.base_attack_damage_selector).text(attack_damage.base);
            }
            if(attack_damage.bonus > 0) {
                $(this.bonus_attack_damage_selector).text(attack_damage.bonus);
            }
            if(attack_damage.total > 0) {
                $(this.total_attack_damage_selector).text(attack_damage.total);
            }
            return this;
        };

        this.loadChampionAbilityDamage = function() {
            var champion_model = new LOLRPG.Entities.Champion();
            var ability_damage = champion_model.calculateAbilityDamage(this.champion_data[this.current_champion_id], this.calculated_mastery.overall_bonus);
            this.calculated_champion_stats.ability_damage = ability_damage;
            if(ability_damage.base > 0) {
                $(this.base_ability_damage_selector).text(ability_damage.base);
            }
            if(ability_damage.bonus > 0) {
                $(this.bonus_ability_damage_selector).text(ability_damage.bonus);
            }
            if(ability_damage.total > 0) {
                $(this.total_ability_damage_selector).text(ability_damage.total);
            }
            return this;
        };

        this.loadChampionCriticalChance = function() {
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
        };

        this.loadChampionHealth = function() {
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
        };

        this.loadChampionHealthRegen = function() {
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
        };

        this.loadChampionArmor = function() {
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
        };

        this.loadChampionHealing = function() {
            var base_healing_modifier = this.champion_base_healing_modifier;
            var base_healing = base_healing_modifier * this.calculated_champion_stats.health_regen.total;
            var modified_healing = Math.ceil(base_healing * (this.champion_data[this.current_champion_id].info.magic * this.champion_stat_coefficients.info_magic_healing));
            this.calculated_champion_stats.healing.total = modified_healing;
            return this;
        };

        this.return_to_sign_in_btn_class = '.btn-return-to-sign-in';
        this.bindReturnToSignIn = function() {
            $(LOLRPG.game_container_selector).off('click.return', this.return_to_sign_in_btn_class).on('click.return', this.return_to_sign_in_btn_class, function(e) {
                e.preventDefault();
                $(this).blur();
                LOLRPG.game.queueAction('changeState', 'Login');
            });
            return this;
        };

        this.bindUseFreeToPlayChampions = function() {
            var self = this;
            $(LOLRPG.game_container_selector).off('click.switch', this.switch_to_f2p_champions_btn_class).on('click.switch', this.switch_to_f2p_champions_btn_class, function(e) {
                e.preventDefault();
                $(this).blur();
                $('.' + self.champion_selected_class).removeClass(self.champion_selected_class);
                self.resetSummonerMasteryData()
                    .resetChampionStats();
                LOLRPG.game.states.Login.playUsingFreeToPlayChampions();
            });
            return this;
        };

        this.difficulty_selection_modal_selector = '#difficulty-selection-modal';
        this.bindLockInChampion = function() {
            var self = this;
            $(LOLRPG.game_container_selector).off('click.lock', this.lock_in_champion_btn_class).on('click.switch', this.lock_in_champion_btn_class, function(e) {
                e.preventDefault();
                $(this).blur();
                var $modal = $(self.difficulty_selection_modal_selector);
                var suggested_difficulty = 'bronze';
                $.each(self.suggested_difficulties, function(k,v) {
                    if(v > self.calculated_mastery.overall_bonus) {
                        return false;
                    }
                    suggested_difficulty = k;
                });
                $modal.find('input[data-difficulty="' + suggested_difficulty + '"]:not(:checked)').click();
                $modal.modal('show');
            });
            return this;
        };

        this.begin_match_btn_class = '.btn-begin-match';
        this.difficulty_row_class = '.difficulty';
        this.bindBeginMatch = function() {
            var self = this;
            // LOLRPG.game.queueAction('changeState', 'WorldMap');
            $(this.begin_match_btn_class).off('click.begin').on('click.begin', function(e) {
                e.preventDefault();
                $(this).blur();
                var $selected_difficutly = $(self.difficulty_row_class + ' input[type="checkbox"]:checked');
                if($selected_difficutly.length != 1) {
                    var $modal = $(self.difficulty_selection_modal_selector);
                    $modal.modal('hide');
                    LOLRPG.showError('Please select a difficulty.', function() {
                        $modal.modal('show');
                    });
                    return;
                }
                LOLRPG.game.game_difficulty = $selected_difficutly.attr('data-difficulty');
                LOLRPG.game.summoner_data = self.summoner_data;
                LOLRPG.game.raw_champion_mastery = self.champion_mastery[self.current_champion_id];
                LOLRPG.game.calculated_champion_mastery = self.calculated_mastery;
                self.loadSelectedChampionModel();
            });
            return this;
        };

        this.loadSelectedChampionModel = function() {
            var self = this;
            var champion = new LOLRPG.Entities.Champion();
            champion.overall_modifier = this.calculated_mastery.overall_bonus;
            champion.loadLolRpgStats(this.calculated_champion_stats)
                .loadLolChampData(this.champion_data[this.current_champion_id]);

            return this;
        }
    };

});
