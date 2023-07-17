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

    })

});