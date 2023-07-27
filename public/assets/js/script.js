const loaderAction = (action) => {

    if (action == 'show') {

        $('.component-loader').show();

    } else {

        $('.component-loader').hide();

    }

}

const readerImage = (userImage, imageInput) => {

    if (imageInput.files.length) {

        const reader = new FileReader();

        reader.readAsDataURL(imageInput.files[0]);

        reader.onload = () => {

            userImage.src = reader.result;
            
        }
    }

}

$(document).ready(function() {

    const request = [
        {"video_title": "Spy Kids: All the Time in the World in 4D"}, 
        {"video_title": "Yukirito jogando hg"}, 
        {"video_title": "Yukirito fazendo alguma coisa"}, 
        {"video_title": "Um vídeo qualquer"}, 
        {"video_title": "Yukirito da like"},
        {
        "video_title": "Mudhoney"
        }, {
        "video_title": "Push"
        }, {
        "video_title": "Dirties, The"
        }, {
        "video_title": "Cinderella II: Dreams Come True"
        }, {
        "video_title": "Possible Loves (Amores Possíveis)"
        }, {
        "video_title": "Strip-tease"
        }, {
        "video_title": "Con, The"
        }, {
        "video_title": "Ice Cream Man"
        }, {
        "video_title": "Rolling Family (Familia rodante)"
        }, {
        "video_title": "Cape Fear"
        }, {
        "video_title": "Tank Girl"
        }, {
        "video_title": "Salomè"
        }, {
        "video_title": "Redemption: For Robbing the Dead"
        }, {
        "video_title": "My Girl 2"
        }, {
        "video_title": "Land of Plenty (Angst and Alienation in America)"
        }, {
        "video_title": "City Heat"
        }, {
        "video_title": "Last Days in the Desert"
        }, {
        "video_title": "8MM 2"
        }, {
        "video_title": "Listen to Britain"
        }, {
        "video_title": "Move Over, Darling"
        }, {
        "video_title": "Pierrot le fou"
        }, {
        "video_title": "Beauty Day"
        }, {
        "video_title": "Shining Through"
        }, {
        "video_title": "Last of the Mohicans, The"
        }, {
        "video_title": "Back in the Saddle (Back in the Saddle Again)"
        }, {
        "video_title": "Blue Week (Sininen viikko)"
        }, {
        "video_title": "Saragossa Manuscript, The (Rekopis znaleziony w Saragossie)"
        }, {
        "video_title": "Sudden Wealth of the Poor People of Kombach, The (Der plötzliche Reichtum der armen Leute von Kombach)"
        }, {
        "video_title": "Town Called Hell, A"
        }, {
        "video_title": "Ice Princess"
        }, {
        "video_title": "Article 99"
        }, {
        "video_title": "Honey, I Blew Up the Kid"
        }, {
        "video_title": "Stuart Little 3: Call of the Wild"
        }, {
        "video_title": "Welcome to the Space Show (Uchû shô e yôkoso)"
        }, {
        "video_title": "Walking Dead, The"
        }, {
        "video_title": "13th Letter, The"
        }, {
        "video_title": "Tart"
        }, {
        "video_title": "Rush: Beyond the Lighted Stage"
        }, {
        "video_title": "Thirty-Nine Steps, The"
        }, {
        "video_title": "Zoot Suit"
        }, {
        "video_title": "Liar's Dice"
        }, {
        "video_title": "Blue Crush"
        }, {
        "video_title": "Pianist, The"
        }, {
        "video_title": "Magnificent Bodyguards (Fei du juan yun shan)"
        }, {
        "video_title": "Saint Joan"
        }, {
        "video_title": "99 and 44/100% Dead"
        }, {
        "video_title": "Super Rich: The Greed Game"
        }, {
        "video_title": "Last Elvis, The (Último Elvis, El)"
        }, {
        "video_title": "Wackness, The"
        }, {
        "video_title": " Days of Summer"
        }, {
        "video_title": "And So It Goes"
        }, {
        "video_title": "Bernard and Doris"
        }, {
        "video_title": "Forty Guns"
        }, {
        "video_title": "Places in the Heart"
        }, {
        "video_title": "Gandhi"
        }, {
        "video_title": "Theory of Everything, The"
        }, {
        "video_title": "Berlin Is in Germany"
        }, {
        "video_title": "Sword of Doom, The (Dai-bosatsu tôge)"
        }, {
        "video_title": "Butterfield 8"
        }, {
        "video_title": "Next Best Thing, The"
        }, {
        "video_title": "Zipper"
        }, {
        "video_title": "Comes a Bright Day"
        }, {
        "video_title": "Fun in Acapulco"
        }, {
        "video_title": "Tenebre"
        }, {
        "video_title": "Screamtime"
        }, {
        "video_title": "Bullfighter and the Lady"
        }, {
        "video_title": "Capote"
        }, {
        "video_title": "Sink the Bismark!"
        }, {
        "video_title": "Love Lasts Three Years (L'amour dure trois ans)"
        }, {
        "video_title": "Tyler Perry's The Single Moms Club"
        }, {
        "video_title": "Mystery of the Yellow Room, The (Mystère de la chambre jaune, Le)"
        }, {
        "video_title": "Ugly"
        }, {
        "video_title": "China Syndrome, The"
        }, {
        "video_title": "Money Money Money (L'aventure, c'est l'aventure)"
        }
    ];

    let timeout;

    $('#main-header .search-and-avatar .search-wrapper input[type=search]').keyup(function() {
        clearTimeout(timeout);

        const value = $(this).val().toLowerCase();

        const resultsWrapper = $('#main-header .search-and-avatar .search-wrapper .results');

        if (value) {

            timeout = setTimeout(function() {

                // Utilizar a função filter para montar um array com os resultados
                const results = request.filter((search) => search.video_title.toLowerCase().startsWith(value));

                // Montamos um array de li's
                const resultsHTML = results.map(function(result) {

                    return `<li>${result.video_title.toLowerCase()}</li>`;

                });

                // Inserimos o array dentro do elemento DOM
                resultsWrapper.html(resultsHTML);

                resultsWrapper.toggle(results.length > 0);

            }, 50);

        } else {

            $('#main-header .search-and-avatar .search-wrapper .results').hide();

        }
    });

    $('#main-header .search-and-avatar .avatar-wrapper img').click(function() {

        $('#main-header .search-and-avatar nav').toggle();

    });

});