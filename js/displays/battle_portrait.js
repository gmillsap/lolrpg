$(function() {
    LOLRPG.Displays.BattlePortrait = function() {
        LOLRPG.Displays.DisplayBase.apply(this);
        this.skip_animation = false;

        this.champion_battle_image_selector = '.champion-battle-image';
        this.setImage = function(src) {
            this.$container.find(this.champion_battle_image_selector).attr('src', src);
            return this;
        }

        this.clearImage = function() {
            this.$container.find(this.champion_battle_image_selector).attr('src', '');
        }

        this.champion_battle_container_selector = '.champion-battle-container';
        this.header_selector = '.champion-battle-header';
        this.setName = function(name) {
            this.$container.find(this.header_selector).text(name);
            return this;
        }

        this.action_text_selector = '.action-text';
        this.damage_text_class = 'damage-text';
        this.hitChampion = function(num) {
            var self = this;
            var $portrait = this.$container.find(this.champion_battle_image_selector);
            if(!this.skip_animation) {
                $portrait.effect('shake', {
                    'distance': 100,
                    'times': 7
                }, 200);
            }
            var text = this.$container.find(this.action_text_selector);
            text.text(num).addClass(self.damage_text_class);
            text.css('opacity', 1);
            if(!this.skip_animation) {
                text.css('opacity', 1);
                text.effect('puff', {}, 500, function() {
                    text.removeClass(self.damage_text_class);
                    text.css('display', 'block');
                    text.css('opacity', 0);
                });
            }
        }

        this.crit_text_class = 'crit-text';
        this.critChampion = function(num) {
            var self = this;
            var $portrait = this.$container.find(this.champion_battle_image_selector);
            if(!this.skip_animation) {
                $portrait.effect('shake', {
                    'distance': 150,
                    'times': 10
                }, 400);
            }
            var text = this.$container.find(this.action_text_selector);
            text.text(num).addClass(self.damage_text_class)
                .addClass(self.crit_text);
            if(!this.skip_animation) {
                text.css('opacity', 1);
                text.effect('puff', {}, 500, function() {
                    text.removeClass(self.damage_text_class)
                        .removeClass(self.crit_text_class);
                    text.css('display', 'block');
                    text.css('opacity', 0);
                });
            }
        }

        this.healing_border_class = 'healing-border';
        this.healing_text_class = 'healing-text';
        this.healChampion = function(num) {
            var self = this;
            var $border_container = this.$container.find(this.champion_battle_image_selector);
            $border_container.addClass(this.healing_border_class);
            var text = this.$container.find(this.action_text_selector);
            text.text(num).addClass(self.healing_text_class);
            var self = this;
            if(!this.skip_animation) {
                text.animate({
                    'opacity': 1
                }, 500, function() {
                    $border_container.removeClass(self.healing_border_class);
                    text.animate({
                        'opacity': 0
                    }, 500, function() {
                        text.removeClass(self.healing_text_class)
                    });
                });
            }
        }
    }
});
