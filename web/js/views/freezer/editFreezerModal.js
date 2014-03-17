define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/freezer/editFreezerModal.html',
    'models/freezer/freezer',
], function($, _, Backbone, EditFreezerTemplate, Freezer) {
    var AddFreezerModal = Backbone.View.extend({
        el: 'body',
        initialize: function() {
            this.modalId = 'edit-freezer-modal';
        },
        events: {
            'submit .edit-freezer-form'        : 'saveFreezer',
            'click .edit-freezer-form .delete': 'deleteFreezer'
        },
        render: function(id) {
            //let the right click menu know if can go away
            $('body').trigger('rcm.remove');

            freezer = new Freezer({id:id});
            that = this;
            freezer.fetch({
                success: function(freezer) {
                    var template = _.template(EditFreezerTemplate, { freezer: freezer });
                    $(that.el).append(template);
                    
                    //let our app know a modal is about to displayed
                    $('body').trigger('modal.created');

                    $('.modal').fadeIn('slow');

                    //let our app know a form is loaded - this needs to be called after fadeIn
                    $('body').trigger('form.loaded');
                }
            });

        },
        removeModal: function(e) {
            $('.modal').remove();
            $('.overlay').remove();
        },
        saveFreezer: function(e) {
            e.preventDefault();
            var a = $(e.currentTarget).serializeArray();

            freezerParams = {};
            $(a).each(function(k, v) {
                var b = v.name.indexOf('[') + 1;
                var e = v.name.indexOf(']');
                if (v.name.indexOf('freezer') != -1) {
                    freezerParams[v.name.substring(b, e)] = v.value;
                } 
            });

            var freezer = new Freezer();

            freezer.save(freezerParams, {
                success: function(freezer) {
                    $('body').trigger('freezer.list.update');
                    that.removeModal();
                    window.location = '#';
                },
                error: function(freezer, errors) {
                    $('body').trigger('form.error.show', [errors]);
                    $('.modal').effect("shake", { times: 3 }, 300);
                }
            });
        },
        deleteFreezer: function(e) {
            e.preventDefault();
            id = $(e.currentTarget).data('id');
            freezer = new Freezer({id:id});
            freezer.destroy({
                success: function() {
                    $('body').trigger('freezer.list.update');
                    that.removeModal();
                    window.location = '#';
                }
            });
        }
    });

    return AddFreezerModal;
});