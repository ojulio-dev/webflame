let timeout;

$(document).ready(function() {
    
    $('.main-modal.-upload .modal-content .input-send-video').change(function() {
    
        $('.main-modal.-upload .modal-content .send-video-wrapper').hide();
    
        $('.main-modal.-upload .modal-content .final-info-wrapper').css('display', 'grid');
    
    
    });
    
    $('.main-modal.-upload .modal-exit').click(function() {
    
        clearTimeout(timeout);
    
        $('.main-modal.-upload .modal-content .final-info-wrapper').hide();
        $('.upload-video-wrapper .email-message-sent').hide();
        $('.main-modal.-upload .modal-content .send-video-wrapper').css('display', 'flex');
    
        $('.upload-video-wrapper .final-info-wrapper .inputs-wrapper input').val('');
        $('.upload-video-wrapper .send-video-wrapper input').val('');
        $('.upload-video-wrapper .final-info-wrapper #thumbnail-picture').attr('src', `${publicPath}/images/icons/select_thumbnail.png`);
    
    });
    
    $('body').on('change', '.upload-video-wrapper .final-info-wrapper .input-send-thumbnail', function() {

        readerImage($('.upload-video-wrapper .final-info-wrapper #thumbnail-picture')[0], this);
        
    });
    
    $('.upload-video-wrapper .final-info-wrapper button').click(function() {
        
        $('.upload-video-wrapper .final-info-wrapper').hide();
        $('.upload-video-wrapper .email-message-sent').css('display', 'flex');
    
    });
    
    $('.videos-wrapper input, .videos-wrapper textarea').keyup(function() {

        let value = $(this).val();

        let actionsIcon = $(this).siblings('.actions-icon');
    
        actionsIcon.css('display', 'flex');

        if (value == $(this).data('default')) {
            $(actionsIcon).hide();
        };
    
    });
    
    $('.videos-wrapper .actions-icon .save').click(function() {
        $(this).parent(".actions-icon").hide();
    });
    
    $('.videos-wrapper .actions-icon .reverse').click(function() {

        let input = $(this).closest('.inputs-wrapper').find('input, textarea');

        input.val(input.data('default'));

        $(this).parent(".actions-icon").hide();
    });

});