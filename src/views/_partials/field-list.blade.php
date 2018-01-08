<div class="col-md-12" style="padding: 10px;">
    <div class="col-md-12">
        {!! Form::open(['id' => 'selected-fields']) !!}
        @if($fields && count($fields))
            @foreach($fields as $field)
                <label style="    display: block;">
                    <div class="col-md-4 field-item">
                        {!! $field->name !!}
                        {!! Form::checkbox('fields['.$field->id.']',1,null) !!}
                    </div>
                </label>
            @endforeach
        @else
            No Available Fields
        @endif
    </div>
</div>

<style>
    .field-item {
        height: 50px;
        border: 1px solid;
        padding: 3px;
        text-align: center;
        background: brown;
        color: white;
    }
</style>
