define([
    'jquery',
    'underscore',
    'backbone',
    'collections/divisions/freezerDivisions',
    'text!templates/division/freezerDivisionList.html'
], function($, _, Backbone, FreezerDivisionCollection, freezerDivisionListTemplate) {
    var DivisionListView = Backbone.View.extend({
        el: 'body',
        initialize: function() {
        },
        events: {
            'divisions.fetch' : 'render',
        },
        render: function(event, isFreezer, freezerId) {
            if (!isFreezer) {
                return;
            }
            
            this.freezerId = freezerId;
            this.element   = '.section.children[data-parent="' + freezerId + '"]';
            var that           = this;

            var divisions      = new FreezerDivisionCollection(this.freezerId);

            divisions.fetch({
                success: function(divisions) {
                    var template = _.template(freezerDivisionListTemplate , {divisions: divisions.models});
                    var parent   = $('.section.freezers [data-id="' + that.freezerId + '"]');
                            
                    // Im expanded and we have fetched now (so no more fetching please)
                    parent.addClass('expanded fetched');

                    $(that.element).html(template);
                    $('.section.freezers [data-id="' + that.freezerId + '"]').find('.side-nav-expand').html('&#8212;');

                    // Now adjust the padding for these children
                    $('body').trigger('sideNavUpdate');
                }
            });
        }
    });

    return DivisionListView;
}); 