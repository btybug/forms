<div class="row">
    <div class="col-md-6">
        <label class="col-md-3">Field Name</label>
        <div class="col-md-9">
            {!! Form::text('name',null,['class' => 'form-control ']) !!}
        </div>
    </div>
</div>
<div class="row  visibility-box">
    <div class="panel panel-default p-0">
        <div class="panel-heading">Input Setting</div>
        <div class="panel-body">
            <div class="form-group col-md-12 m-b-10">
                <div class="col-md-6">
                    <label for="lablename" class="col-sm-3 p-l-0 control-label m-0  text-left">Label
                        name</label>
                    <div class="col-sm-8">
                        {!! Form::text('label',null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="placeholder" class="col-sm-3 control-label m-0 text-left ">Placeholder</label>
                    <div class="col-sm-8">
                        {!! Form::text('placeholder',null,['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group col-md-12 m-b-10">
                <div class="col-md-6">
                    <label for="fieldicon" class="col-sm-3 p-l-0 control-label m-0 text-left">Field Icon</label>
                    <div class="col-sm-8">
                        {!!Form::text('icon',null,['class' => 'form-control icp','readonly'])  !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="tooltip-icon" class="col-sm-3 m-0 control-label text-left">Tooltip Icon</label>
                    <div class="col-sm-8">
                        {!!Form::text('tooltip_icon',null,['class' => 'form-control icp','readonly','id'=>'tooltip-icon'])  !!}

                    </div>
                </div>

            </div>
            <div class="form-group col-md-12 m-b-10">
                <div class="col-md-6">
                    <label for="help" class="col-sm-3 m-0 control-label text-left">help</label>
                    <div class="col-sm-8">
                        {!! Form::textarea('help',null,['class'=>'form-control','id'=>'help']) !!}
                    </div>
                </div>

                <div class="form-group col-md-6 m-b-10">
                    <label  for='validation_message' class="col-sm-3 m-0 control-label text-left">Error Message</label>
                    <div class="col-sm-8">
                        {!! Form::textarea('validation_message',null,['class' => 'form-control','id'=>'validation_message']) !!}
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<div class="row  visibility-box">
    <div class="panel panel-default p-0">
        <div class="panel-heading">Text input source</div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-3 p-l-0" for="default_value_field">Default value</label>
                <div class="col-md-6">
                    {!! Form::text('default_value',null,['class' => 'form-control','placeholder' => 'Enter default value','id' => 'default_value_field']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row  visibility-box">
    <div class="panel panel-default p-0">
        <div class="panel-heading">Validation</div>
        <div class="panel-body">
            <div class="form-group col-md-12">
                <div class="col-md-6">
                    <label class="col-sm-3 p-l-0">Required</label>
                    <div class="col-md-6">
                        {!! Form::select('required',['No', 'Yes'],null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
    </div>
</div>