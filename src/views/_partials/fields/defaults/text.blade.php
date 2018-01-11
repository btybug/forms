<div class="bty-new-input-text">
    <input type="text" name="{!! $data['name'] !!}" placeholder="{!! $data['placeholder'] !!}">
    <label>{!! $data['label'] !!}</label>
    <span><i class="fa {!! $data['tooltip_icon'] or 'fa-question' !!}" aria-hidden="true"></i></span>
    <p>{{ $data['help'] }}</p>
</div>