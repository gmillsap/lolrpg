$(function() {
    LOLRPG.Entities.CannonMinion = function() {
        LOLRPG.Entities.MinionBase.apply(this);
        
        this.name = 'Cannon Minion';
        this.base_attack = 90;
        this.base_health = 600;
        this.base_armor = 20;
    };

});