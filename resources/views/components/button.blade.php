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

        @if (isset($attributes) && count($attributes))

            @foreach ($attributes as $key => $value)

                data-{{$key}}="{{$value}}"

            @endforeach

        @endif

        style="{{isset($width) ? 'width:' . $width . '' : ''}}"
    >
        {{$text}}

        <div class="loader-wrapper">
            <img src="{{asset('assets/images/loaders/loader_button.gif')}}">
        </div>

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