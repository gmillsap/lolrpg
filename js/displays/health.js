$(function() {
    LOLRPG.Displays.Health = function() {
        LOLRPG.Displays.DisplayBase.apply(this);

        this.current_health = 0;
        this.max_health = 0;

        this.current_hp_selector = '.hp-current-level';
        this.total_hp_selector = '.hp-total';
        this.health_bar_selector = '.health-bar';
        this.yellow_health_bar_selector = '.yellow-health-bar';
        this.delta_speed = 200;

        this.updateDisplay = function(delta_health) {
            if(delta_health == 0) {
                return this;
            }
            var self = this;
            var new_current = this.current_health + delta_health;
            if(new_current < 0) {
                new_current = 0;
            }
            if(new_current > this.max_health) {
                new_current = this.max_health;
            }
            var previous_percent = this.current_health / this.max_health * 100;
            var health_percent = new_current / this.max_health * 100;
            var $hp_bar = this.$container.find(this.health_bar_selector);
            var $yellow_bar = this.$container.find(this.yellow_health_bar_selector);
            if(health_percent < 98) {
                $hp_bar.css('-moz-border-radius', '4px 0px 0px 4px')
                    .css('-webkit-border-radius', '4px 0px 0px 4px')
                    .css('border-radius', '4px 0px 0px 4px');
                $yellow_bar.css('-moz-border-radius', '4px 0px 0px 4px')
                    .css('-webkit-border-radius', '4px 0px 0px 4px')
                    .css('border-radius', '4px 0px 0px 4px');
            } else {
                $hp_bar.css('-moz-border-radius', '4px')
                    .css('-webkit-border-radius', '4px')
                    .css('border-radius', '4px');
                $yellow_bar.css('-moz-border-radius', '4px')
                    .css('-webkit-border-radius', '4px')
                    .css('border-radius', '4px');
            }
            var animate_green_speed = this.delta_speed;
            if(delta_health < 0) {
                animate_green_speed = 0;
            }
            this.$container.find(this.health_bar_selector).animate({
                'width': health_percent.toFixed(0) + '%'
            }, animate_green_speed);
            var yellow_bar_time = Math.abs(previous_percent - health_percent) * 10;
            setTimeout(function() {
                self.$container.find(self.yellow_health_bar_selector).animate({
                    'width': health_percent.toFixed(0) + '%'
                }, yellow_bar_time);
            }, this.delta_speed);
            // LOLRPG.game.queueAction('delay', yellow_bar_time + this.delta_speed);
            var number_increment = delta_health / this.delta_speed * 10;
            var incremented_health = this.current_health;
            var number_change_interval = setInterval(function() {
                incremented_health += number_increment;
                if(number_increment > 0 && incremented_health > new_current) {
                    incremented_health = new_current;
                } else if(number_increment < 0 && incremented_health < new_current) {
                    incremented_health = new_current;
                }
                self.$container.find(self.current_hp_selector).text(incremented_health.toFixed(0));
                if(incremented_health == new_current) {
                    clearInterval(number_change_interval);
                }
            }, 10);
            this.current_health = new_current;
            return this;
        }

        this.setToFull = function() {
            this.$container.find(this.current_hp_selector).text(this.max_health);
            this.$container.find(this.total_hp_selector).text(this.max_health);
            this.$container.find(this.health_bar_selector).css('width', '100%');
            this.$container.find(this.yellow_health_bar_selector).css('width', '100%');
            return this;
        }

    }
});
