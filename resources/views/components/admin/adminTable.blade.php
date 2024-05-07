<div class="main-admin-table">
    <table>
        <tbody>{{$slot}}</tbody>
    </table>

    <div class="action-buttons">

        <i class="fa-solid fa-chevron-up disabled" data-action="less"></i>

        <i class="fa-solid fa-chevron-down {{$totalItems <= 5 ? 'disabled' : ''}}" data-action="more"></i>

    </div>
</div>