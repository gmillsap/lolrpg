$(function() {
    LOLRPG.PlayerChampionDisplay = function() {
        this.player_champion_display_selector = '#player-champion-display';
        this.state_container_selector = '.player-champion-container';

        this.moveToState = function(state) {
            var state_obj = LOLRPG.game.states[state];
            if(typeof state_obj == 'undefined') {
                return false;
            }
            var $player_display = $(this.player_champion_display_selector).parent();
            if($player_display.length < 1) {
                return false;
            }
            $(state_obj.content_container_selector).find(this.state_container_selector).html($player_display.html());
            $player_display.html('');
            return this;
        }

        this.current_hp_selector = '.player-hp-current-level';
        this.total_hp_selector = '.player-hp-total';
        this.player_health_bar_selector = '.player-health-bar';
        this.yellow_health_bar_selector = '.player-yellow-health-bar';
        this.changeHealth = function(current_health, max_health) {
            var self = this;
            var health_percent = (current_health / max_health) * 100;
            var $player_hp_bar = $(this.player_health_bar_selector);
            var $player_yellow_bar = $(this.yellow_health_bar_selector);
            if(health_percent < 98) {
                $player_hp_bar.css('-moz-border-radius', '4px 0px 0px 4px')
                    .css('-webkit-border-radius', '4px 0px 0px 4px')
                    .css('border-radius', '4px 0px 0px 4px');
                $player_yellow_bar.css('-moz-border-radius', '4px 0px 0px 4px')
                    .css('-webkit-border-radius', '4px 0px 0px 4px')
                    .css('border-radius', '4px 0px 0px 4px');
            } else {
                $player_hp_bar.css('-moz-border-radius', '4px')
                    .css('-webkit-border-radius', '4px')
                    .css('border-radius', '4px');
                $player_yellow_bar.css('-moz-border-radius', '4px')
                    .css('-webkit-border-radius', '4px')
                    .css('border-radius', '4px');
            }
            $(this.current_hp_selector).text(current_health);
            $(this.total_hp_selector).text(max_health);
            var yellow_health_percent = health_percent - 2;
            $(this.player_health_bar_selector).animate({
                'width': health_percent.toFixed(0) + '%'
            }, 0);
            var yellow_bar_time = health_percent * 8;
            setTimeout(function() {
                $(self.yellow_health_bar_selector).animate({
                    'width': yellow_health_percent + '%'
                }, yellow_bar_time);
            }, 200);
            return this;
        }

        this.updateAbilityCooldown = function() {
        }

        this.updateHealCooldown = function() {
        }

        return this;
    }
});