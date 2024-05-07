const showCloseElements = () => {

    $('.main-close-elements').show();

}

const hideCloseElements = () => {

    const elements = $('.main-close-elements').data('elements');

    $(elements).hide();

    $('.main-close-elements').hide();

}

$(document).ready(function() {

    $('.main-close-elements').click(function() {

        hideCloseElements();

    });

});