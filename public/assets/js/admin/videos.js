$(document).ready(function() {

    const vaidateVideosPlayer = new Plyr('.main-modal-videos.-validateVideos .player');

    const reportedVideosPlayer = new Plyr('.main-modal-videos.-reportedVideos .player');

    const videosFilter = () => {

        const videosFilterGroup = $('.main-section.-videosFilter .main-admin-table tbody');

        videosFilterGroup.html('');

        $.ajax({
            url: `${API_PATH}/videoStatus/3`,
            dataType: 'JSON',
            success: function(data) {

                data.map(function(video, index) {

                    videosFilterGroup.append(`
                    
                        <tr ${index > 4 ? 'style="display: none;"' : ''}>
                            <td>
                                <img src="${PUBLIC_PATH}/assets/images/thumbnails/${video.thumbnail}" alt="Ícone do Usuário">
                            </td>
                
                            <td>${video.user.name}</td>
                
                            <td>${video.title}</td>
                
                            <td>
                                <button class="main-button -orange validate-button" type="button" data-id="${video.id}">

                                    Validar

                                    <div class="loader-wrapper" style="display: none;">
                                        <img src="${PUBLIC_PATH}/assets/images/loaders/loader_button.gif">
                                    </div>
                                    
                                </button>
                            </td>
                        </tr>

                    `);

                });

            }
        })

    }

    const reportedVideosFilter = () => {

        const videosFilterGroup = $('.main-section.-reportedVideos .main-admin-table tbody');

        videosFilterGroup.html('');

        $.ajax({
            url: `${API_PATH}/reportedVideos`,
            dataType: 'JSON',
            success: function(data) {

                console.log(data);

                data.map(function(reportedVideo, index) {

                    videosFilterGroup.append(`

                        <tr ${index > 4 ? 'style="display: none;"' : ''}>
                            <td>
                                <img src="${PUBLIC_PATH}/assets/images/thumbnails/${reportedVideo.video.thumbnail}" alt="Ícone do Usuário">
                            </td>
                
                            <td>${reportedVideo.video.title}</td>
                
                            <td>
                                <button class="main-button -orange reported-videos-modal" type="button" data-id="${reportedVideo.id}">

                                    Avaliar

                                    <div class="loader-wrapper" style="display: none;">
                                        <img src="${PUBLIC_PATH}/assets/images/loaders/loader_button.gif">
                                    </div>

                                </button>

                            </td>
                        </tr>

                    `);

                });

            }
        })

    };

    const stopVideo = (video) => {

        video.get(0).pause();

    }

    // Open videos filter modal
    $('body').on('click', '.main-section.-videosFilter .main-admin-table .validate-button', function() {

        const clickedButton = this;

        const videoId = this.dataset.id;

        const videoModal = $('.main-modal-videos.-validateVideos');

        openLoaderButton(clickedButton);

        $.ajax({
            url: `${API_PATH}/video/${videoId}`,
            dataType: 'JSON',
            success: function(data) {

                videoModal.data('video-id', data.id);

                videoModal.find('.main-video-player source').attr('src', `${PUBLIC_PATH}assets/videos/${data.video}`);

                videoModal.find('.main-video-player video').get(0).load();

                videoModal.find('.main-video-player .plyr__poster').css('background-image', `url(${PUBLIC_PATH}/assets/images/thumbnails/${data.thumbnail})`);

                videoModal.find('#validate-info-channel p').html(data.user.name);

                videoModal.find('#validate-info-title p').html(data.title);

                videoModal.find('#validate-info-description p').html(data.description);

                $('.main-modal-videos.-validateVideos').css('display', 'flex');

                $('.main-modal-videos.-validateVideos').addClass('openModal');

                closeLoaderButton(clickedButton);

            }
        });
        
    });

    // Open filtered videos modal
    $('body').on('click', '.main-section.-reportedVideos .main-admin-table .reported-videos-modal', function() {

        const clickedButton = this;

        const reportedVideoId = $(this).data('id');

        const reportedVideoModal = $('.main-modal-videos.-reportedVideos');

        openLoaderButton(clickedButton);

        $.ajax({
            url: `${API_PATH}/reportedVideos/${reportedVideoId}`,
            method: 'GET',
            success: function(data) {

                reportedVideoModal.data('reported-video', data.id);

                reportedVideoModal.find('.main-video-player source').attr('src', `${PUBLIC_PATH}assets/videos/${data.video.video}`);

                reportedVideoModal.find('.main-video-player video').get(0).load();

                reportedVideoModal.find('.main-video-player .plyr__poster').css('background-image', `url(${PUBLIC_PATH}/assets/images/thumbnails/${data.video.thumbnail})`)

                reportedVideoModal.find('#reported-by p').html(`<a href="${PUBLIC_PATH}user/@${data.reporting_user.username}" target="_blank">@${data.reporting_user.username}</a>`);

                reportedVideoModal.find('#reported-reason p').html(data.reason);

                reportedVideoModal.find('#reported-user p').html(`<a href="${PUBLIC_PATH}user/@${data.reported_user.username}" target="_blank">@${data.reported_user.username}</a>`);

                reportedVideoModal.find('#reported-title p').html(data.video.title);

                reportedVideoModal.find('#reported-description p').html(data.video.description);

                reportedVideoModal.css('display', 'flex');

                reportedVideoModal.addClass('openModal');

                closeLoaderButton(clickedButton);

            }
        });

    });

    // Close Modal
    $('.main-modal-videos .modal-close').click(function() {

        const modalVideos = $(this).closest('.main-modal-videos');

        stopVideo(modalVideos.find('.main-video-player video'));

        modalVideos.hide();
        
    });

    $('.main-modal-videos.-validateVideos .buttons-wrapper button').click(function() {

        const videoId = $('.main-modal-videos.-validateVideos').data('video-id');

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

                    $.ajax({
                        url: `${API_PATH}/video/updateStatus/1`,
                        method: 'POST',
                        data: {
                            'video_id': videoId
                        },
                        dataType: 'JSON',
                        success: function(data) {

                            Swal.fire(
                                'Feito!',
                                'O vídeo foi aceito em nossa plataforma!',
                                'success'
                            )

                            videosFilter();

                            $('.main-modal-videos.-validateVideos').css('display', 'none');

                            stopVideo($('.main-modal-videos.-validateVideos').find('.main-video-player video'));

                        }
                    })
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

                        $.ajax({
                            url: `${API_PATH}/video/updateStatus/4`,
                            method: 'POST',
                            data: {
                                'video_id': videoId
                            },
                            dataType: 'JSON',
                            success: function(data) {
    
                                Swal.fire(
                                    'Feito!',
                                    'O vídeo não foi aceito em nossa plataforma!',
                                    'success'
                                )

                                videosFilter();

                                $('.main-modal-videos.-validateVideos').css('display', 'none');

                                stopVideo($('.main-modal-videos.-validateVideos').find('.main-video-player video'));

                            }
                        })
                    }

                }

              })

        }

    });

    $('.main-modal-videos.-reportedVideos .buttons-wrapper button').click(function() {

        const reportedVideoId = $('.main-modal-videos.-reportedVideos').data('reported-video');

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

                        $.ajax({
                            url: `${API_PATH}/reportedVideos/${reportedVideoId}/removeVideo`,
                            method: 'GET',
                            success: function() {

                                reportedVideosFilter();

                                $('.main-modal-videos.-reportedVideos').hide();

                                stopVideo($('.main-modal-videos.-reportedVideos').find('.main-video-player video'));

                                Swal.fire(
                                    'Feito!',
                                    'O vídeo foi removido da nossa plataforma!',
                                    'success'
                                )

                            }
                        });
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
                  
                    $.ajax({
                        url: `${API_PATH}/reportedVideos/${reportedVideoId}/allowVideo`,
                        method: 'GET',
                        success: function() {

                            reportedVideosFilter();

                            $('.main-modal-videos.-reportedVideos').hide();

                            stopVideo($('.main-modal-videos.-reportedVideos').find('.main-video-player video'));

                            Swal.fire(
                                'Feito!',
                                'O vídeo continua em nossa plataforma!',
                                'success'
                            )

                        }
                    });

                }
            })

        }

    });

});