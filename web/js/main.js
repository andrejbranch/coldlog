// This set's up the module paths for underscore and backbone
require.config({ 
    'paths': { 
        'jquery-ui' : 'lib/jquery/jquery-ui-1.10.2.custom.min',
        'modernizr' : 'lib/modernizr',
        'underscore': 'vendors/underscore/underscore', 
        'backbone'  : 'lib/backbone'
    },
    'shim': 
    {
        backbone: {
            'deps'   : ['jquery', 'underscore'],
            'exports': 'Backbone'
        },
        underscore: {
            'exports': '_'
        }
    }   
}); 

require([
    'underscore',
    'backbone',
    'app',
    'core',
    'modal',
    'form',
    'modernizr',
    'sideNav/sideNav',
    ], function(_, Backbone, app) {
        app.init();
});