$(document).ready(function() {

    $('.main-actions-menu button').click(function() {
       
        const menuElement = $(this).siblings('.options');

        const currentState = menuElement.css('display');

        if (currentState == 'none') {

            menuElement.css('display', 'flex');

        } else {

            menuElement.hide();

        }

    });

});