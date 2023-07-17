$(document).ready(function() {

    document.querySelector('.main-content.-profile .infos-wrapper #userIcon').addEventListener('change', function() {
        
        readerImage($('.main-content.-profile .infos-wrapper .user-icon')[0], this);

    });

});