define([
    'jquery', 
    'backbone', 
    'underscore', 
    'views/box/divisionBoxList',
], function($, Backbone, _, DivisionBoxListView) {
    divisionBoxListView=  new DivisionBoxListView();

    var Router = Backbone.Router.extend({
        initialize: function() {
        },
        routes: {
        },
    });

    return Router;
});