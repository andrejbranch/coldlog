define([
    'jquery', 
    'backbone', 
    'underscore', 
    'views/freezer/list', 
    'views/freezer/rightClickMenu',
    'views/freezer/addFreezerModal', 
    'views/freezer/editFreezerModal',
], function($, Backbone, _, FreezerListView, FreezerRightClickMenu, AddFreezerModal, EditFreezerModal) {
    freezerListView       = new FreezerListView();
    freezerRightClickMenu = new FreezerRightClickMenu();
    addFreezerModal       = new AddFreezerModal();
    editFreezerModal      = new EditFreezerModal();

    var Router = Backbone.Router.extend({
        initialize: function() {
            freezerListView.render();
        },
        routes: {
            ''                : 'home',
            'freezer/new'     : 'addFreezer',
            'freezer/edit/:id': 'editFreezer',
        },
        home: function() {
            // probably should have a global modal remove trigger
            $('body').trigger('freezer.modal.remove');
        },
        addFreezer: function() {
            addFreezerModal.render();
        },
        editFreezer: function(id) {
            editFreezerModal.render(id);
        }
    });

    return Router;
});