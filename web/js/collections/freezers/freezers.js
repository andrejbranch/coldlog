define([
    'underscore',
    'backbone',
    'models/freezer/freezer'
], function(_, Backbone, FreezerModel) {
    var FreezerCollection = Backbone.Collection.extend({
        url: '/api/freezers',
        model: FreezerModel 
    });

    return FreezerCollection;
});