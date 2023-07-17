<div class="main-videos-wrapper">
    @if (isset($showTitle))

        <h4>8 resultados de vídeos</h4>

    @endif

    <ul>
        @foreach($videos as $video)
            <li class="element-video">
                <a href="{{route('watch')}}">
                    <div class="thumbnail-wrapper">
                        <img class="video-content" src="{{asset('assets/images/thumbnails/' . $video['thumbnail'] )}}" alt="Thumbnail do Vídeo">
        
                        <video class="video-content" loop="true" muted>
                            <source src="{{asset('assets/videos/video.mp4')}}">
                        </video>
                    </div>
        
                    <div class="icon-info-wrapper">
                        @include('components.userIcon', [
                            'size' => '30px'
                        ])
        
                        <div class="info-title-wrapper">
                            <h3 title="{{$video['title']}}">{{$video['title']}}</h3>
        
                            <div class="info-wrapper">
                                <small>{{$video['canalName']}}</small>
        
                                <small>há {{$video['timeStamp']}}</small>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
</div>