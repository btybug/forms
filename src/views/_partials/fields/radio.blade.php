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
        <div class="panel-heading">Radio input source</div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-xs-4 col-md-4 control-label" for="name">Data Source</label>
                <div class="col-xs-8 col-md-8">
                    <!-- check if Data source is data-source -->
                    {!! Form::select('data_source',[
                     ''=>'-- Select Data source --',
                     'manual'=>'Manual',
                     'api'=>'From api',
                     'related'=>'Related',
                     'bb'=>'BB Functions',
                     'file'=>'File'], null,['class'=>'form-control','id'=>'data_source']) !!}
                </div>
            </div>
            <div class="select_op_box">
                @if(isset($data['data_source']))
                    @if($data['data_source'] == 'manual')
                        <div class="form-group data_source_manual">
                            {!! Form::textarea('data_source_manual',null,['class' => 'form-control','id' => 'data_source_manual']) !!}
                        </div>
                    @endif
                    @if($data['data_source'] == 'related')
                        <div class="form-group data-source-box">
                            <label class="col-md-4 control-label" for="bbfunction">Select Table</label>
                            <div class="col-md-4">
                                {!! Form::select('data_source_table_name',['' => 'Select Table'] + BBGetTables(), null,['class' => 'form-control','id' => 'data_source_table_name']) !!}
                            </div>
                        </div>
                        @if(isset($data['data_source_table_name']) && count(BBGetTableColumn($data['data_source_table_name'])))
                            <div class="form-group columns_list">
                                <label class="col-md-4 control-label" for="bbfunction">Select Column</label>
                                <div class="col-md-4">
                                    {!! Form::select('data_source_columns',['' => 'Select Column'] + BBGetTableColumn($data['data_source_table_name']) , null,['class' => 'form-control','id' => 'table_column']) !!}
                                </div>
                            </div>
                        @endif
                    @endif

                    @if($data['data_source'] == 'api')
                        <div class="form-group data_source_api">
                            {!! Form::text('api',null,['class' => 'btn btn-warning btn-md input-md','id' => 'data_source_api','placeholder' => 'Put Api Url ...']) !!}
                        </div>
                    @endif

                    @if($data['data_source'] == 'bb')
                        <div class="form-group data-source-box">
                            <label class="col-md-4 control-label" for="bbfunction">Insert BB</label>
                            <div class="col-md-4">
                                {!! Form::text('bb',null,['class' => 'btn btn-warning btn-md input-md']) !!}
                            </div>
                        </div>
                    @endif

                    @if($data['data_source'] == 'file')
                        <div class="form-group">
                            <label class="col-xs-4 col-md-4 control-label" for="selectbasic">Files</label>
                            <div class="col-xs-8 col-md-8">
                                {!! BBbutton('file','file-unit','Select File',['class' => 'form-control input-md','data-type' => 'files','model' =>$data]) !!}
                            </div>
                        </div>
                    @endif
                @endif
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