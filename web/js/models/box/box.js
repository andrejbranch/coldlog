define([
    'underscore',
    'backbone'
], function(_, Backbone) {
    var BoxModel = Backbone.Model.extend({
        urlRoot: '/api/box',
        defaults: { id: null },
        initialize: function() {
        },
        validate: function (attrs) {
            if (attrs.success == true) {
                return false;
            }

            var errors = [];

            return errors.length ? errors : false;
        },
    });

    return BoxModel;
});