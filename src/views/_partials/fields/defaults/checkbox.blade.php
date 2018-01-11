<div class="bty-more-input-checkbox">
    <div>
        <label>{!! $data['label'] !!}</label>
    </div>
    <div>
        @if(count(get_field_data_preview($data)))
            @foreach(get_field_data_preview($data) as $key => $item)
                <div class="bty-new-input-checkbox">
                    <input name="{!! $data['name'] !!}" value="{{ $key }}" type="checkbox" id="bty-new-cbox-{{ $key }}">
                    <label for="bty-new-cbox-{{ $key }}">{{ $item }}</label>
                </div>
            @endforeach
        @else
            <div class="bty-new-input-checkbox">
                <input name="{!! $data['name'] !!}" value="default" type="checkbox" id="bty-new-cbox-default">
                <label for="bty-new-cbox-default">default</label>
            </div>
        @endif
    </div>
    <div>
        <p>{!! $data['help'] !!}</p>
        <span><i class="fa {!! $data['tooltip_icon'] or 'fa-question' !!}" aria-hidden="true"></i></span>
    </div>
</div>