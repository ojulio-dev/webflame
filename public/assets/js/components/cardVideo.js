$(document).ready(function() {

    let timeout;

    $('.main-videos-wrapper li .thumbnail-wrapper').on({'mouseenter': function() {

        $(this).find('img').css({'top': '-8px', 'left': '8px'});

        $(this).find('video').css({'top': '-8px', 'left': '8px'});

        let video = $(this).find('video');
    
        timeout = setTimeout(function() {
    
            $(video).trigger('play');

            $(video).css({'display': 'block', 'z-index': 2});
    
        }, 900)
    
    }, 'mouseleave': function() {
        
        clearTimeout(timeout);

        $(this).find('img').css({'top': 0, 'left': 0});
        
        let video = $(this).find('video');

        $(video).css({'top': 0, 'left': 0, 'display': 'none'});

        $(video).trigger('pause');

        $(video).prop('currentTime', 0);
    
    }})

});