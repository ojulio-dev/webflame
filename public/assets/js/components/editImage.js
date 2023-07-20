$(document).ready(function() {

    document.querySelector('.main-edit-image > input').addEventListener('change', function() {

        readerImage($(this).siblings('label').find('img')[0], this);

    });

});