$(function() {
    LOLRPG.GameStates = {};
    
    LOLRPG.GameStates.GameStateBase = function() {
        this.enterState = function() {
            console.log('base state');
        };
        this.leaveState = function() {
            console.log('leave base state');
        };
    };

    LOLRPG.GameStates.Login = function() {
        LOLRPG.GameStates.GameStateBase.apply(this);

        this.enterState = function() {
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.enterState();
            console.log('login state');
        }

        this.leaveState = function() {
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.leaveState();
            console.log('leave login state');
        }
    };

    LOLRPG.GameStates.ChampSelect = function() {
        LOLRPG.GameStates.GameStateBase.apply(this);

        this.enterState = function() {
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.enterState();
            console.log('champ select state');
        }

        this.leaveState = function() {
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.leaveState();
            console.log('leave champ select state');
        }
    };

    LOLRPG.GameStates.WorldMap = function() {
        LOLRPG.GameStates.GameStateBase.apply(this);

        this.enterState = function() {
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.enterState();
            console.log('world map state');
        }

        this.leaveState = function() {
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.leaveState();
            console.log('leave world map state');
        }
    };

    LOLRPG.GameStates.Battle = function() {
        LOLRPG.GameStates.GameStateBase.apply(this);

        this.enterState = function() {
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.enterState();
            console.log('battle state');
        }

        this.leaveState = function() {
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.leaveState();
            console.log('leave battle state');
        }
    };

    LOLRPG.GameStates.Completion = function() {
        LOLRPG.GameStates.GameStateBase.apply(this);

        this.enterState = function() {
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.enterState();
            console.log('completion state');
        }

        this.leaveState = function() {
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.leaveState();
            console.log('leave completion state');
        }
    };

});
