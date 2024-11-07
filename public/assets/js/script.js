const readerImage = (userImage, imageInput) => {

    if (imageInput.files.length) {

        const reader = new FileReader();

        reader.readAsDataURL(imageInput.files[0]);

        reader.onload = () => {

            userImage.src = reader.result;
            
        }
    }

}

const subscriberAction = (button) => {

    const subscriberId = button.data('user-id');

    const channelId = button.data('channel-id');

    const totalSubscribers = button.data('total-subscribers');

    if (button.hasClass('-subscriber')) {

        button.removeClass('-subscriber');

        button.html('Inscrever-se');

        $('#total-user-subscribers span:nth-child(1)').html(totalSubscribers);

        $('#total-user-subscribers span:nth-child(2)').html(totalSubscribers == 1 ? 'inscrito' : 'inscritos');

        $.ajax({
            url: `${API_PATH}/subscribe/delete`,
            type: 'POST',
            dataType: 'JSON',
            data: {
                user_channel_id: channelId,
                user_subscriber_id: subscriberId
            }
        });

    } else {

        button.addClass('-subscriber');

        button.html('<i class="fa-solid fa-check"></i> Inscrito');

        $('#total-user-subscribers span:nth-child(1)').html(totalSubscribers + 1);

        $('#total-user-subscribers span:nth-child(2)').html((totalSubscribers + 1) == 1 ? 'inscrito' : 'inscritos');

        $.ajax({
            url: `${API_PATH}/subscribe/create`,
            type: 'POST',
            dataType: 'JSON',
            data: {
                user_channel_id: channelId,
                user_subscriber_id: subscriberId
            }
        });

    }

}

$(document).ready(function() {

    let timeout;

    $('#main-header .search-and-avatar .search-wrapper input[type=search]').keyup(function() {

        clearTimeout(timeout);

        const value = $(this).val().toLowerCase();

        const resultsWrapper = $('#main-header .search-and-avatar .search-wrapper .results');

        if (value) {

            timeout = setTimeout(function() {

                const result = fetch(`${API_PATH}/searchPreview`, {
                    method: 'POST',
                    body: JSON.stringify({
                        search: value
                    }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {

                    if (data.videos.length || data.users.length) {

                        showCloseElements();

                        const resultsUser = data.users.map(function(result) {

                            let value = result.value.toLowerCase();

                            return `<li><a href="${APP_PATH}/search?q=${value}"><i class="fa-solid fa-user"></i> ${value}</a></li>`;

                        }).join('');

                        const resultsVideo = data.videos.map(function(result) {

                            let value = result.value.toLowerCase();

                            return `<li><a href="${APP_PATH}/search?q=${value}"><i class="fa-solid fa-video"></i> ${value}</a></li>`;

                        }).join('');

                        const resultsHTML = resultsUser + resultsVideo;
                        
                        resultsWrapper.html(resultsHTML);

                        resultsWrapper.toggle((data.users.length > 0 || data.videos.length > 0));
                        
                    } else {

                        hideCloseElements();

                    }

                })

            }, 150);

        } else {

            $('#main-header .search-and-avatar .search-wrapper .results').hide();

            hideCloseElements();

        }
    });

    $('#main-header .search-and-avatar .avatar-wrapper > img').click(function() {

        $('#main-header .search-and-avatar nav').toggle();

        showCloseElements();

    });

    $('#main-header #navigation-menu-element li .modal-action').click(function() {

        console.log('oi');

        $('#main-header .search-and-avatar nav').toggle();

        modalAction($('.main-modal.-message-menu'), 'show');

    });

});