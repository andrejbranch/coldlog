define([
    'underscore',
    'backbone'
], function(_, Backbone) {
    var DivisionModel = Backbone.Model.extend({
        defaults: {
            id: 1,
            name: "Freezer 1",
            description: "Freezer 1"
        }
    });

    return DivisionModel;
});