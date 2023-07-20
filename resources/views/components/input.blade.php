<div class="main-input">
    @if (isset($title))
        <label for="{{$identifier}}">{{$title}}</label>
    @endif

    @if ($type == 'input')
    
        <input 
            type="{{$inputType}}" 

            @if (isset($placeholder)) placeholder="{{$placeholder}}" @endif 

            name="{{$identifier}}" 

            id="{{$identifier}}" 

            @if (isset($value)) value="{{$value}}" @endif
        >

    @elseif ($type == 'textarea')

        <div class="textarea-wrapper">
            <textarea @if (isset($placeholder)) placeholder="{{$placeholder}}" @endif name="{{$identifier}}" id="{{$identifier}}">{{$value ?? ''}}</textarea>
        </div>

    @endif
</div>