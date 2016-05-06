$(function() {
    LOLRPG.Entities.FighterMinion = function() {
        LOLRPG.Entities.MinionBase.apply(this);

        this.name = 'Melee Minion';
        this.base_attack = 35;
        this.base_health = 350;
        this.base_armor = 12;
    };

});