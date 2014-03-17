define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/division/addBoxModal.html',
    'models/box/box',
], function($, _, Backbone, AddBoxModalTemplate, Box) {
    var AddBoxModal = Backbone.View.extend({
        el: 'body',
        initialize: function() {
            this.modalId = 'add-box-modal';
        },
        events: {
            'submit .new-box-form': 'createBox'
        },
        render: function(divisionId) {
            //let the right click menu know if can go away
            $('body').trigger('rcm.remove');

            var template = _.template(AddBoxModalTemplate, { divisionId : divisionId });
            $(this.el).append(template);
            
            //let our app know a modal is about to displayed
            $('body').trigger('modal.created');

            $('.modal').fadeIn('slow');

            //let our app know a form is loaded - this needs to be called after fadeIn
            $('body').trigger('form.loaded');
        },
        createBox: function(e) {
            e.preventDefault();
            var a = $(e.currentTarget).serializeArray();

            var boxParams   = {};

            $(a).each(function(k, v) {
                var b = v.name.indexOf('[') + 1;
                var e = v.name.indexOf(']');
                if (v.name.indexOf('box') != -1) {
                    boxParams[v.name.substring(b, e)] = v.value;
                }
            });

            var box = new Box();

            var that = this;
            box.save(boxParams, {
                success: function (box) {
                    $('body').trigger('boxes.fetch', [false, box.get('divisionId')]);
                    that.removeModal();
                    window.location = '#';
                },
            });
        },
        removeModal: function(e) {
            $('.modal').remove();
            $('.overlay').remove();
        },
    });

    return AddBoxModal;
});