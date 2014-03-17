define([
    'jquery',
    'underscore',
    'backbone',
    'collections/freezers/freezers',
    'text!templates/freezer/list.html'
], function($, _, Backbone, FreezerCollection, freezerListTemplate) {
    var FreezerListView = Backbone.View.extend({
        el: 'body',
        initialize: function() {
            this.container = '.freezers';
        },
        events: {
            'freezer.list.update': 'render'
        },
        render: function() {
            var that = this;
            var freezers = new FreezerCollection();
            freezers.fetch({
                success: function(freezers) {
                    var template = _.template(freezerListTemplate, {freezers: freezers.models});
                    $(that.container).html(template);
                    $('body').trigger('sideNavUpdate');
                }
            });
        }
    });

    return FreezerListView;
});