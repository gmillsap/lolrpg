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

        this.enterState = function() {
            var $container = $(this.content_container_selector);
            this.loadChampions()
                .bindPreviewChampion();
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.enterState(this.content_container_selector);
        }

        this.leaveState = function() {
            var base_state = new LOLRPG.GameStates.GameStateBase();
            var $container = $(this.content_container_selector);
            base_state.leaveState();
        }

        this.champion_select_image_prefix = '#champ-select-';
        this.loadChampions = function() {
            var self = this;
            this.hideAllChampionImages();
            var count = 1;
            $.each(this.champion_data, function(k, v){
                console.log(v);
                if(LOLRPG.empty(v.image) || LOLRPG.empty(v.image.full) || LOLRPG.empty(v.key)) {
                    return;
                }
                $(self.champion_select_image_prefix + count).attr('src', self.champion_icon_url + v.image.full)
                    .attr('max-height', '100%')
                    .attr('width', 'auto')
                    .attr('data-champion-splash', self.splash_image_url + v.key + '_0.jpg')
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
                $(self.champion_splash_container_selector).attr('src', $(this).attr('data-champion-splash'));
            });
            return this;
        }

        this.bindLockInChampion = function() {
        }

    };

});
