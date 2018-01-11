<div class="bty-more-select">
    <div>
        <label>{!! $data['label'] !!}</label>
    </div>
    <div>
        <div class="bty-new-select">
            {!! Form::select($data['name'],get_field_data_preview($data),null,['placeholder' => $data['placeholder']]) !!}
        </div>
    </div>
    <div>
        <p> <p>{!! $data['help'] !!}</p>
        <span><i class="fa {!! $data['tooltip_icon'] or 'fa-question' !!}" aria-hidden="true"></i></span>
    </div>
</div>