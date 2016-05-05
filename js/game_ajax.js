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
                this.performAjax(params, fn);
            }
        },

        'performAjax': function(params, fn) {
            var self = this;
            this.is_ajaxing = true;
            var error_callback = typeof params.error_callback != 'undefined' ? params.error_callback : function() {};
            var post_data = {
                'type': typeof params.type != 'undefined' ? params.type : 'GET',
                'url': typeof params.url != 'undefined' ? params.url : '/',
                'data': typeof params.data != 'undefined' ? params.data : {},
                'success': function(response) {
                    self.is_ajaxing = false;
                    if(typeof response.error != 'undefined') {
                        if(typeof params.show_errors != 'undefined' && params.show_errors == true) {
                            LOLRPG.showError(response.error, function() {
                                error_callback(response.error);
                                fn(response);
                            });
                        } else {
                            error_callback(response.error);
                            fn(response);
                        }
                    } else {
                        fn(response);
                    }
                    self.performNextRequest();
                },
                'dataType': typeof params.dataType != 'undefined' ? params.dataType : 'json',
                'error': function(response) {
                    self.is_ajaxing = false;
                    fn({'error': 'Error communicating with server. Please try your request in a few moments.'})
                    self.performNextRequest();
                }

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