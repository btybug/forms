<div class="bty-more-select">
    <div>
        <label>{!! $field['label'] !!}</label>
    </div>
    <div>
        <div class="bty-new-select">
            {!! Form::select($field['column_name'],get_field_data($field['id']),null,['placeholder' => $field['placeholder']]) !!}
        </div>
    </div>
    <div>
        <p>Lorem ipsum Lorem ipsum ipsum</p>
        <span><i class="fa fa-question" aria-hidden="true"></i></span>
    </div>
</div>