$(function() {
    var Game = function() {
        this.interval_id = null;
        this.is_running = false;
        this.fps = 60;
        this.use_test_data = false;

        this.start = function() {
            var self = this;
            this.interval_id = setInterval(function() {
                if(!self.is_running) {
                    self.is_running = true;
                    self.runGame();
                    self.is_running = false;
                }
            }, this.getFrameInterval())
            console.log('GAME STARTED');
        }

        this.startTest = function() {
            var self = this;
            this.use_test_data = true;
            this.interval_id = setInterval(function() {
                if(!self.is_running) {
                    self.is_running = true;
                    self.runGame();
                    self.is_running = false;
                }
            }, this.getFrameInterval())
            console.log('GAME TEST STARTED');
        }

        this.stop = function() {
            clearInterval(this.interval_id);
            console.log('GAME ENDED');
        }

        this.runGame = function() {
            console.log('looping');
        }

        this.getFrameInterval = function() {
            return 1000 / this.fps;
        }


    };
    LOLRPG.game = new Game();
});
