@extends('forms::frontend.layouts.app')
@section('content')
    <div class="col-md-12 m-t-15">
        <h2>Create new {{ $slug }} field</h2>

        {!! Form::open(['route' => 'forms_save_field']) !!}
            {!! Form::hidden('field_type',$slug) !!}
            <div class="row">
                {!! Form::submit('Save',['class' => 'btn btn-success pull-right']) !!}
            </div>
            @include("forms::_partials.fields.".$slug)
        {!! Form::close() !!}
    </div>
@stop

@section('CSS')
    {!! HTML::style('public/css/bootstrap/css/bootstrap-switch.min.css') !!}
    {!! HTML::style('public/css/font-awesome/css/fontawesome-iconpicker.min.css') !!}
@stop
@section('JS')
    {!! HTML::script("public/js/UiElements/bb_styles.js?v.5") !!}
    {!! HTML::script('public/css/font-awesome/js/fontawesome-iconpicker.min.js') !!}
    <script>

        $('.icp').iconpicker();
        var dd = console.log;
        var activefieldtype = ''
        var htmlsdata = {default: '', custom: '', field: ''}

    </script>

    <script>
        $(document).ready(function () {
            $("body").on("change",".select-type", function () {
                var type = $(this).val();
                var id = "";
                sendajaxvar('/admin/console/structure/fields/mapping', {type:type,id:id}, function (d) {
                    if (d) {
                        $(".mapping-column").html(d.data);
                    }
                })
            });

            function dataSource() {
                $('.select_op_box').html('');
                var val = $('#data_source').val();
                var data_group = $('<div/>', {
                    "class": 'form-group data-source-box'
                });
                switch (val) {
                    case 'manual':
                        data_group = $('<div/>', {
                            class: 'form-group data_source_manual'
                        });
                        var textarea = $('<textarea/>', {
                            "class": 'form-control',
                            "type": 'textarea',
                            "id": 'data_source_manual',
                            "placeholder": 'Type options separated with ,',
                            "name": 'json_data_manual'
                        });

                        data_group.append(textarea);
                        $('.select_op_box').append(data_group);
                        break;
                    case 'file':
                        $('.file-box').remove();
//                        $("[data-key=some-unit]").attr('data-item', 'data_source');
                        //file functional
                        var data_group_label = $('<label/>', {
                            "class": 'col-md-4 control-label',
                            "for": 'selectbasic',
                            "text": 'Files'
                        });

                        data_group.append(data_group_label);

                        var data_group_col = $('<div/>', {
                            class: 'col-md-4'
                        });
                        data_group.append(data_group_col);
                        var data_group_BB_unit = $('<button/>', {
                            "class": 'btn btn-warning btn-md input-md BBbuttons',
                            "type": 'button',
                            "data-action": 'files',
                            "data-key": 'file-unit',
                            "data-type": "files",
                            "text": "Select File"
                        });

                        data_group_col.append(data_group_BB_unit);

                        var data_group_hidden = $('<input/>', {
                            "type": 'hidden',
                            "data-name": 'file-unit',
                            "name": 'json_data[file-unit]'
                        });

                        data_group_col.append(data_group_hidden);
                        $('.select_op_box').append(data_group);
                        break;
                    case 'bb':
                        $("[data-key=some-unit]").attr('data-item', 'data_source');
                        var data_group_label = $('<label/>', {
                            "class": 'col-md-4 control-label',
                            "for": 'bbfunction',
                            "text": 'Insert BB'
                        });

                        data_group.append(data_group_label);

                        var data_group_col = $('<div/>', {
                            class: 'col-md-4'
                        });
                        data_group.append(data_group_col);
                        var data_group_BB_input = $('<input/>', {
                            "class": 'form-control input-md',
                            "type": 'text',
                            "name": 'json_data_bb'
                        });

                        data_group_col.append(data_group_BB_input);
                        $('.select_op_box').append(data_group);
                        //bb functional
                        break;
                    case 'api':
                        $("[data-key=some-unit]").attr('data-item', 'data_source');
                        data_group = $('<div/>', {
                            class: 'form-group data_source_api'
                        });
                        var textarea = $('<input />', {
                            "class": 'form-control',
                            "type": 'text',
                            "id": 'data_source_api',
                            "placeholder": 'Put Api Url ...',
                            "name": 'json_data_api'
                        });

                        data_group.append(textarea);
                        $('.select_op_box').append(data_group);
                        break;
                    case 'related':
                        $("[data-key=some-unit]").attr('data-item', 'data_source');
                        $.ajax({
                            type: 'GET',
                            url: "{!! url('/admin/console/structure/tables/table-names') !!}",
                            datatype: 'json',
                            cache: false,
                            success: function (data) {
                                if (!data.error) {
                                    var data_group_label = $('<label/>', {
                                        "class": 'col-md-4 control-label',
                                        "for": 'bbfunction',
                                        "text": 'Select Table'
                                    });

                                    data_group.append(data_group_label);

                                    var data_group_col = $('<div/>', {
                                        class: 'col-md-4'
                                    });
                                    data_group.append(data_group_col);

                                    var data_source_related = $('<select/>', {
                                        "class": 'form-control',
                                        "id": 'data_source_table_name',
                                        "name": "data_source_table_name"
                                    });

                                    data_source_related.append($('<option>', {value: '', text: 'Select Table Name'}));

                                    $.each(data.data, function (k, v) {
                                        $(data_source_related).append("<option value='" + v + "'>" + v + "</option>");
                                    });

                                    data_group_col.append(data_source_related);
                                    $('.select_op_box').append(data_group);
                                }
                            }
                        });
                        break;
                    case 'user_input':
                        $("[data-key=some-unit]").attr('data-item', 'user_input');
                        $.ajax({
                            type: 'GET',
                            url: "{!! url('/admin/modules/bburl/unit') !!}" + '/' + val,
                            datatype: 'json',
                            cache: false,
                            success: function (data) {
                                if (!data.error) {
                                    $('#inpur_result').html(data.field);
                                    $('.data-box').html(data.settings_html);
                                }

                            }
                        });
                        break;
                    default :
                        $("[data-key=some-unit]").attr('data-item', '');
                        break;
                }
            }

            $('body').on('change', '#data_source', function () {
                dataSource();
            });

            $("body").on('click', '.file-item-dynamic', function () {
                var id = $("[name=file-unit]").val();
                $('.file-box').remove();

                $.ajax({
                    type: 'GET',
                    url: "{!! url('/admin/tools/mapping/get-heading') !!}" + '/' + id,
                    datatype: 'json',
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    success: function (data) {
                        if (!data.error) {

                            var form_group = $('<div/>', {
                                class: 'form-group file-box'
                            });

                            var form_group_col = $('<div/>', {
                                class: 'col-xs-8 col-md-offset-4'
                            });
                            form_group.append(form_group_col);

                            var data_source_type_key = $('<select/>', {
                                "class": 'form-control',
                                "id": 'data_source_type_key',
                                "name": "data_source_type_key"
                            });

                            form_group_col.append(data_source_type_key);

                            data_source_type_key.append($('<option>', {value: '', text: 'Select Data Key'}));


                            var form_group_val = $('<div/>', {
                                class: 'form-group file-box'
                            });

                            var form_group_col_val = $('<div/>', {
                                class: 'col-xs-8 col-md-offset-4'
                            });
                            form_group_val.append(form_group_col_val);

                            var data_source_type_val = $('<select/>', {
                                "class": 'form-control',
                                "id": 'data_source_type_val',
                                "name": "data_source_type_val",
                                "option": {'': "select"}
                            });

                            form_group_col_val.append(data_source_type_val);
                            data_source_type_val.append($('<option>', {value: '', text: 'Select Data Value'}));

                            $.each(data.data, function (k, v) {
                                $(data_source_type_key).append("<option value='" + v + "'>" + v + "</option>");
                                $(data_source_type_val).append("<option value='" + v + "'>" + v + "</option>");
                            });

                            $('.data-source-box').append(form_group_val, form_group);

                        }

                    }
                });

            });

            $("body").on('change', '#data_source_table_name', function () {
                var val = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: "{!! url('/admin/console/structure/tables/get-table-columns') !!}",
                    datatype: 'json',
                    data: {val: val},
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    cache: false,
                    success: function (data) {
                        $('.columns_list').remove();
                        var data_group = $('<div/>', {
                            "class": 'form-group columns_list'
                        });
                        var data_group_label = $('<label/>', {
                            "class": 'col-md-4 control-label',
                            "for": 'data_source_columns',
                            "text": 'Select Column'
                        });

                        data_group.append(data_group_label);

                        var data_group_col = $('<div/>', {
                            class: 'col-md-4'
                        });
                        data_group.append(data_group_col);

                        var data_source_related = $('<select/>', {
                            "class": 'form-control',
                            "id": 'table_column',
                            "name": "data_source_columns"
                        });

                        data_source_related.append($('<option>', {value: '', text: 'Select Column'}));

                        $.each(data.data, function (k, v) {
                            $(data_source_related).append("<option value='" + v + "'>" + v + "</option>");
                        });

                        data_group_col.append(data_source_related);
                        $('.select_op_box').append(data_group);
                    }
                });
            });

            $("body").on('change', '#data_source_type_key', function () {
                var id = $("[name=file-unit]").val();
                var key = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: "{!! url('/admin/tools/mapping/get-heading-keys') !!}",
                    datatype: 'json',
                    data: {id: id, key: key},
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    cache: false,
                    success: function (data) {
                        var form_group = $('<div/>', {
                            class: 'form-group file-box'
                        });

                        var form_group_col = $('<div/>', {
                            class: 'col-xs-8 col-md-offset-4'
                        });
                        form_group.append(form_group_col);

                        var data_source_type_default = $('<select/>', {
                            "class": 'form-control',
                            "id": 'data_source_type_default',
                            "name": "data_source_type_default"
                        });

                        form_group_col.append(data_source_type_default);

                        data_source_type_default.append($('<option>', {value: '', text: 'Select Default Value'}));

                        $.each(data, function (k, v) {
                            $(data_source_type_default).append("<option value='" + v + "'>" + v + "</option>");
                        });

                        $('.data-source-box').append(form_group);
                    }
                });
            });
        });
    </script>
@endsection


