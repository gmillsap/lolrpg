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
            this.bindAssignAttributePoint();
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

        this.attack_damage_selector = '.player-attack-damage';
        this.ability_damage_selector = '.player-ability-damage';
        this.armor_selector = '.player-armor';
        this.critical_chance_selector = '.player-critical-chance';
        this.health_regen_selector = '.player-health-regen';
        this.updateStat = function(stat, new_val) {
            var selector;
            switch(stat) {
                case 'attack_damage':
                    selector = this.attack_damage_selector;
                    break;
                case 'ability_damage':
                    selector = this.ability_damage_selector;
                    break;
                case 'armor':
                    selector = this.armor_selector;
                    break;
                case 'critical_chance':
                    selector = this.critical_chance_selector;
                    new_val = new_val.toFixed(1);
                    break;
                case 'health_regen':
                    selector = this.health_regen_selector;
                    break;
                default:
                    return false;
            }
            this.$container.find(selector).text(new_val);

        }
        
        this.bindAssignAttributePoint = function() {
            var self = this;
            $(this.increase_attribute_selector).off('click.increase').on('click.increase', function(e) {
                e.preventDefault();
                if(LOLRPG.game.player_champion.unspent_attribute_points <= 0) {
                    return false;
                }
                var $increasor = $(this);
                var stat = $increasor.attr('data-stat-name');
                LOLRPG.game.player_champion.spendAttributePoint(stat);
                $(self.unspent_attribute_selector).text(LOLRPG.game.player_champion.unspent_attribute_points);
                self.showHideAttributeButtonsAndData();
            });
            return this;
        }

        this.unspent_attribute_selector = '.unspent-attribute-points';
        this.increase_attribute_selector = '.increase-attribute';
        this.showHideAttributeButtonsAndData = function() {
            if(LOLRPG.game.player_champion.unspent_attribute_points > 0) {
                $(this.unspent_attribute_selector).text(LOLRPG.game.player_champion.unspent_attribute_points)
                    .parent().removeClass('hidden');
                $(this.increase_attribute_selector).removeClass('hidden');
            } else {
                $(this.unspent_attribute_selector).text(0)
                    .parent().addClass('hidden');
                $(this.increase_attribute_selector).addClass('hidden');
            }

        }

    }
});