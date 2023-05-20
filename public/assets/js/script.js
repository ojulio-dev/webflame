const loaderAction = (action) => {

    if (action == 'show') {

        $('.component-loader').show();

    } else {

        $('.component-loader').hide();

    }

}

const modalAction = (modal, action) => {

    if (action == 'show') {

        modal = `.main-modal.${modal}`;
        
        $(modal).show();
        
        $('body').css('overflow', 'hidden');

    } else {

        $('body').css('overflow', 'auto');

        $('.component-loader').hide();

        modal.hide();    

    }
}

$(document).ready(function() {

    $('.main-button').click(function() {
        
        let modal = $(this).data('modal');

        modalAction(modal, 'show');

    });

    $('.main-modal .modal-exit').click(function() {
        
        let modal = $(this).parent();

        modalAction(modal, 'hide');

    });

});