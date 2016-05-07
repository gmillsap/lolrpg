$(function() {
    LOLRPG.Displays.PlayerChampionDisplay = function() {
        LOLRPG.Displays.DisplayBase.apply(this);
        this.state_container_selector = '.player-champion-container';

        this.moveToState = function(state) {
            var state_obj = LOLRPG.game.states[state];
            if(typeof state_obj == 'undefined') {
                return false;
            }
            this.$container.detach().appendTo($(state_obj.content_container_selector).find(this.state_container_selector));
            return this;
        }

        this.health_bar_container_selector = '.health-bar-container';
        this.findHealthBar = function() {
            return this.$container.find(this.health_bar_container_selector);
        }

        this.ability_display_selector = '.ability-display';
        this.findAbilityDisplay = function() {
            return this.$container.find(this.ability_display_selector);
        }

        return this;
    }
});