<div class="bty-more-input-radio">
    <div>
        <label>{!! $field['label'] !!}</label>
    </div>
    <div>

        @if(count(get_field_data($field['id'])))
            @foreach(get_field_data($field['id']) as $key => $item)
                <div class="bty-new-input-radio">
                    <input name="{!! $field['column_name'] !!}"  value="{{ $key }}" type="radio" id="bty-new-gender-{{ $key }}">
                    <label for="bty-new-gender-{{ $key }}">{{ $item }}</label>
                </div>
            @endforeach
        @endif
    </div>
    <div>
        <p>Lorem ipsum Lorem</p>
        <span><i class="fa fa-question" aria-hidden="true"></i></span>
    </div>
</div>