define([
    'jquery', 
    'backbone', 
    'underscore', 
    'views/division/freezerDivisionList',
    'views/division/addBoxModal'
], function($, Backbone, _, FreezerDivisionListView, AddBoxModal) {
    addBoxModal             =  new AddBoxModal();
    freezerDivisionListView =  new FreezerDivisionListView();

    var Router = Backbone.Router.extend({
        initialize: function() {
        },
        routes: {
            'division/:id/box/add' : 'addBox',
        },
        addBox: function(divisionId) {
            addBoxModal.render(divisionId);
        }
    });

    return Router;
});