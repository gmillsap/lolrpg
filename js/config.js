$(function() {
    LOLRPG = {};
    LOLRPG.game_container_selector = '#lolrpg-container';
    
    LOLRPG.showError = function(error_message, callback) {
        callback = callback || function() {};
        var $modal = $('#base-modal');
        $modal.find('.modal-body').html(error_message);
        $modal.off('hidden.bs.modal').on('hidden.bs.modal', function() {
            $modal.find('.modal-body').html('');
            callback();
        });
        $modal.modal('show');
    }

    LOLRPG.empty = function(x) {
        if(typeof x == 'undefined') { return true; }
        if(x == false) { return true; }
        if(x == '') { return true; }
        return false;
    }

    LOLRPG.loadingModal = function(loader_text, callback) {
        this.loader_text = loader_text || '';
        this.callback = callback || function() {};
        this.$modal = $('#loading-modal');

        this.open = function() {
            this.$modal.find('.loader-text').html(this.loader_text);
            this.$modal.modal({
                'backdrop': 'static',
                'keyboard': false
            });
            this.$modal.modal('show');
        }

        this.close = function() {
            this.$modal.find('.loader-text').html('');
            this.$modal.modal('hide');
            this.callback();
        }
    }

    LOLRPG.rowCheck = function(selector) {
        $('body').off('click.row', selector).on('click.row', selector, function(e) {
            console.log($(this));
            var $checkbox = $(this).find('input[type="checkbox"]');
            if($checkbox.length > 0) {
                if($(this).not(':checkbox')) {
                    $checkbox.trigger('click');
                }
            }
        });
    }
    LOLRPG.rowCheck('.lolrpg-row-check');

    LOLRPG.onlyOneCheck = function(selector) {
        $('body').off('change.one_check', selector + ' input[type="checkbox"]').on('click.one_check', selector + ' input[type="checkbox"]', function() {
            var $this = $(this);
            if($this.is(':checked')) {
                var $checkboxes = $(selector).find('input[type="checkbox"]');
                $checkboxes.each(function() {
                    if(!$(this).is($this)) {
                        $(this).prop('checked', false);
                    }
                });
            }
        });
    }
    LOLRPG.onlyOneCheck('.lolrpg-only-one-check');
});
