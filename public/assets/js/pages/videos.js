let timeout;

let videoInfos = {};

$(document).ready(function () {

    const reloadVideos = () => {

        $.ajax({
            url: `${API_PATH}/user/${USER_INFOS.id}/videos`,
            dataType: 'JSON',
            success: function (data) {

                $('.main-content.-videos .videos-wrapper').html('');


                if (data.length) {

                    $('.main-content.-videos .videos-wrapper').html(`
                        <table>
                            ${data.map(function (video) {

                        return `
                                
                                    <tr data-video="${video.id}">
                                        <td class="thumbnail-wrapper">
                                            <a href="${APP_PATH}/watch?video=${video.id}">
                                                <img src="${PUBLIC_PATH}/images/thumbnails/${video.thumbnail}?${Math.random()}" alt="Thumbnail">
                                            </a>
                                        </td>
                        
                                        <td class="title">
                                            <p>${video.title}</p>
                                        </td>
                        
                                        <td>${video.views_count}</td>
                        
                                        <td class="status -${video.status.name}">${video.status.name}</td>
                        
                                        <td>
                                            <button class="main-button -orange more-info-video" type="button" data-modal="editVideo">
                                                Mais informações

                                                <div class="loader-wrapper">
                                                    <img src="${APP_PATH}/assets/images/loaders/loader_button.gif">
                                                </div>
                                            </button>
                                        </td>
                                    </tr>
                                
                                `;
                    }).join('')}
                        </table>
                    `);

                } else {

                    $('.main-content.-videos .videos-wrapper').html(`<p class="main-small-message" style="text-align: left">Pô, nos contaram que tu ainda não publicou nenhum vídeo, tá moscando? Clica no botão ae vei</p>`);

                }


            }
        });

    }

    // Modal de Upload de Vídeos
    $('.main-modal.-upload .modal-content .input-send-video').change(function () {

        const maxAllowedSize = 1 * 1024 * 1024 * 1024;

        const videoSize = $(this)[0].files[0].size;

        if (videoSize < maxAllowedSize) {

            $('.main-modal.-upload .modal-content .send-video-wrapper').hide();

            $('.main-modal.-upload .modal-content .final-info-wrapper').css('display', 'grid');

            $('.main-modal.-upload progress').val(50);

        } else {

            openFlashMessage('Aceitamos vídeos com no máximo 1GB', 'info');

        }


    });

    $('.upload-video-wrapper').submit(function (event) {

        openLoaderButton($('#send-video-button'));

        event.preventDefault();

        let filledFields = true;

        const textInputs = $('.upload-video-wrapper .final-info-wrapper input[type="text"]');

        const fileInputs = $('.upload-video-wrapper input[type="file"]');

        textInputs.each(function () {

            if ($(this).val() == '') {

                filledFields = false;
            }

        });

        fileInputs.each(function () {

            if ($(this)[0].files.length == 0) {

                filledFields = false;
            }

        });

        if (!filledFields) {

            openFlashMessage('Preenche tudo certinho aí, maninho', 'alert');

            closeLoaderButton($('#send-video-button'));

            return false;

        }

        let formData = new FormData($('.upload-video-wrapper')[0]);

        $.ajax({
            url: `${API_PATH}/video/create`,
            method: 'POST',
            type: 'POST',
            data: formData,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: (data) => {

                if (data.response) {

                    reloadVideos();

                    $('.upload-video-wrapper .final-info-wrapper').hide();
                    $('.upload-video-wrapper .email-message-sent').css('display', 'flex');
                    $('.upload-video-wrapper .email-message-sent').addClass('smoothAnimation');

                    $('.main-modal.-upload progress').val(100);

                    closeLoaderButton($('#send-video-button'));

                } else if (!data.response && data.error) {

                    openFlashMessage(data.error, 'alert');

                    closeLoaderButton($('#send-video-button'));

                }
            }
        });

    });

    $('.main-modal.-upload .modal-exit').click(function () {

        clearTimeout(timeout);

        $('.main-modal.-upload .modal-title h2 > span').removeClass('active');
        $('.main-modal.-upload .modal-content .final-info-wrapper').hide();
        $('.upload-video-wrapper .email-message-sent').hide();
        $('.main-modal.-upload .modal-content .send-video-wrapper').css('display', 'flex');

        $('.upload-video-wrapper .final-info-wrapper input, .upload-video-wrapper .final-info-wrapper textarea').val('');
        $('.upload-video-wrapper .send-video-wrapper input').val('');

        $('.upload-video-wrapper .final-info-wrapper #thumbnail-picture').attr('src', `${PUBLIC_PATH}/images/icons/select_thumbnail.png`);
        $('.upload-video-wrapper .final-info-wrapper #thumbnail-picture').css('border', 'none');

        $('.main-modal.-upload progress').val(0);

    });

    // Reader Thumbnail
    $('.modal-content.-upload form .final-info-wrapper #thumbnail-create').change(function () {

        readerImage($('.modal-content.-upload form .final-info-wrapper img')[0], this);

        $('.modal-content.-upload form .final-info-wrapper img').css('border', '1px solid #e8e8e8');
    });

    $('body').on('click', '.videos-wrapper .more-info-video', function () {

        const videoId = $(this).parents('tr').data('video');

        openLoader();

        $.ajax({
            url: `${API_PATH}/video/${videoId}`,
            type: 'GET',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: (data) => {

                videoInfos.id = data.id;

                videoInfos.title = data.title;

                videoInfos.description = data.description;

                videoInfos.thumbnail = `${PUBLIC_PATH}/images/thumbnails/${data.thumbnail}`;

                closeLoader();

                modalAction($('.main-modal.-editVideo'), 'show');

                const editVideoModal = $('.modal-content.-editVideo');

                // Atualiza os Inputs do vídeo
                editVideoModal.find('#editing-title').val(data.title);

                editVideoModal.find('#editing-description').val(data.description);

                editVideoModal.find('.main-edit-image img').attr('src', `${PUBLIC_PATH}/images/thumbnails/${data.thumbnail}?${Math.random()}`);

                // Gera os botões de ações
                editVideoModal.find('.actions-element').html(``);

                editVideoModal.find('.actions-element').append(function () {

                    if (data.status_id == 1 || data.status_id == 3) {

                        return `<button class="main-button -orange" type="button" id="deprive-video-button">
                            Privar vídeo <i class="fa-solid fa-lock"></i>

                            <div class="loader-wrapper">
                                <img src="${APP_PATH}/assets/images/loaders/loader_button.gif">
                            </div>
                        </button>`;

                    } else if (data.status_id == 2) {

                        return `<button class="main-button -orange" type="button" id="publish-video-button">
                            Publicar vídeo <i class="fa-solid fa-circle-check"></i>

                            <div class="loader-wrapper">
                                <img src="${APP_PATH}/assets/images/loaders/loader_button.gif">
                            </div>
                        </button>`;

                    }

                });

                editVideoModal.find('.actions-element').append(`<button class="main-button -orange" type="button" id="delete-video-button">

                    Remover vídeo <i class="fa-solid fa-trash-can"></i>

                    <div class="loader-wrapper">
                        <img src="${APP_PATH}/assets/images/loaders/loader_button.gif">
                    </div>

                </button>`);
            }
        });

    });

    $('.main-modal.-editVideo .modal-exit').click(function () {

        $('.main-modal.-editVideo .infos-wrapper .actions-button-wrapper').hide();

    });

    const validateInfoFields = () => {

        const thumbnail = $('.main-modal.-editVideo .infos-wrapper #editing-thumbnail')[0].files.length;

        const title = $('.main-modal.-editVideo .infos-wrapper #editing-title').val();

        const description = $('.main-modal.-editVideo .infos-wrapper #editing-description').val();

        if (title == videoInfos.title && description == videoInfos.description && thumbnail == 0) {

            $('.main-modal.-editVideo .infos-wrapper .actions-button-wrapper').hide();

        } else {

            $('.main-modal.-editVideo .infos-wrapper .actions-button-wrapper').css('display', 'flex');

        }

    };

    $('.main-modal.-editVideo .infos-wrapper').find('input, textarea').change(validateInfoFields).keyup(validateInfoFields);

    $('.main-modal.-editVideo .infos-wrapper .actions-button-wrapper .save').click(function () {

        $('.main-modal.-editVideo .infos-wrapper .actions-button-wrapper').hide();

        const formData = new FormData();

        formData.append('title', $('.main-modal.-editVideo .infos-wrapper #editing-title').val());

        formData.append('description', $('.main-modal.-editVideo .infos-wrapper #editing-description').val());

        formData.append('thumbnail', $('.main-modal.-editVideo .infos-wrapper #editing-thumbnail')[0].files[0] ?? '');

        formData.append('id', videoInfos.id);

        $.ajax({
            url: `${API_PATH}/video/update`,
            method: 'POST',
            dataType: 'JSON',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {

                reloadVideos();

                $('.main-modal.-editVideo .infos-wrapper #editing-thumbnail').val('');

                data.response ? openFlashMessage(data.message, 'success') : openFlashMessage(data.message, 'error');

                videoInfos.title = $('.main-modal.-editVideo .infos-wrapper #editing-title').val();

                videoInfos.description = $('.main-modal.-editVideo .infos-wrapper #editing-description').val();

                videoInfos.thumbnail = $('.main-modal.-editVideo .infos-wrapper .main-edit-image img').attr('src');

            }
        });

    });

    $('.main-modal.-editVideo .infos-wrapper .actions-button-wrapper .discart').click(function () {

        $('.main-modal.-editVideo .infos-wrapper #editing-thumbnail').val('');

        $('.main-modal.-editVideo .infos-wrapper #editing-title').val(videoInfos.title);

        $('.main-modal.-editVideo .infos-wrapper #editing-description').val(videoInfos.description);

        $('.main-modal.-editVideo .infos-wrapper .main-edit-image img').attr('src', videoInfos.thumbnail);

        $('.main-modal.-editVideo .infos-wrapper .actions-button-wrapper').hide();

    });

    $('body').on('click', '.main-modal.-editVideo .actions-wrapper #deprive-video-button', function () {

        openLoaderButton($(this));

        $.ajax({
            url: `${API_PATH}/video/updateStatus/2`,
            method: 'POST',
            dataType: 'JSON',
            data: {
                "video_id": videoInfos.id
            },
            success: function (data) {

                closeLoaderButton($(this));

                reloadVideos();

                $('.main-modal.-editVideo').hide();

                openFlashMessage('Não gostei da ideia de privar o vídeo, mas tudo bem né...', 'alert');

            }
        });

    });

    $('body').on('click', '.main-modal.-editVideo .actions-wrapper #publish-video-button', function () {

        openLoaderButton($(this));

        $.ajax({
            url: `${API_PATH}/video/updateStatus/3`,
            method: 'POST',
            dataType: 'JSON',
            data: {
                "video_id": videoInfos.id
            },
            success: function (data) {

                closeLoaderButton($(this));

                reloadVideos();

                $('.main-modal.-editVideo').hide();

                openFlashMessage('Boooooa! Agora sim eu curti sua ideia, gg demais', 'success');

            }
        });

    });

    $('body').on('click', '.main-modal.-editVideo .actions-wrapper #delete-video-button', function () {

        openLoaderButton($(this));

        return false;

        $.ajax({
            url: `${API_PATH}/video/delete`,
            method: 'POST',
            dataType: 'JSON',
            data: {
                "id": videoInfos.id
            },
            success: function (data) {

                closeLoaderButton($(this));

                reloadVideos();

                openFlashMessage('Nah, seu vídeo foi deletado com sucesso, fazer oq né...', 'success');

                modalAction($('.main-modal.-editVideo'), 'close');

            }
        });

    });

});