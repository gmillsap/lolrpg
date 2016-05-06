$(function() {
    LOLRPG.Entities.MageMinion = function() {
        LOLRPG.Entities.MinionBase.apply(this);

        this.name = 'Caster Minion';
        this.base_attack = 60;
        this.base_health = 250;
        this.base_armor = 8;

    };
});