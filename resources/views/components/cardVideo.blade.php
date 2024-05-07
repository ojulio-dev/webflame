
<ul class="main-videos-wrapper">
    @foreach($videos as $video)
        <li class="element-video">
            <a href="{{route('watch', ['video' => $video['id']])}}">
                <div class="thumbnail-wrapper">
                    <img class="video-content" src="{{asset('assets/images/thumbnails/' . $video['thumbnail'] )}}" alt="Thumbnail do Vídeo">
    
                    <video class="video-content" loop="true" muted>
                        <source src="{{asset('assets/videos/' . $video['video'])}}">
                    </video>
                </div>
    
                <div class="icon-info-wrapper">
                    @include('components.userIcon', [
                        'size' => '30px',
                        'source' => asset('assets/images/users/' . $video['user']['icon'])
                    ])
    
                    <div class="info-title-wrapper">
                        <h3 title="{{$video['title']}}">{{$video['title']}}</h3>
    
                        <div class="info-wrapper">
                            <small>{{$video['user']['name']}}</small>
    
                            <small>{{$video['dataDifference']}}</small>
                        </div>
                    </div>
                </div>
            </a>
        </li>
    @endforeach
</ul>