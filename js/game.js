$(function() {
    var Game = function() {
        this.interval_id = null;
        this.is_running = false;
        this.current_state = null;
        this.states = {};
        this.fps = 60;
        this.action_queue = [];

        this.start = function() {
            var self = this;
            this.states = {
                'Login': new LOLRPG.GameStates.Login(),
                'ChampSelect': new LOLRPG.GameStates.ChampSelect(),
                'WorldMap': new LOLRPG.GameStates.WorldMap(),
                'Battle': new LOLRPG.GameStates.Battle(),
                'Completion': new LOLRPG.GameStates.Completion()
            }
            this.queueAction('changeState', 'Login');
            this.interval_id = setInterval(function() {
                if(!self.is_running) {
                    self.is_running = true;
                    self.runGame();
                    self.is_running = false;
                }
            }, this.getFrameInterval())
            console.log('GAME STARTED');
        }

        this.stop = function() {
            clearInterval(this.interval_id);
            console.log('GAME ENDED');
        }

        this.runGame = function() {
            for(var i=0; i<this.action_queue.length; i++) {
                var action = this.action_queue.shift();
                if(typeof action['action'] == 'undefined') {
                    return false;
                }
                if(typeof this[action['action']] != 'undefined') {
                    this[action['action']](action['params']);
                } else if(typeof this.current_state[action['action']] != 'undefined') {
                    this.current_state[action['action']](action['params']);
                }
            }
            return true;
        }

        this.getFrameInterval = function() {
            return 1000 / this.fps;
        }

        this.changeState = function(new_state) {
            if(this.current_state != null && typeof this.current_state.leaveState != 'undefined') {
                this.current_state.leaveState();
            }
            if(typeof this.states[new_state] != 'undefined') {
                this.current_state = this.states[new_state]
                this.current_state.enterState();
            }
            return this;
        }

        this.queueAction = function(action, params) {
            this.action_queue.push({'action': action, 'params': params});
            return this;
        }


    };
    LOLRPG.game = new Game();
    LOLRPG.game.start();
});
