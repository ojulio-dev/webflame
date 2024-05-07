const openLoader = () => {

    var hasActiveScroll = document.documentElement.scrollHeight > document.documentElement.clientHeight;

    $('.main-loader').css('display', 'flex');

    $('#app-container').css('overflow', 'hidden');

    hasActiveScroll && $('#app-container').css('padding-right', '6px');

}

const closeLoader = () => {

    var hasActiveScroll = document.documentElement.scrollHeight > document.documentElement.clientHeight;

    $('.main-loader').hide();

    $('#app-container').css('overflow', 'auto');

    hasActiveScroll && $('#app-container').css('padding-right', '0');
    
}