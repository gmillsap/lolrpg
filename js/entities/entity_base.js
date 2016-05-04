$(function() {
    LOLRPG.Entities = {};
    
    LOLRPG.Entities.EntityBase = function() {
        this.attack_damage = 0;
        this.ability_damage = 0;
        this.critical_chance = 0;
        this.health = 0;
        this.health_regen = 0;
        this.armor = 0;
        this.overall_modifier = 0;
        this.image = {};

        this.createEmptyStat = function() {
            return {'base': 0, 'bonus': 0, 'total': 0};
        }

        this.useBasicAttack = function(target) {

        };

        this.useAbility = function(target) {

        };

        this.useHeal = function() {

        };

        this.regenHealth = function() {

        };
    };

    LOLRPG.Entities.EntityBase.prototype.constructor = function() {
        this.attack_damage = this.createEmptyStat();
        this.ability_damage = this.createEmptyStat();
        this.critical_chance = this.createEmptyStat();
        this.health = this.createEmptyStat();
        this.health_regen = this.createEmptyStat();
        this.armor = this.createEmptyStat();
    }

});