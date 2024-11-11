$(document).ready(function() {

    const params = new URLSearchParams(window.location.search);

    const reloadComments = () => {

        $.ajax({

            url: `${API_PATH}/video/${params.get('video')}/comments`,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {

                $('.comment-element .comments').html(`<ul></ul>`);

                data.map(function(comment) {

                    $('.comment-element ul').append(`
                        <li>
                            <a href="${APP_PATH}/user/@${comment.user.username}">
                                <img class="main-user-icon" src="${APP_PATH}/assets/images/users/${comment.user.icon}" alt="Ícone de Usuário" style="width: 45px; height: 45px">
                            </a>

                            <div class="important-infos">
                                <div>
                                    <a href="${APP_PATH}/user/@${comment.user.username}">${comment.user.name} ${comment.user.id == comment.video.user.id ? '<span>(Author)</span>' : ''}</a>

                                    <small>${comment.dataDiff}</small>
                                </div>

                                <p>${comment.comment}</p>
                            </div>
                        </li>
                    `);
                });
            }
        });
    };

    // const reloadInteractions = () => {

    //     $.ajax({
    //         url: `${API_PATH}/video/${params.get('video')}/interactions`,
    //         type: 'GET',
    //         dataType: 'JSON',
    //         success: function(data) {

    //             data.map(function(interaction) {

    //                 let icon = $(`.feedback-and-subscribe .icons-wrapper > div[data-interaction-id=${interaction.id}]`);

    //                 icon.find('small').html(interaction.count);

    //             });

    //         }
    //     });

    // }

    // reloadInteractions();

    $('.comment-element .send-comment form').submit(function(event) {

        event.preventDefault();

        const formData = new FormData($(this)[0]);

        formData.append('video_id', params.get('video'));

        $.ajax({
            url: `${API_PATH}/comment/create`,
            type: 'POST',
            dataType: 'JSON',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {

                if (data.response) {

                    $('.comment-element .send-comment #comment').val('');

                    reloadComments();

                    openFlashMessage('Bom comentário hehe', 'success');

                } else {

                    openFlashMessage('Eita, algo deu errado...', 'error');

                }
            
            }
        });

    });

    $('.feedback-and-subscribe .icons-wrapper img').click(function() {
        
        const clickedElement = $(this).parent();

        const activeElement = $('.feedback-and-subscribe .icons-wrapper .active');

        const clickedElementNumber = $(this).siblings('small');

        const activeElementNumber = $('.feedback-and-subscribe .icons-wrapper .active').find('small');

        const userId = $('.feedback-and-subscribe .icons-wrapper').data('user-id');

        const interactionId = $(this).parent('div').data('interaction-id');

        if (clickedElement.hasClass('active')) {

            clickedElement.removeClass('active');

            clickedElementNumber.html(parseInt(clickedElementNumber.html()) - 1);

            $.ajax({
                url: `${API_PATH}/interaction/delete`,
                type: 'POST',
                dataType: 'JSON',
                data: {
                    video_id: params.get('video'),
                    user_id: userId,
                    interaction_id: interactionId
                },
                success: function(data) {
    
                    console.log(data);
    
                }
            });

        } else {

            activeElement.removeClass('active');

            clickedElement.addClass('active');

            clickedElementNumber.html(parseInt(clickedElementNumber.html()) + 1);

            activeElementNumber.html(parseInt(activeElementNumber.html()) - 1);

            $.ajax({
                url: `${API_PATH}/interaction/create`,
                type: 'POST',
                dataType: 'JSON',
                data: {
                    video_id: params.get('video'),
                    user_id: userId,
                    interaction_id: interactionId
                },
                success: function(data) {
    
                    console.log(data);
    
                }
            });
        }

    });

    $('.main-actions-menu .options #open-report-video-modal').click(function() {

        const videoId = $('.main-modal.-report-video #report-video-button').data('video-id');

        const userId = $('.main-modal.-report-video #report-video-button').data('reported-user');

        $.ajax({
            url: `${API_PATH}/reports/video/${videoId}/user/${userId}`,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {

                if (data.length) {

                    openFlashMessage('Este vídeo já está sendo investigado, parceiro. Relaxou aí', 'alert');

                } else {

                    hideCloseElements();

                    modalAction($('.main-modal.-report-video'), 'show');

                }

            }
            
        });

    });

    $('.main-modal.-report-video #report-video-button').click(function() {

        const formData = new FormData();

        for (const [key, value] of Object.entries($(this).data())) {
            
            formData.append(key, value);

        }

        formData.append('reason', $('#report-video-reason').val());

        $.ajax({
            url: `${API_PATH}/reports/video`,
            type: 'POST',
            dataType: 'JSON',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {

                if (!data.response) {

                    openFlashMessage(data.message, 'error');
                    
                    return false;

                }

                $('.main-modal.-report-video #report-video-reason').val('');

                modalAction($('.main-modal.-report-video'), 'hide');

                openFlashMessage(data.message, 'success');

            }
        });

    });

    $('#button-subscriber').click(function() {

        subscriberAction($(this));

    });
    
});