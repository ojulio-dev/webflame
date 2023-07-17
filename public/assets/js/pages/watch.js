$(document).ready(function() {

    const player = new Plyr('.player', {
        controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'settings', 'fullscreen']
    });

    // $('body').on('keydown', '#send-comment', function(e) {

    //     if (e.which == 13) {
            
    //         const heightElement = parseInt($(this).css('height'), 10);
    
    //         $(this).css('height', `${heightElement + 19}px`);
    
    //         console.log(heightElement);
    //     } else if (e.which == 8) {
    
    //         ...
    
    //     }
    
    // });

    $('#description-button').click(function() {

        const modalName = $(this).data('modal');

        modalAction(modalName, 'show');

    });
});