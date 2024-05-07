const openLoaderButton = (button) => {

    $(button).find('.loader-wrapper').css('display', 'flex');

    $(button).attr('disabled', true);

    $(button).css('pointer-events', 'none');

}

const closeLoaderButton = (button) => {

    $(button).find('.loader-wrapper').hide();

    $(button).attr('disabled', false);

    $(button).css('pointer-events', 'all');

}