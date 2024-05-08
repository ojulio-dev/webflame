$(document).ready(function() {

    $('body').on('click', '.main-admin-table .main-button.reported-users-modal', function() {

        const reportedId = $(this).data('id');

        const reportedUserModal = $('.main-modal.-reportedUsers .modal-content');

        const clickedButton = this;

        openLoaderButton(clickedButton);

        $.ajax({
            url: `${API_PATH}/reportedUsers/${reportedId}`,
            method: 'GET',
            dataType: 'JSON',
            success: function(data) {

                reportedUserModal.find('.users-section.-reportingUser img').attr('src', `${PUBLIC_PATH}/assets/images/users/${data.reporting_user.icon}`);

                reportedUserModal.find('.users-section.-reportingUser h3').html(`${data.reporting_user.name} <a href="${PUBLIC_PATH}user/@${data.reporting_user.username}">@${data.reporting_user.username}</a>`);

                reportedUserModal.find('.users-section.-reportingUser .main-info-wrapper p').html(data.reason);

                reportedUserModal.find('.users-section.-reportedUser img').attr('src', `${PUBLIC_PATH}/assets/images/users/${data.reported_user.icon}`);

                reportedUserModal.find('.users-section.-reportedUser h3').html(`${data.reported_user.name} <a href="${PUBLIC_PATH}user/@${data.reported_user.username}">@${data.reported_user.username}</a>`);

                reportedUserModal.find('.users-section.-reportedUser .main-info-wrapper p').html(data.reported_user.description ?? 'Canal sem descrição');

                $('.main-modal.-reportedUsers').data('reported-id', data.id);

                modalAction($('.main-modal.-reportedUsers'), 'show');

                closeLoaderButton(clickedButton);

            }
        });

    });

    const reportedUsersFilter = () => {

        $.ajax({
            url: `${API_PATH}/reportedUsers`,
            method: 'GET',
            dataType: 'JSON',
            success: function(data) {

                const reportedUsersTable = $('.main-section.-reportedUsers .main-admin-table tbody');

                reportedUsersTable.html(`
                
                    ${data.map(function(reportedUser) {

                        return `
                        
                        <tr>
                            <td>
                                <img src="${PUBLIC_PATH}/assets/images/users/${reportedUser.reported_user.icon}" alt="Ícone do Usuário">
                            </td>
            
                            <td>${reportedUser.reported_user.name}</td>
            
                            <td>${reportedUser.reported_user.videos.length} vídeos</td>
            
                            <td>${reportedUser.reported_user.subscribers.length} inscritos</td>
            
                            <td>
                                <button class="main-button -orange reported-users-modal" type="button" data-modal="reportedUsers" data-id="${reportedUser.id}">
                                    Verificar
            
                                    <div class="loader-wrapper">
                                        <img src="${APP_PATH}/assets/images/loaders/loader_button.gif">
                                    </div>
            
                                </button>
                            </td>
                        </tr>
                        
                        `;
                    })}

                `);

            }
        });

    }

    $('.main-modal.-reportedUsers .buttons-wrapper button').click(function() {

        const reportedId = $('.main-modal.-reportedUsers').data('reported-id');

        if ($(this).data('action') == 'ban') {

            Swal.fire({
                title: 'Banir usuário?',
                text: 'Se possível, escreva o motivo',
                input: 'textarea',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showCancelButton: true,
                confirmButtonText: 'Banir',
                cancelButtonText: 'Cancelar',
                showLoaderOnConfirm: true
              }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: `${API_PATH}/reportedUsers/${reportedId}/removeUser`,
                        method: 'GET',
                        dataType: 'JSON',
                        success: function(data) {

                            if (data) {

                                reportedUsersFilter();

                                Swal.fire(
                                    'Feito!',
                                    `${data.reported_user.name} foi removido da nossa plataforma!`,
                                    'success'
                                );

                                modalAction($('.main-modal.-reportedUsers'), 'hide');

                            } else {

                                Swal.fire(
                                    'Eita...',
                                    'Infelizmente algo deu errado.',
                                    'error'
                                );

                            }

                        }
                    });

                }

            })

        } else {

            Swal.fire({
                title: 'Certeza?',
                text: "Tem certeza que esse usuário é limpo?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tenho',
                cancelButtonText: 'Não tenho'
              }).then((result) => {
                if (result.isConfirmed) {
                  
                    $.ajax({
                        url: `${API_PATH}/reportedUsers/${reportedId}/allowUser`,
                        method: 'GET',
                        dataType: 'JSON',
                        success: function(data) {

                            if (data) {

                                reportedUsersFilter();

                                Swal.fire(
                                    'Feito!',
                                    `${data.reported_user.name} continuará em nossa plataforma!`,
                                    'success'
                                );

                                modalAction($('.main-modal.-reportedUsers'), 'hide');


                            } else {

                                Swal.fire(
                                    'Eita...',
                                    'Infelizmente algo deu errado.',
                                    'error'
                                );

                            }

                        }
                    });

                }
            })

        }

    });

});