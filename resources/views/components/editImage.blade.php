<div class="main-edit-image" style="width: {{$width}}; height: {{$height}}">
    <label for="{{$identifier}}">
        <img class="user-icon" src="{{$src ?? asset('assets/images/users/default.jpg')}}">
    </label>

    <input type="file" accept="image/*" @if (isset($classes)) class="{{$classes}}" @endif id="{{$identifier}}" name="{{$identifier}}">
</div>