$(function() {
    LOLRPG.Gamelog = {};

    LOLRPG.Gamelog.Log = function() {
        this.game_log_container = '.game-log';
        this.logAction = function(message) {
            $(this.game_log_container).append('<div><p>' + message + '</p></div>');
            $(this.game_log_container).animate({scrollTop: $(this.game_log_container).prop('scrollHeight') - $(this.game_log_container).height()}, 100)
        };
    }
});