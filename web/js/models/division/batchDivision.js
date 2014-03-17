define([
    'underscore',
    'backbone'
], function(_, Backbone) {
    var BatchDivision = Backbone.Model.extend({
        urlRoot: '/api/divisions',
        validate: function (attrs) {
            if (attrs.success == true) {
                return false;
            }
            
            var errors = [];

            if (!attrs.name) {
                errors.push([{property: 'division[name]', message: 'At least give me a name!'}]);
            }

            return errors.length ? errors : false;
        },
    });

    return BatchDivision;
});