define([
    'jquery',
    'underscore',
    'backbone',
    'collections/boxes/divisionBoxes',
    'text!templates/box/divisionBoxList.html'
], function($, _, Backbone, DivisionBoxCollection, divisionBoxListTemplate) {
    var DivisionBoxListView = Backbone.View.extend({
        el: 'body',
        initialize: function() {
        },
        events: {
            'boxes.fetch' : 'render',
        },
        render: function(event, isFreezer, divisionId) {
            if (isFreezer) {
                return;
            }

            var boxes = new DivisionBoxCollection(divisionId);

            this.divisionId = divisionId
            this.element   = '.section.children[data-parent="' + this.divisionId + '"]';

            var that = this;

            boxes.fetch({
                success: function(boxes) {
                    var template = _.template(divisionBoxListTemplate, { boxes: boxes.models });
                    var parent   = $('.section.freezers [data-id="' + that.divisionId + '"]');
                            
                    // Im expanded and we have fetched now (so no more fetching please)
                    parent.addClass('expanded fetched');

                    $(that.element).html(template);
                    parent.find('.side-nav-expand').html('&#8212;');

                    // Now adjust the padding for these children
                    $('body').trigger('sideNavUpdate');
                }
            });
        }
    });

    return DivisionBoxListView;
});