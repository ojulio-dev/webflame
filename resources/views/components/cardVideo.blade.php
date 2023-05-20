<li>
    <div class="thumbnail-wrapper">
        <img class="video-content" src="{{asset('assets/images/thumbnails/' . $thumbnail )}}" alt="Thumbnail do Vídeo">

        <video class="video-content" loop="true" muted>
            <source src="{{asset('assets/videos/video.mp4')}}">
        </video>
    </div>

    <div class="icon-info-wrapper">
        <img src="{{asset('assets/images/users/' . ($canalIcon ?? 'a.jpg') )}}" alt="Ícone do Canal">

        <div class="info-title-wrapper">
            <h3 title="{{$title}}">{{$title}}</h3>

            <div class="info-wrapper">
                <small>{{$canalName}}</small>

                <small>há {{$timeStamp}}</small>
            </div>
        </div>
    </div>
</li>