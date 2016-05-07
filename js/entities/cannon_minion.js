$(function() {
    LOLRPG.Entities.CannonMinion = function() {
        LOLRPG.Entities.MinionBase.apply(this);
        
        this.name = 'Cannon Minion';
        this.base_attack = 76;
        this.base_health = 560;
        this.base_armor = 20;
        this.images = ['/img/blue_cannon_minion.jpg', '/img/blue_cannon_minion.jpg'];
    };

});