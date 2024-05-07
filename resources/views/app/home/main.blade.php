@extends('layouts.app', ['title' => 'Pagina Inicial', 'page' => 'home', 'search' => true])

@section('main')

    @if (count($videos))

        @include('components.cardVideo', ['videos' => $videos])

    @else
        
        @include('components.smallMessage', ['slot' => 'Ainda não possuimos vídeo em nossa plataforma...', 'align' => 'center'])

    @endif

@endsection

@section('scripts')

    <script src="{{asset('assets/js/components/cardVideo.js')}}"></script>

@endsection