<button 
    class="main-button -{{$color ?? 'orange'}}" 

    type="{{$type ?? 'button'}}"

    @if (isset($id)) 
        id="{{$id}}"
    @endif

    @if (isset($modal))
        data-modal="-{{$modal}}"
    @endif
>
    {{$text}}
</button>