define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/freezer/freezersRCM.html',
    'text!templates/freezer/freezerRCM.html',
    'text!templates/division/divisionRCM.html'
], function($, _, Backbone, freezersRCMTemplate, freezerRCMTemplate, divisionRCMTemplate) {
    var FreezerRightClickMenu = Backbone.View.extend({
        el: 'body',
        initialize: function() {
            this.menuId = "freezer-right-click-menu";
        },
        events: function() {
            var e = {
                'mousedown li.title'    : 'renderFreezers',
                'mousedown li.freezer'  : 'renderFreezer',
                'mousedown li.division' : 'renderDivision',
                'click'                 : 'removeElement',
                'rcm.remove'            : 'forceRemove'
            }

            return e;
        },
        renderFreezers: function(e) {
            if (e.which == 3 && !$('#' + this.menuId).length) {
                var template = _.template(freezersRCMTemplate, {
                    id   : this.menuId,
                    left : e.pageX,
                    top  : e.pageY,
                });
                $(this.el).append(template);
            } else {
                this.removeElement(e);
            } 
        },
        renderFreezer: function(e) {
            if (e.which == 3 && !$('#' + this.menuId).length) {
                var template = _.template(freezerRCMTemplate, {
                    id        : this.menuId,
                    left      : e.pageX,
                    top       : e.pageY,
                    freezerId : $(e.currentTarget).data('id'),
                });
                $(this.el).append(template);
            } else {
                this.removeElement(e);
            } 
        },
        renderDivision: function(e) {
            if (e.which == 3 && !$('#' + this.menuId).length) {
                var template = _.template(divisionRCMTemplate, {
                    id         : this.menuId,
                    left       : e.pageX,
                    top        : e.pageY,
                    divisionId : $(e.currentTarget).data('id'),
                });
                $(this.el).append(template);
            } else {
                this.removeElement(e);
            } 
        },
        removeElement: function(e) {
            if (!$('#' + this.menuId).length) {
                return;
            }
            if ($(e.target).parents('#'+this.menuId).length) {
               return; 
            }
            if ($('#' + this.menuId).length) {
                this.forceRemove();
            }
        },
        forceRemove: function() {
            $('#' + this.menuId).remove();
        }
    });

    return FreezerRightClickMenu;
});