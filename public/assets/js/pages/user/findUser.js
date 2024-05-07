$('.main-content.-findUser .section-content').hide();

$('.main-content.-findUser .section-content.-videos').show();

$(document).ready(function() {

    $('.main-content.-findUser nav ul li').click(function() {

        $('.main-content.-findUser nav li').removeClass('selected');

        const sectionItem = $(this);

        sectionItem.addClass('selected');

        $('.main-content.-findUser .section-content').hide();

        const sectionClicked = sectionItem.data('section');

        $(`.main-content.-findUser .section-content.-${sectionClicked}`).show();

    });

    $('.main-actions-menu #open-report-user-modal').click(function() {

        const reportedUser = $('.main-modal.-report-user #report-user-button').data('reported-user');

        const reportingUser = $('.main-modal.-report-user #report-user-button').data('reporting-user');

        $.ajax({
            url: `${API_PATH}/reports/user/${reportedUser}/${reportingUser}`,
            method: 'GET',
            dataType: 'JSON',
            success: function(data) {

                if (data.length) {

                    openFlashMessage('Calma lá parceiro, este canalzinho já está sendo investigado', 'alert');

                } else {

                    modalAction($('.main-modal.-report-user'), 'show');

                    hideCloseElements();

                }

            }

        });

    });

    $('.main-modal.-report-user #report-user-button').click(function() {

        const formData = new FormData();

        formData.append('reporting-user-id', $(this).data('reporting-user'));

        formData.append('reported-user-id', $(this).data('reported-user'));

        formData.append('reason', $('.main-modal.-report-user #report-user-reason').val());

        $.ajax({
            url: `${API_PATH}/reports/user`,
            method: 'POST',
            dataType: 'JSON',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {

                if (data.response) {

                    openFlashMessage(data.message, 'success');

                    modalAction($('.main-modal.-report-user'), 'hide');

                } else {

                    openFlashMessage(data.message, 'alert');

                }

            }

        });

    });

    $('#button-subscriber').click(function() {

        subscriberAction($(this));

    });

});