<div class="main-modal-videos -{{$name}}"

    @if (isset($attributes) && count($attributes))

        @foreach ($attributes as $key => $value)

            data-{{$key}}="{{$value}}"

        @endforeach

    @endif

>

    <div class="modal-close"></div>

    <div class="scroll-container">
        <div class="modal-wrapper">
            <div class="title-wrapper">
                <h2>{{$title}}</h2>

                <i class="fa-solid fa-xmark modal-close"></i>
            </div>

            <div class="main-content">{{$slot}}</div>
        </div>  
    </div>

</div>