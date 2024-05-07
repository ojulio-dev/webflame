@extends('layouts.app', ['title' => 'Pesquisa', 'page' => 'search', 'search' => true])

@section('head')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
@endsection

@section('main')
    
    @component('components.title')
    
        Resultados <i class="fa-solid fa-arrow-right"></i>

        @slot('secondaryContent') {{$_GET['q']}} @endslot
        
    @endcomponent

    @if (count($users))
        <div class="results-wrapper">
            <h4>{{count($users) . (count($users) == 1 ? ' resultado de usuário' : ' resultados de usuários')}}</h4>

            <ul class="owl-carousel">
                @foreach($users as $user)
                    <li class="element-profile">
                        <a href="{{route('findUser', ['username' => $user['username']])}}">
                            <img src="{{asset('assets/images/users/' . $user['icon'])}}" alt="Ícone do Canal">
                            <div class="infos-wrapper">
                                <h3>{{$user['name']}}</h3>
                            
                                <small>{{$user['subscribers'] . ($user['subscribers'] == 1 ? ' inscrito' : ' inscritos')}}</small>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (count($videos))
        <div class="results-wrapper">

            <h4>{{count($videos) . (count($videos) == 1 ? ' resultado de vídeo' : ' resultados de vídeos')}}</h4>

            @include('components.cardVideo', ['videos' => $videos])

        </div>
    @endif

    @if (!count($videos) && !count($users))

        <div class="not-found">

            <h4>A sua pesquisa não retornou resultados.</h4>

            @include('components.button', ['text' => 'Voltar à Home', 'link' => route('home')])
        </div>

    @endif

@endsection

@section('scripts')

<script src="{{asset('assets/js/components/cardVideo.js')}}"></script>

<script src="{{asset('assets/js/pages/home/search.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endsection