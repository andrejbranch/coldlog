define([
    'underscore',
    'backbone',
    'models/box/box'
], function(_, Backbone, BoxModel) {
    var DivisionBoxCollection = Backbone.Collection.extend({
        initialize: function(divisionId) {
            this.url = '/api/division/'+ divisionId +'/boxes';
        },
        model: BoxModel,
    });

    return DivisionBoxCollection;
});