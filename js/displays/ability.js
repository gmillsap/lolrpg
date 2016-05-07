$(function() {
    LOLRPG.Displays.Ability = function() {
        LOLRPG.Displays.DisplayBase.apply(this);
        this.champion_action_container_selector = '.action-container';

        this.first_ability_selector = '.champion-ability';
        this.findFirstAbilityContainer = function() {
            return this.$container.find(this.first_ability_selector).parents(this.champion_action_container_selector).first();
        }

        this.summoner_heal_selector = '.summoner-heal';
        this.findSummonerHealContainer = function() {
            return this.$container.find(this.summoner_heal_selector).parents(this.champion_action_container_selector).first();
        }

        this.setFirstAbilityCooldown = function(cooldown_rounds) {
            return this.setActionCooldown(this.findFirstAbilityContainer(), cooldown_rounds);
        }

        this.setSummonerHealCooldown = function(cooldown_rounds) {
            return this.setActionCooldown(this.findSummonerHealContainer(), cooldown_rounds);
        }

        this.cooldown_overlay_selector = '.cooldown-overlay';
        this.cooldown_class = 'on-cool-down';
        this.cooldown_text_selector = '.cooldown-text';
        this.setActionCooldown = function($ability_container, cooldown_rounds) {
            var $cooldown_overlay = $ability_container.find(this.cooldown_overlay_selector);
            if(cooldown_rounds > 0) {
                $cooldown_overlay.removeClass('hidden');
                $ability_container.find(this.champion_action_selector).addClass(this.cooldown_class);
            } else {
                $cooldown_overlay
                $cooldown_overlay.addClass('hidden');
                $ability_container.find(this.champion_action_selector).removeClass(this.cooldown_class);
            }
            $cooldown_overlay.find(this.cooldown_text_selector).text(cooldown_rounds);
            return this;
        }

        this.champion_action_selector = '.champion-action'
        this.fadeActions = function() {
            this.$container.find(this.champion_action_container_selector).fadeTo(100, .5);
            return this;
        }

        this.unfadeActions = function() {
            this.$container.find(this.champion_action_container_selector).fadeTo(100, 1);
            return this;
        }
    }
});
