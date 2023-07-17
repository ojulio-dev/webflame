@if (!isset($link)) 

    <button 
        class="main-button -{{$color ?? 'orange'}} {{$classes ?? ''}}" 

        type="{{$type ?? 'button'}}"

        @if (isset($id)) 
            id="{{$id}}"
        @endif

        @if (isset($modal))
            data-modal="{{$modal}}"
        @endif

        {!! $dataAttribute ?? '' !!}
    >
        {{$text}}
    </button>

@else

    <a href="{{$link}}"

        class="main-button -{{$color ?? 'orange'}}" 

        type="{{$type ?? 'button'}}"

        @if (isset($id)) 
            id="{{$id}}"
        @endif

        @if (isset($modal))
            data-modal="{{$modal}}"
        @endif
    >
        {{$text}}
    </a>
    
@endif