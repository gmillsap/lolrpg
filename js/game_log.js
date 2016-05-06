$(function() {
    LOLRPG.Gamelog = {};

    LOLRPG.Gamelog.Log = function() {
        this.game_log_container = '.game-log';
        this.logAction = function(message) {
            $(this.game_log_container).append('<div><span>' + message + '<br/></span></div>');
            $(this.game_log_container).animate({scrollTop: $(this.game_log_container).prop('scrollHeight') - $(this.game_log_container).height()}, 100)
        };
        
        this.clearLog = function() {
            $(this.game_log_container).html('');
        }
    }
});