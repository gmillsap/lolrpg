$(function() {
    LOLRPG.ajaxData = {
        'is_ajaxing': false,
        'ajax_queue': [],

        'fetchData': function(params, fn) {
            if(this.is_ajaxing) {
                this.ajax_queue.push({
                    'params': params,
                    'callback': fn
                });
            } else {
                this.fetchData(params, fn);
            }
        },

        'performAjax': function(params, fn) {
            var self = this;
            this.is_ajaxing = true;
            var post_data = {
                'type': typeof params.type != 'undefined' ? params.type : 'POST',
                'url': typeof params.url != 'undefined' ? params.url : '/',
                'data': typeof params.data != 'undefined' ? params.data : {},
                'success': function() {
                    fn();
                    self.is_ajaxing = false;
                    self.performNextRequest();
                },
                'dataType': typeof params.dataType != 'undefined' ? params.dataType : 'json'
            }
            $.ajax(post_data);
        },

        'performNextRequest': function() {
            if(this.ajax_queue.length > 0) {
                var next_request = this.ajax_queue.shift();
                this.performAjax(next_request['params'], next_request['callback']);
            }
            return this;
        }
    }
});