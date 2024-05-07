const modalAction = (modal, action) => {

    var hasActiveScroll = document.documentElement.scrollHeight > document.documentElement.clientHeight;

    if (action == 'show') {

        $('#app-container').css('overflow', 'hidden');

        hasActiveScroll && $('#app-container').css('padding-right', '6px');
        
        modal.show();

        modal.addClass('openModal');

    } else {

        $('#app-container').css('overflow', 'auto');

        hasActiveScroll && $('#app-container').css('padding-right', '0');

        modal.hide();

    }
}

$(document).ready(function() {

    $('body').on('click', '.open-modal', function() {
        
        let modal = $(this).data('modal');

        if (modal) {

            modalAction($(`.main-modal.-${modal}`), 'show');

        }
    });

    $('body').on('click', '.main-modal .modal-exit', function() {
        
        let modal = $(this).parent();

        modalAction(modal, 'hide');

    });

});