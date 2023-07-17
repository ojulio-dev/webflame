$(document).ready(function() {

    const modalAction = (modal, action) => {

        if (action == 'show') {
    
            modal = `.main-modal.-${modal}`;
            
            $(modal).show();
            
            $('body').css('overflow', 'hidden');
    
        } else {
    
            $('body').css('overflow', 'auto');
    
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