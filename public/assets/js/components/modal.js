$(document).ready(function() {

    const modalAction = (modal, action) => {

        var hasActiveScroll = document.documentElement.scrollHeight > document.documentElement.clientHeight;

        if (action == 'show') {
    
            modal = `.main-modal.-${modal}`;
            
            $(modal).show();

            $(modal).addClass('openModal');
            
            $('#app-container').css('overflow', 'hidden');

            hasActiveScroll && $('#app-container').css('padding-right', '6px');
    
        } else {

            $('#app-container').css('overflow', 'auto');

            hasActiveScroll && $('#app-container').css('padding-right', '0');
    
            $('.component-loader').hide();
    
            modal.hide();    
    
        }
    }

    $('.open-modal').click(function() {
        
        let modal = $(this).data('modal');

        if (modal) {

            modalAction(modal, 'show');

        }
    });

    $('.main-modal .modal-exit').click(function() {
        
        let modal = $(this).parent();

        modalAction(modal, 'hide');

    });

});