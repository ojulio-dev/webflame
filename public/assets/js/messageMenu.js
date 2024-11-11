$(document).ready(function() {

    $('.main-modal.-message-menu .users-wrapper li').click(function() {

       $('.main-modal.-message-menu .users-wrapper li').removeClass('-selected');

       $(this).addClass('-selected');

    });

});