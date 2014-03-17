define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/freezer/addFreezerModal.html',
    'models/freezer/freezer',
    'models/division/batchDivision'
], function($, _, Backbone, addFreezerTemplate, Freezer, BatchDivision) {
    var AddFreezerModal = Backbone.View.extend({
        el: 'body',
        initialize: function() {
            this.modalId = 'add-freezer-modal';
        },
        events: {
            'freezer.modal.remove'    : 'removeModal',
            'submit .new-freezer-form': 'saveFreezer'
        },
        render: function(e) {
            //let the right click menu know if can go away
            $('body').trigger('rcm.remove');

            var template = _.template(addFreezerTemplate);
            $(this.el).append(template);
            
            //let our app know a modal is about to displayed
            $('body').trigger('modal.created');

            $('.modal').fadeIn('slow');

            //let our app know a form is loaded - this needs to be called after fadeIn
            $('body').trigger('form.loaded');
        },
        removeModal: function(e) {
            $('.modal').remove();
            $('.overlay').remove();
        },
        saveFreezer: function(e) {
            e.preventDefault();
            var a = $(e.currentTarget).serializeArray();

            var freezerParams   = {};
            var divisionsParams = {};

            $(a).each(function(k, v) {
                var b = v.name.indexOf('[') + 1;
                var e = v.name.indexOf(']');
                if (v.name.indexOf('freezer') != -1) {
                    freezerParams[v.name.substring(b, e)] = v.value;
                } else if (v.name.indexOf('division') != -1) {
                    divisionsParams[v.name.substring(b, e)] = v.value;
                }
            });

            var freezer       = new Freezer();
            var batchDivision = new BatchDivision();
            var that          = this;

            divisionErrors = batchDivision.validate(divisionsParams);
            freezerErrors  = freezer.validate(freezerParams);

            if (divisionErrors || freezerErrors) {
                $('body').trigger('form.error.show', [divisionErrors]);
                $('body').trigger('form.error.show', [freezerErrors]);
                $('.modal').effect("shake", { times: 3 }, 300);

                return;
            }

            freezer.save(freezerParams, {
                success: function (freezer) {
                    divisionsParams['freezerId'] = freezer.get('id');

                    batchDivision.save(divisionsParams, {
                        success: function(divisions) {
                            $('body').trigger('freezer.list.update');
                            that.removeModal();
                            window.location = '#';
                        }
                    });
                },
            });
        }
    });

    return AddFreezerModal;
});