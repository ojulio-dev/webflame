let flashMessageTimer;

const openFlashMessage = (message, type, timer = 5000) => {

    clearTimeout(flashMessageTimer);

    const flashMessage = $('.main-flash-message');

    flashMessage.removeClass();

    flashMessage.addClass('main-flash-message');

    flashMessage.css('display', 'none');

    $('.main-flash-message > p').html(message);

    const elementIcon = $('.main-flash-message > span');

    switch (type) {

        case 'alert':

            flashMessage.addClass('-alert');
            
            elementIcon.html('<i class="fa-solid fa-exclamation"></i>');

            break;
        
        case 'success':

            flashMessage.addClass('-success');

            elementIcon.html('<i class="fa-solid fa-check"></i>');

            break;

        case 'info':

            flashMessage.addClass('-info');
    
            elementIcon.html('<i class="fa-solid fa-info"></i>');

            break;

        case 'error':

            flashMessage.addClass('-error');
        
            elementIcon.html('<i class="fa-solid fa-bomb"></i>');

            break;
    }

    flashMessageTimer = setTimeout(function() {

        flashMessage.css('display', 'flex');

        flashMessage.addClass('openFlashMessage');

        flashMessageTimer = setTimeout(function() {

            flashMessage.addClass('closeFlashMessage');

            flashMessageTimer = setTimeout(function() {

                flashMessage.css('display', 'none');
        
            }, 500);
    
        }, timer);

    }, 10);

}