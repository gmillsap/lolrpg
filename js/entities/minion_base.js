$(function() {
    LOLRPG.Entities.MinionBase = function() {
        LOLRPG.Entities.EntityBase.apply(this);

        this.base_attack = 0;
        this.base_health = 0;
        this.base_armor = 0;
        this.current_health = 0;

        this.generateMinion = function(modifier) {
            this.attack_damage = this.calculateAttackDamage(modifier);
            this.armor = this.calculateArmor(modifier);
            this.health = this.calculateHealth(modifier);
            this.current_health = this.health.total;

        }


        this.calculateAttackDamage = function(modifier) {
            var stat = this.createEmptyStat();
            stat.base = this.base_attack;
            stat.bonus = Math.floor(stat.base * (modifier / 100));
            stat.total = stat.base + stat.bonus;
            return stat;
        }

        this.calculateHealth = function(modifier) {
            var stat = this.createEmptyStat();
            stat.base = this.base_health;
            stat.bonus = Math.floor(stat.base * (modifier / 100));
            stat.total = stat.base + stat.bonus;
            return stat;
        }

        this.calculateArmor = function(modifier) {
            var stat = this.createEmptyStat();
            stat.base = this.base_armor;
            stat.bonus = Math.floor(stat.base * (modifier / 100));
            stat.total = stat.base + stat.bonus;
            return stat;
        }

        this.useAbility = function(target) {
            this.useBasicAttack(target);
        }

        this.regenHealth = function() {
            return;
        }
    };
});