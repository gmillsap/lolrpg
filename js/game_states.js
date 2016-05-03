$(function() {
    LOLRPG.GameStates = {};

    LOLRPG.GameStates.GameStateBase = function() {
        this.active_state_container_selector = '#lolrpg-active-state-container';
        this.idle_state_container_selector = '#lolrpg-idle-state-container';

        this.enterState = function(state_content_container_selector) {
            if(typeof state_content_container_selector != 'undefined' && state_content_container_selector != '') {
                var $content = $(state_content_container_selector);
                if(typeof $content != 'undefined' && $content.length > 0) {
                    var $active_container = $(this.active_state_container_selector);
                    $content.remove();
                    $active_container.html($content);
                }
            }
        };

        this.leaveState = function(state_content_container_selector) {
            if(typeof state_content_container_selector != 'undefined' && state_content_container_selector != '') {
                var $content = $(state_content_container_selector);
                if(typeof $content != 'undefined' && $content.length > 0) {
                    var $idle_container = $(this.idle_state_container_selector);
                    $content.remove();
                    $idle_container.html($content);
                }
            }
        };
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
