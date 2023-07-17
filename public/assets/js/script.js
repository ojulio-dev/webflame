const loaderAction = (action) => {

    if (action == 'show') {

        $('.component-loader').show();

    } else {

        $('.component-loader').hide();

    }

}

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

$(document).ready(function() {

    $('.main-button').click(function() {
        
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

const readerImage = (userImage, imageInput) => {

    if (imageInput.files.length) {

        const reader = new FileReader();

        reader.readAsDataURL(imageInput.files[0]);

        reader.onload = () => {

            userImage.src = reader.result;
            
        }
    }

}