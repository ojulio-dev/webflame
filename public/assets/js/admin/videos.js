$(document).ready(function() {

    const vaidateVideosPlayer = new Plyr('.main-modal-videos.-validateVideos .player');

    const reportedVideosPlayer = new Plyr('.main-modal-videos.-reportedVideos .player');

    // Open videos filter modal
    $('body').on('click', '.main-section.-videosFilter .main-admin-table .validate-button', function() {
        
        $('.main-modal-videos.-validateVideos').css('display', 'flex');

        $('.main-modal-videos.-validateVideos').addClass('openModal');
        
    });

    // Open filtered videos modal
    $('body').on('click', '.main-section.-reportedVideos .main-admin-table .reported-videos-modal', function() {
        
        $('.main-modal-videos.-reportedVideos').css('display', 'flex');

        $('.main-modal-videos.-reportedVideos').addClass('openModal');

    });

    // Close Modal
    $('.main-modal-videos .modal-close').click(function() {

        $(this).closest('.main-modal-videos').hide();
        
    });

    $('.main-modal-videos.-validateVideos .buttons-wrapper button').click(function() {

        if ($(this).data('action') == 'accept') {

            Swal.fire({
                title: 'Certeza?',
                text: "Tem certeza que este vídeo é válido?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tenho',
                cancelButtonText: 'Voltar'
              }).then((result) => {
                if (result.isConfirmed) {
                  Swal.fire(
                    'Feito!',
                    'O vídeo foi aceito em nossa plataforma!',
                    'success'
                  )
                }
            })

        } else {

            Swal.fire({
                title: 'Recusar vídeo',
                text: 'Se possível, escreva o motivo para nosso usuário.',
                input: 'textarea',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showCancelButton: true,
                confirmButtonText: 'Continuar',
                cancelButtonText: 'Cancelar',
                showLoaderOnConfirm: true
              }).then((result) => {

                if (result.isConfirmed) {

                    if (result.isConfirmed) {
                        Swal.fire(
                            'Feito!',
                            'O vídeo não foi aceito em nossa plataforma!',
                            'success'
                        )
                    }

                }

              })

        }

    });

    $('.main-modal-videos.-reportedVideos .buttons-wrapper button').click(function() {

        if ($(this).data('action') == 'remove') {

            Swal.fire({
                title: 'Remover vídeo?',
                text: 'Se possível, escreva o motivo para nosso usuário.',
                input: 'textarea',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showCancelButton: true,
                confirmButtonText: 'Continuar',
                cancelButtonText: 'Cancelar',
                showLoaderOnConfirm: true
              }).then((result) => {

                if (result.isConfirmed) {

                    if (result.isConfirmed) {
                        Swal.fire(
                            'Feito!',
                            'O vídeo foi removido da nossa plataforma!',
                            'success'
                        )
                    }

                }

            })

        } else {

            Swal.fire({
                title: 'Certeza?',
                text: "Tem certeza que deixará o vídeo em nossa plataforma?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tenho',
                cancelButtonText: 'Voltar'
              }).then((result) => {
                if (result.isConfirmed) {
                  Swal.fire(
                    'Feito!',
                    'O vídeo continua em nossa plataforma!',
                    'success'
                  )
                }
            })

        }

    });

});