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
        this.useBasicAttack = function() {

        };

        this.useAbility = function() {

        };

        this.useHeal = function() {

        };

        this.regenHealth = function() {

        };

    };

});