$(function() {
    LOLRPG.GameStates.WorldMap = function() {
        LOLRPG.GameStates.GameStateBase.apply(this);
        this.content_container_selector = '#lolrpg-world-map-state';
        this.enterState = function() {
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.enterState(this.content_container_selector);
            console.log('world map state');
        },

        this.leaveState = function() {
            var base_state = new LOLRPG.GameStates.GameStateBase();
            base_state.leaveState();
            console.log('leave world map state');
        }
    };
});