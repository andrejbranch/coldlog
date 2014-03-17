define([
    'underscore',
    'backbone',
    'models/division/division'
], function(_, Backbone, DivisionModel) {
    var FreezerDivisionCollection = Backbone.Collection.extend({
        initialize: function(freezerId) {
            this.url = '/api/freezer/divisions/' + freezerId;
        },
        model: DivisionModel,
    });

    return FreezerDivisionCollection;
});