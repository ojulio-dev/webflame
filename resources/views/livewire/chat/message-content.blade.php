<div class="message-content">

    <div class="header">
        <div class="icon-wrapper">

            @include('components.userIcon', [
                'size' => '75px',
                'source' => 'https://i.pinimg.com/736x/d6/0b/60/d60b60df9147a88c660bc1452385c3a7.jpg'
            ])
            
        </div>

        <div class="infos-wrapper">
            <h4>Gutsu</h4>
        </div>
    </div>

    <ul class="messages-wrapper">

        <li class="-sent">

            @include('components.userIcon', [

                'size' => '35px',
                'source' => asset('assets/images/users/' . $globalDataUser['icon'])

            ])

            <div class="message-wrapper">
                
                <p>Oi</p>

                <small>14:19</small>

            </div>

        </li>

        <li class="-received">

            @include('components.userIcon', [

                'size' => '35px',
                'source' => 'https://i.pinimg.com/736x/d6/0b/60/d60b60df9147a88c660bc1452385c3a7.jpg'

            ])

            <div class="message-wrapper">
                
                <p>Olá</p>

                <small>14:19</small>

            </div>

        </li>

        <li class="-sent">

            @include('components.userIcon', [

                'size' => '35px',
                'source' => asset('assets/images/users/' . $globalDataUser['icon'])

            ])

            <div class="message-wrapper">
                
                <p>Tudo bem?</p>

                <small>14:19</small>

            </div>

        </li>

        <li class="-received">

            @include('components.userIcon', [

                'size' => '35px',
                'source' => 'https://i.pinimg.com/736x/d6/0b/60/d60b60df9147a88c660bc1452385c3a7.jpg'

            ])

            <div class="message-wrapper">
                
                <p>Tudo bem e você?</p>

                <small>14:19</small>

            </div>

        </li>

        <li class="-sent">

            @include('components.userIcon', [

                'size' => '35px',
                'source' => asset('assets/images/users/' . $globalDataUser['icon'])

            ])

            <div class="message-wrapper">
                
                <p>Que bom, estou bem também</p>

                <small>14:19</small>

            </div>

        </li>
        
        <li class="-received">

            @include('components.userIcon', [

                'size' => '35px',
                'source' => 'https://i.pinimg.com/736x/d6/0b/60/d60b60df9147a88c660bc1452385c3a7.jpg'

            ])

            <div class="message-wrapper">
                
                <p>kkkkkkkkkkkkkj sai fora</p>

                <small>14:19</small>

            </div>

        </li>

    </ul>

    <div class="send-message-wrapper">

        <div class="send-comment">
            @include('components.userIcon', [
                'size' => '45px',
                'source' => asset('assets/images/users/' . $globalDataUser['icon'])
            ])

        <form class="input-wrapper">
            <input name="comment" id="comment" placeholder="Envia algo legal...">

            <button class="send-icon">
                <img src="{{asset('assets/images/icons/send.png')}}" alt="Send Icon">
            </button>
        </form>
    </div>

</div>