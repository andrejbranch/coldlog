define([
    'backbone',
    'routes/freezerRouter',
    'routes/divisionRouter',
    'routes/boxRouter'
], function(Backbone, freezerRouter, divisionRouter, boxRouter) {
    var init = function() {
        this.freezerRouter  = new freezerRouter();
        this.divisionRouter = new divisionRouter();
        this.boxRouter      = new boxRouter();

        Backbone.history.start();
    };

    return { init: init};
});