let timeout;

$(document).ready(function() {

    // Modal de Upload de Vídeos
    $('.main-modal.-upload .modal-content .input-send-video').change(function() {
    
        $('.main-modal.-upload .modal-content .send-video-wrapper').hide();
    
        $('.main-modal.-upload .modal-content .final-info-wrapper').css('display', 'grid');

        $('.main-modal.-upload progress').val(50);
    
    
    });
    
    $('.upload-video-wrapper .final-info-wrapper button').click(function() {
        
        $('.upload-video-wrapper .final-info-wrapper').hide();
        $('.upload-video-wrapper .email-message-sent').css('display', 'flex');
        $('.upload-video-wrapper .email-message-sent').addClass('smoothAnimation');

        $('.main-modal.-upload progress').val(100);
    
    });

    $('.main-modal.-upload .modal-exit').click(function() {
    
        clearTimeout(timeout);
    
        $('.main-modal.-upload .modal-content .final-info-wrapper').hide();
        $('.upload-video-wrapper .email-message-sent').hide();
        $('.main-modal.-upload .modal-content .send-video-wrapper').css('display', 'flex');
    
        $('.upload-video-wrapper .final-info-wrapper input, .upload-video-wrapper .final-info-wrapper textarea').val('');
        $('.upload-video-wrapper .send-video-wrapper input').val('');

        $('.upload-video-wrapper .final-info-wrapper #thumbnail-picture').attr('src', `${publicPath}/images/icons/select_thumbnail.png`);
        $('.upload-video-wrapper .final-info-wrapper #thumbnail-picture').css('border', 'none');

        $('.main-modal.-upload progress').val(0);
    
    });

    // Reader Thumbnail
    $('.modal-content.-upload form .final-info-wrapper input').change(function() {

        readerImage($('.modal-content.-upload form .final-info-wrapper img')[0], this);

        $('.modal-content.-upload form .final-info-wrapper img').css('border', '1px solid #e8e8e8');
    });
    

    // Tabela de Vídeos
    $('.videos-wrapper input').keyup(function() {

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