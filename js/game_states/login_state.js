$(function() {
    LOLRPG.GameStates.Login = function() {
        LOLRPG.GameStates.GameStateBase.apply(this);

        this.content_container_selector = '#lolrpg-login-state';
        this.summoner_name_selector = '.summoner-name';
        this.region_select_selector = '.region-select';
        this.enterState = function() {
            var $container = $(this.content_container_selector);
            this.resetFields($container)
                .bindSignIn()
                .bindUseFreeChampions();
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.enterState(this.content_container_selector);
        }

        this.leaveState = function() {
            var base_state = new LOLRPG.GameStates.GameStateBase();
            var $container = $(this.content_container_selector);
            this.resetFields($container);
            base_state.leaveState(this.content_container_selector);
        }

        this.resetFields = function($container) {
            $container.find(this.summoner_name_selector).val('');
            $container.find(this.region_select_selector + ' option:first').prop('selected', true);
            return this;
        }

        this.sign_in_btn_selector = '.btn-sign-in';
        this.bindSignIn = function() {
            var self = this;
            $(LOLRPG.game_container_selector).off('click.sign_in', this.sign_in_btn_selector).on('click.sign_in', this.sign_in_btn_selector, function(e) {
                e.preventDefault();
                $(this).blur();
                var summoner_name = $(self.summoner_name_selector).val();
                var region = $(self.region_select_selector + ' option:selected').val();
                if(LOLRPG.empty(summoner_name)) {
                    LOLRPG.showError('Please enter your summoner name to sign in.', function() {
                        $(self.summoner_name_selector).focus();
                    });
                    return false;
                }
                if(LOLRPG.empty(region)) {
                    LOLRPG.showError('Please select a region.', function() {
                        $(self.region_select_selector).focus();
                    })
                    return false;
                }
                self.signIn(summoner_name, region);
            });
            $(LOLRPG.game_container_selector).off('keydown.sign_in', this.summoner_name_selector).on('keydown.sign_in', this.summoner_name_selector, function(e) {
                if(e.keyCode == 13) {
                    $(self.sign_in_btn_selector).click();
                }
            });
            return this;
        }

        this.signIn = function(summoner_name, region) {
            var loader = new LOLRPG.loadingModal('Retrieving Summoner Data...');
            loader.open();
            LOLRPG.Resources.findSummonerMasteryData(summoner_name, region, function(response) {
                loader.close();
                if(typeof response.error != 'undefined') {
                    if(response.error == 'invalid_summoner_name') {
                        LOLRPG.showError('Unable to find that summoner. Please verify your summoner name and region.', function() {
                            $(self.summoner_name_selector).focus();
                        });
                        return false;
                    }
                    if(response.error == 'empty_mastery_data') {
                        LOLRPG.showError('Unable to find that summoner\'s mastery data. If your summoner has not gained at least one level in champion mastery, you will need to use the free to play champions in order to play LOL RPG.', function() {
                            $(self.summoner_name_selector).focus();
                        });
                        return false;
                    }
                }
                var champ_state = LOLRPG.game.states['ChampionSelect'];
                champ_state.champion_data = response.champion_data;
                champ_state.mastery_data = response.top_ten_champion_mastery_data;
                champ_state.mastery_score = response.champion_mastery_score;
                champ_state.summoner_data = response.summoner_data;
                LOLRPG.game.queueAction('changeState', 'ChampionSelect');
            });
            return this;
        }

        this.use_free_to_play_champion_btn_selector = '.btn-use-free-to-play-champions';
        this.bindUseFreeChampions = function() {
            var self = this;
            $(LOLRPG.game_container_selector).off('click.sign_in', this.use_free_to_play_champion_btn_selector).on('click.sign_in', this.use_free_to_play_champion_btn_selector, function(e) {
                e.preventDefault();
                $(this).blur();
                var region = $(self.region_select_selector + ' option:selected').val();
                if(LOLRPG.empty(region)) {
                    LOLRPG.showError('Please select a region.', function() {
                        $(self.region_select_selector).focus();
                    })
                    return false;
                }
                self.playUsingFreeToPlayChampions(region);
            });
            return this;
        }

        this.playUsingFreeToPlayChampions = function(region) {
            var loader = new LOLRPG.loadingModal('Retrieving Champion Data...');
            loader.open();
            LOLRPG.Resources.findFreeToPlayChampionData(region, function(response) {
                loader.close();
                if(typeof response.error != 'undefined') {
                    LOLRPG.showError('There was an error finding free to play champions. Please try again shortly.', function() {
                        $(self.summoner_name_selector).focus();
                    });
                }
                var champ_state = LOLRPG.game.states['ChampionSelect'];
                champ_state.champion_data = response.champion_data;
                champ_state.mastery_data = {};
                champ_state.mastery_score = 0;
                champ_state.summoner_data = {};
                LOLRPG.game.queueAction('changeState', 'ChampionSelect');
            });
            return this;
        }
    };

});
