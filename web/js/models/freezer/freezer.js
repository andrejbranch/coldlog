define([
    'underscore',
    'backbone'
], function(_, Backbone) {
    var Freezer = Backbone.Model.extend({
        urlRoot: '/api/freezer',
        validate: function (attrs) {
            if (attrs.success == true) {
                return false;
            }
            
            var errors = [];

            if (!attrs.name) {
                errors.push([{property: 'freezer[name]', message: 'At least give me a name!'}]);
            }

            return errors.length ? errors : false;
        },
    });

    return Freezer;
});