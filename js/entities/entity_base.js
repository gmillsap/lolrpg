$(function() {
    LOLRPG.Entities = {};
    
    LOLRPG.Entities.EntityBase = function() {
        this.hp = 0;
        this.defense = 0;
        this.attack = 0;
        this.attack_speed = 0;
        this.ability_power = 0;
        this.critical_hit_change = 0;
        this.critical_hit_damage = 0;
        this.life_leech = 0;
        this.name = '';
        this.useBasicAttack = function() {};
        this.useAbility = function() {};
    };

});