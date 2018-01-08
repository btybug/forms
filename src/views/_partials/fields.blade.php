{!! Form::open(['url'=>'/admin/blog/form-bulder/form-fields']) !!}
<div class="col-md-12" id="{!! $unit->slug !!}" style="border: 1px solid;padding: 10px;">
    <div class="col-md-6">
        {!! $unit->title !!}
    </div>
    <div class="col-md-6">
        <a class="btn btn-danger"><i class="fa fa-close"></i></a>
    </div>
    <div class="col-md-12">
        @if($fields && count($fields))
            @foreach($fields as $form_field)
                <div class="col-md-6">
                    {!! $form_field !!}
                </div>
                <div class="col-md-6">
                    <label>
                        Select Saving goal
                        {!! Form::select( 'form_field_settings['.$unit->slug.']'.'['.$form_field.']',$columns,null) !!}
                    </label>
                </div>
            @endforeach
        @else
            Invalid Unit
        @endif
    </div>
</div>
<div class="col-md-12">
            <div class="col-md-6">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
</div>
</div>
{!! Form::close() !!}