$(function() {
    var Game = function() {
        this.interval_id = null;
        this.is_running = false;
        this.current_state = null;
        this.states = {};
        this.fps = 60;
        this.action_queue = [];
        this.delaying_action = false;
        this.region = 'na';
        this.game_difficulty = null;
        this.summoner = null;
        this.raw_champion_mastery = null;
        this.calculated_champion_mastery = null;
        this.player_champion = null;
        this.enemy_champions = {};
        this.current_enemy = {};
        this.game_log = null;

        this.start = function() {
            var self = this;
            this.states = {
                'Login': new LOLRPG.GameStates.Login(),
                'ChampionSelect': new LOLRPG.GameStates.ChampionSelect(),
                'WorldMap': new LOLRPG.GameStates.WorldMap(),
                'Battle': new LOLRPG.GameStates.Battle(),
                'Completion': new LOLRPG.GameStates.Completion()
            }
            this.game_log = new LOLRPG.Gamelog.Log();
            this.player_champion = new LOLRPG.Entities.Champion();
            this.queueAction('changeState', 'Login');
            this.interval_id = setInterval(function() {
                if(!self.is_running) {
                    self.is_running = true;
                    self.runGame();
                    self.is_running = false;
                }
            }, this.getFrameInterval())
        }

        this.stop = function() {
            clearInterval(this.interval_id);
        }

        this.runGame = function() {
            if(this.delaying_action) {
                return true;
            }
            for(var i=0; i<this.action_queue.length; i++) {
                var action = this.action_queue.shift();
                if(typeof action['action'] != 'undefined') {
                    if(typeof action['model'] != 'undefined') {
                        if(typeof action['model'][action['action']] == 'undefined') {
                            return false;
                        }
                        if(typeof action['params'] != 'undefined') {
                            action['model'][action['action']](action['params']);
                        } else {
                            action['model'][action['action']]();
                        }
                        if(typeof action['callback'] != 'undefined') {
                            action['callback']();
                        }
                    } else {
                        if(typeof this[action['action']] != 'undefined') {
                            this[action['action']](action['params']);
                        } else if(typeof this.current_state[action['action']] != 'undefined') {
                            this.current_state[action['action']](action['params']);
                        }
                        if(typeof action['callback'] != 'undefined') {
                            action['callback']();
                        }
                    }
                }
                return true;
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

        this.queueAction = function(action, params, callback) {
            this.action_queue.push({'action': action, 'params': params, 'callback': callback});
            return this;
        }

        this.queueModelAction = function(model, action, params, callback) {
            this.action_queue.push({'model': model, 'action': action, 'params': params, 'callback': callback});
            return this;
        }

        this.purgeActionQueue = function() {
            this.delaying_action = false;
            this.action_queue = [];
            return this;
        }

        this.delay = function(time_ms) {
            var self = this;
            this.delaying_action = true;
            setTimeout(function() {
                self.delaying_action = false;
            }, time_ms)
        }


    };
    LOLRPG.game = new Game();
    LOLRPG.game.start();
});
