const userInfos = {
    name: $('.infos-wrapper .user-info-field[name="name"]').val(),
    username: $('.infos-wrapper .user-info-field[name="username"]').val(),
    description: $('.infos-wrapper .user-info-field[name="description"]').val(),
    userIcon:  $('.infos-wrapper label[for="userIcon"] img').attr('src')
};

$(document).ready(function() {

    const validateFields = () => {
       
        const name = $('.infos-wrapper .user-info-field[name="name"]').val();

        const username = $('.infos-wrapper .user-info-field[name="username"]').val();

        const description = $('.infos-wrapper .user-info-field[name="description"]').val();

        const userIcon = $('.infos-wrapper .user-info-field[name="userIcon"]')[0].files.length;

        
        if (userInfos.name == name && userInfos.username == username && userInfos.description == description && userIcon == 0) {

            $('#form-user-infos .action-buttons-wrapper').hide();

        } else {

            $('#form-user-infos .action-buttons-wrapper').css('display', 'flex');

        };

    }

    $('.infos-wrapper .user-info-field').change(validateFields).keyup(validateFields);

    $('#form-user-infos .action-buttons-wrapper .save').click(function() {

        const formData = new FormData($('.main-content.-profile #form-user-infos')[0]);

        formData.append('icon', $('.infos-wrapper .main-edit-image #userIcon')[0].files[0] ?? '');

        $.ajax({
            url: `${API_PATH}/user/update`,
            method: 'POST',
            dataType: 'JSON',
            data: formData,
            processData: false,
            contentType: false,
            success: (data) => {

                if (data.response) {

                    $('#form-user-infos .action-buttons-wrapper').hide();

                    openFlashMessage(data.message, 'success')

                    $('.infos-wrapper #userIcon').val('');

                    userInfos.name = $('.infos-wrapper .user-info-field[name="name"]').val();

                    userInfos.username = $('.infos-wrapper .user-info-field[name="username"]').val();

                    userInfos.description = $('.infos-wrapper .user-info-field[name="description"]').val();

                    userInfos.userIcon =  $('.infos-wrapper label[for="userIcon"] img').attr('src');

                } else {

                    openFlashMessage(data.message, 'error');

                }

            }
        });

    });

    $('#form-user-infos .action-buttons-wrapper .discard').click(function() {
        
        $('.infos-wrapper .user-info-field[name="name"]').val(userInfos.name);

        $('.infos-wrapper .user-info-field[name="username"]').val(userInfos.username);

        $('.infos-wrapper .user-info-field[name="description"]').val(userInfos.description);

        $('.infos-wrapper label[for="userIcon"] img').attr('src', userInfos.userIcon);

        $('#form-user-infos .action-buttons-wrapper').hide();

    });

});