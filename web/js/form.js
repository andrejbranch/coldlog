$('body').on('form.loaded', function() {
    alignLabels();
    positionErrors();
});

$('body').on('form.error.show', function(e, errors) {
    _.each(errors, function(error) {
        $('form .error[data-error="' + error[0].property + '"]').html(error[0].message).show();
        $('form input[name="' + error[0].property + '"]').addClass('hasError');
    });
})

$('body').on('modal.scroll', function() {
    positionErrors();
});

function alignLabels() {
    var largestLabelWidth = 0; 
    $('form label').each(function() {
        largestLabelWidth = largestLabelWidth < $(this).width() ? $(this).width() : largestLabelWidth;
    });
    $('form label').each(function() {
        $(this).css('width', largestLabelWidth);
    });
    $('form .actions').css('padding-left', largestLabelWidth + 22);
}

function positionErrors() {
    $('form .error').each(function() {
        var relaventInputName = $(this).data('error');
        var relaventInput     = $('input[name="' + relaventInputName + '"]');

        if (relaventInput.position().top < 50 && $(this).css('display') != 'none') {
            $(this).toggle();
        } else if (relaventInput.position().top > 50 && $(this).css('display') == 'none' && relaventInput.hasClass('hasError')) {
            $(this).toggle();
        }

        var top  = relaventInput.position().top + 3;
        var left = relaventInput.position().left + relaventInput.outerWidth() + 17;

        $(this).css('top', top).css('left', left);
    });
}
