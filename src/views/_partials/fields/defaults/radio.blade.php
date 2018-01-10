<div class="bty-more-input-radio">
    <div>
        <label>{!! $data['label'] !!}</label>
    </div>
    <div>
        @if(count(get_field_data_preview($data)))
            @foreach(get_field_data_preview($data) as $key => $item)
                <div class="bty-new-input-radio">
                    <input name="{!! $data['name'] !!}"  value="{{ $key }}" type="radio" id="bty-new-gender-{{ $key }}">
                    <label for="bty-new-gender-{{ $key }}">{{ $item }}</label>
                </div>
            @endforeach
        @else
            <div class="bty-new-input-radio">
                <input name="{!! $data['name'] !!}"  value="default" type="radio" id="bty-new-gender-default">
                <label for="bty-new-gender-default">default</label>
            </div>
        @endif
    </div>
    <div>
        <p>{!! $data['help'] !!}</p>
        <span><i class="fa {!! $data['tooltip_icon'] or 'fa-question' !!}" aria-hidden="true"></i></span>
    </div>
</div>