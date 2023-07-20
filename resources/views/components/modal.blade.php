<div class="main-modal -{{$modalName}}">
    <div class="modal-exit"></div>

    <div class="modal-items">
        <div class="modal-title">
            <h2>{{$title}}</h2>

            @if (isset($progress) && $progress == 'true') <progress value="0" max="100"></progress> @endif
        </div>

        <div class="modal-content -{{$modalName}}">{{$slot}}</div>
    </div>
</div>