$(function() {
    LOLRPG.Entities.CannonMinion = function() {
        LOLRPG.Entities.MinionBase.apply(this);
        
        this.name = 'Cannon Minion';
        this.base_attack = 76;
        this.base_health = 560;
        this.base_armor = 20;
    };

});