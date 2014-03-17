$('body').on('modal.created', function() { 
    windowWidth  = $(window).width();
    windowHeight = $(window).height();

    modal        = $('.modal');
    modal.find('.content').css('max-height', (windowHeight * 0.40));

    width        = modal.width();
    height       = modal.height();

    modal.css('top', (windowHeight / 2) - (height / 2) - 50);
    modal.css('left', (windowWidth / 2) - (width/ 2));

    // workaround because on.('scroll') doesnt work
    $('.content').scroll(function() {
        $('body').trigger('modal.scroll');
    });
});

$(window).on('resize', function() { 
    modal        = $('.modal');
    width        = modal.width();
    height       = modal.height();
    windowWidth  = $(window).width();
    windowHeight = $(window).height();
    
    modal.css('top', (windowHeight / 2) - (height / 2) - 50);
    modal.css('left', (windowWidth / 2) - (width/ 2));
});
