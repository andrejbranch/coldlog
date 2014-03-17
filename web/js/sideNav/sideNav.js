define([
    'jquery',
    'jquery-ui',
    ], function($) {
        var expandClass = '.side-nav-expand';
        
        adjustMainContainer(); 
        initializeSideNavResize();

        $(window).on('resize', function() {
            adjustMainContainer();
        });

        // Highlighting on click
        $('body').on('click', '#side-nav-container .section li', function() {
            if ($(this).hasClass('selected')) {
                return;
            } else {
                $('#side-nav-container .section li.selected').first().find('i').addClass('white');
                $('#side-nav-container .section li.selected').first().removeClass('selected');
                $(this).addClass('selected');
                $(this).find('i').removeClass('white');
            }
        });

        // Anytime a divsions drop down is clicked we need to adjust the list padding.
        $('body').on('sideNavUpdate', function() {
            if (!$('.freezer').length) {
                return;
            }

            var defaultSpacing = parseInt($('.freezer').first().css('padding-left').replace('px', ''));
            var spacing = 15;
            $('.section.children li').each(function() {
                var count = 0;
                var currentSubject = $(this);
                while(currentSubject.parent('.section.children').length) { // ok Im a child within a child
                    currentSubject = currentSubject.parent('.section.children'); //update subject to see if it has a parent as well
                    count++; 
                }

                $(this).css('padding-left', defaultSpacing + (spacing * count) + 'px' );
            });
        });

        // Expand or contract the freezer to show or hide its divisions and boxes
        $('body').on('click', expandClass, function(e) {
            // Prevent the parent from being selected
            e.stopPropagation();
            parent     = $(this).parent('li');
            isFreezer  = parent.hasClass('freezer');
            isExpanded = parent.hasClass('expanded');
            isFetched  = parent.hasClass('fetched');

            if (!isExpanded && !isFetched) {
                $('body').trigger('divisions.fetch', [isFreezer, $(this).parent('li').data('id')]);
                $('body').trigger('boxes.fetch', [isFreezer, $(this).parent('li').data('id')]);
            }

            // Hide everything
            if (isExpanded) {
                $('.section.children[data-parent="'+ parent.data('id') + '"]').hide();
                parent.removeClass('expanded');
                $(this).html('+');
            }

            // Already fetched so just show the children
            if (!isExpanded && isFetched) {
                $('.section.children[data-parent="'+ parent.data('id') + '"]').show();
                parent.addClass('expanded');
                $(this).html('&#8212;');
            }
        });

        // Adjust the main container width as the side navigation bar resizes
        $(window).on('resize', '#side-nav-container', function() {
            adjustMainContainer();
        });

        // Disable context menu for this app
        // TODO: Need to see how to disable context for only a specific element and all of its children
        $('body').on('contextmenu', function(e) {
            return false;
        });

        function adjustMainContainer() {
            sideNavWidth = $('#side-nav-container').width();
            $('#main-container').css('width', $(window).width() - sideNavWidth - 2);
        }

        function initializeSideNavResize() {
            windowHeight = $(window).height();
            $( "#side-nav-container" ).resizable({ minWidth: 150, maxWidth: 350, minHeight: windowHeight});
        }
});

