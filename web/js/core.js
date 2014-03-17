function htmlEncode(value) {
    return $('<div/>').text(value).html();
}

$.fn.serializeObject = function() {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    
    return o;
};

// Allows the use of the data attribute data-trigger to throw an event on click
$(function() {
    $('body').on('click', '[data-trigger]', function(e) {
        $('body').trigger($(this).data('trigger'), e);
    })
})

function isInt(subject) {
    var intRegex = /^\d+$/;
    if(intRegex.test(subject)) {
        return true;
    }

    return false;
}
