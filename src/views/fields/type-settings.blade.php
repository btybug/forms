@extends('btybug::layouts.admin')
@section('content')
   <div class="col-md-12">
        @include("forms::_partials.fields.".$slug)
   </div>
@endsection
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

            $("body").on("change",".visibility-control", function () {
                var value = $(this).val();
                if(value == 1){
                    $(".default-value-box").removeClass("show");
                    $(".default-value-box").addClass("hide");

                    $(".visibility-box").removeClass("hide");
                    $(".visibility-box").addClass("show");
                }else{
                    $(".visibility-box").removeClass("show");
                    $(".visibility-box").addClass("hide");

                    $(".default-value-box").removeClass("hide");
                    $(".default-value-box").addClass("show");
                }
            })

            $("body").on("click", '.item-unit', function () {
                var data = $("#edit-field").serialize();
                sendajaxvar('/admin/console/structure/fields/render-html', data, function (d) {
                    if (d) {
                        $(".field-html-box").html(d.data);
                    }
                })
            })

            // function layoutData(variation) {
            //     var data;
            //     if (!variation) {
            //         variation = $('input[data-name="unit"]').val();
            //     }
            //     $('input[name="selcteunit"]').val(variation)
            //     data = {'variation_id': variation};
            //     sendajaxvar('/admin/console/bburl/get-page-layout-config-toarray', data, function (d) {
            //         if (!d.error) {
            //             $('[data-unitname="btnunit"] [data-action="units"]').text('change');
            //             $('[data-unitname="name"]').removeClass('hide');
            //             $.each(d, function (key, val) {
            //                 if (typeof val == 'string') {
            //                     $('[data-unitname="' + key + '"]').html(val)
            //                 }
            //                 if (typeof val == 'object') {
            //                     $.each(val, function (k, v) {
            //                         $('[data-unitname="' + k + '"]').html(v)
            //                     })
            //                 }
            //             })
            //         }
            //     })
            //
            //
            // }
            //
            // $('body').on('change', 'input[data-name="unit"]', function () {
            //     $('[data-unitname="btnunit"] [data-action="units"]').text('change');
            //     layoutData($(this).val());
            // });


            //layoutData();


            $("body").on('change', '.table-columns', function () {
                var data = {
                    'table': $('.table-change').val(),
                    'column': $(this).val()
                }
                sendajaxvar('/admin/console/bburl/get-column-rules', data, function (d) {
                    if (d) {
                        $('.core-val').html(d);
                    }
                })
            });

            $("body").on('click', '.allow_membership', function () {
                if ($('.allow_membership:checkbox:checked').length > 0) {
                    $('.memberships').removeClass('hide');
                } else {
                    $('.memberships').addClass('hide');
                }
            });

            $('ul.tabs li').click(function () {
                var tab_id = $(this).attr('data-tab');

                $('ul.tabs li').removeClass('current');
                $('.tab-content').removeClass('current');

                $(this).addClass('current');
                $("#" + tab_id).addClass('current');
            });

            var elements = {
                checkbox: function (data, name, with_key) {
                    $('.additional-data').removeClass('hide');
                    $('[data-tab=tab-2]').click();
                    var text = '<div class="form-group"><label class="col-md-4 control-label" for="checkboxes"></label><div class="col-md-4">';
                    $.each(data, function (k, v) {
                        if (typeof with_key != "undefined" && with_key == true) {
                            text += '<div class="radio"><label><input type="radio" name="' + name + '" value="' + k + '">' + v + ' </label></div>';
                        } else {
                            text += '<div class="radio"><label><input type="radio" name="' + name + '" value="' + v + '">' + v + ' </label></div>';
                        }

                    })
                    text += '</div></div>';
                    return text;
                },
                radio: function (data, name, with_key) {
                    $('.additional-data').removeClass('hide');
                    $('[data-tab=tab-2]').click();
                    var text = '<div class="form-group"><label class="col-md-4 control-label" for="checkboxes"></label><div class="col-md-4">';
                    $.each(data, function (k, v) {
                        if (typeof with_key != "undefined" && with_key == true) {
                            text += '<div class="checkbox"><label ><input type="checkbox" name="' + name + '"  value="' + k + '">' + v + ' </label></div>';
                        } else {
                            text += '<div class="checkbox"><label ><input type="checkbox" name="' + name + '"  value="' + v + '">' + v + ' </label></div>';
                        }

                    })
                    text += '</div></div>';
                    return text;
                },
                select: function (data, name, with_key) {
                    $('.additional-data').removeClass('hide');
                    $('[data-tab=tab-2]').click();
                    var text = '<div class="form-group"><label class="col-md-4 control-label" ></label><div class="col-md-4"><select  name="' + name + '" class="form-control">';
                    $.each(data, function (k, v) {
                        if (typeof with_key != "undefined" && with_key == true) {
                            text += ' <option value="' + k + '">' + v + '</option>';
                        } else {
                            text += ' <option value="' + v + '">' + v + '</option>';
                        }
                    });
                    text += '</select></div></div>';
                    return text;
                },
                multy_select: function (data, name, with_key) {
                    $('.additional-data').removeClass('hide');
                    var text = '<div class="form-group"><label class="col-md-4 control-label" ></label><div class="col-md-4"><select  name="' + name + '"multiple="multiple" class="form-control">';
                    $.each(data, function (k, v) {
                        if (typeof with_key != "undefined" && with_key == true) {
                            text += ' <option value="' + k + '">' + v + '</option>';
                        } else {
                            text += ' <option value="' + v + '">' + v + '</option>';
                        }
                    });
                    text += '</select></div></div>';
                    return text;
                },
                text: function (data, name, with_key) {

                    $('.additional-data').addClass('hide');
                    return '<div class="form-group"><label class="col-md-4 control-label" for="textinput"></label><div class="col-md-4"><input id="textinput" name="textinput" type="text" class="form-control input-md"></div></div>';
                },
                textarea: function (data, name, with_key) {
                    $('.additional-data').addClass('hide');
                    return '<div class="form-group"><label class="col-md-4 control-label" for="textarea"></label><div class="col-md-4"><textarea class="form-control" id="textarea" name="textarea"></textarea> </div> </div>';
                }
            }


            function sendajaxvar(url, data, success) {
                $.ajax({
                    type: "post",
                    datatype: "json",
                    url: url,
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    success: function (data) {
                        if (success) {
                            success(data);
                        }
                        return data;
                    }
                });
            }

            function getajaxvar(url, data, success) {
                $.ajax({
                    type: "GET",
                    datatype: "json",
                    url: url,
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    success: function (data) {
                        if (success) {
                            success(data);
                        }
                        return data;
                    }
                });
            }


            var table;
            $("body").on('change', '.table-change', function () {
                var value = $(this).val();
                if (value != '') {
                    table = value;
                    var data = {}
                    data['table'] = value;
                    sendajaxvar('/admin/console/bburl/get-table-columns', data, function (d) {
                        if (d) {
                            var option = ''
                            $('.table-columns').empty()
                            $.each(d, function (k, v) {
                                option += '<option value="' + k + '">' + v + '</option>';

                            })

                            $('.table-columns').append(option);
                            $('.columns').removeClass('hide')
                        }
                    })
                }
            });


            var input_type;
            $("body").on('change', '.field-type', function () {
                var value = $(this).val();
                console.log(value)
                if (typeof value != "undefined" && value != '') {
                    $('.tab-options-area').removeClass('hidden');
                    $('.live-preview').removeClass('hidden');
                    $('[data-previewoption]').removeClass('hidden');

                    var data = {value: value}
                    sendajaxvar('/admin/console/bburl/get-field-units', data, function (d) {
                        if (d) {
                            var option;
                            $('.field-type-units').empty();
                            option = '<option value="">Select Option</option>';
                            $.each(d.data, function (k, v) {
                                option += '<option value="' + k + '">' + v + '</option>';
                            });

                            $('.field-type-units').append(option);
                            $('.field-units').removeClass('hide')
                        }
                    })
                } else {
                    $('.field-units').addClass('hide');
                    $('.tab-options-area').addClass('hidden');
                    $('.live-preview').addClass('hidden');
                    $('[data-previewoption]').addClass('hidden');
                }
            });

            $("body").on('change', '.field-type-units', function () {
                var value = $(this).val();
                if (typeof value != "undefined" && value != '') {
                    var data = {value: value}
                    sendajaxvar('/admin/console/bburl/get-field-unit', data, function (d) {
                        if (!d.error) {
                            htmlsdata['field'] = d.html
                            htmlpreview()
                            $('#unit-data').html(d.options);
                            $('#unit-data').removeClass('hide');
                            getoptiondata('noajax')
                        }
                    })
                }
            });
//            $('form').on('input', 'input[name=name]', function () {
//                var name = $(this).val();
//                if ($.isFunction(elements[input_type])) {
//                    var name = $('input[name=name]').val();
//                    $('.live-preview').html(elements[input_type]($('#data-source').val().split(","), name));
//                }
//            });

//            $('#data-source').on('input', function () {
//                var res = $(this).val().split(",");
//                var name = $('input[name=name]').val();
//                if ($.isFunction(elements[input_type])) {
//                    $('.live-preview').html(elements[input_type](res, name))
//                }
//
//            })

//            $("body").on('change', '.select-file-dropdown', function () {
//                var key = $('.file-key').val();
//                var value = $('.file-value').val();
//                var id = $('[data-name="file"]').val();
//                if (typeof key != "undefined" && typeof value != "undefined"
//                    && typeof id != "undefined" && key != '' && value != '' && id != '') {
//                    var data = {key : key, value : value, id : id};
//                    sendajaxvar('/admin/console/bburl/get-file-list', data, function (d) {
//                        if(! d.error){
//                            var type = $('.field-type').val();
//                            var name = $('input[name=name]').val();
//
//                            if ($.isFunction(elements[type])) {
//                                $('.live-preview').html(elements[type](d.data, name,true))
//                            }
//                        }
//                    });
//                }
//            });

//            $("body").on('click', '.file-item-dynamic', function () {
//                var value = $(this).find('[data-value]').data('value');
//                var data = {value: value};
//                sendajaxvar('/admin/console/bburl/get-file-data', data, function (d) {
//                    if (d) {
//                        var option;
//                        $('.file-key').empty();
//                        $('.file-value').empty();
//                        option = '<option value="">Select Option</option>';
//                        $.each(d.data, function (k, v) {
//                            option += '<option value="' + k + '">' + v + '</option>';
//                        });
//
//                        $('.file-key').append(option);
//                        $('.file-value').append(option);
//                        $('.file-data').removeClass('hide')
//                    }
//                })
//            })

            function getoptiondata(noajax) {
                var optiondata = {};
                optiondata['options'] = {}
                $('[data-role="optionsetting"] select[name], [data-role="optionsetting"] input[name], [data-role="optionsetting"] textarea[name]').each(function () {
                    var name = $(this).attr('name');
                    if ($(this).is('[type="radio"]')) {
                        var value = $('[data-role="optionsetting"] input[name="' + name + '"][type="radio"]:checked').val();
                    } else {
                        var value = $(this).val();
                    }
                    optiondata['options'][name] = value;
                })


                optiondata['value'] = $('select[name="unit"]').val();
                $('[name="settings"]').val(JSON.stringify(optiondata['options']));
                if (!noajax) {
                    sendajaxvar('/admin/console/bburl/get-field-unit', optiondata, function (d) {
                        if (d) {
                            htmlsdata['field'] = d.html;
                            htmlpreview()
                        }
                    })
                }
            }

            $('[data-role="optionsetting"]').on('change', 'select,   [type="checkbox"], [type="radio"]', function () {
                getoptiondata()

            }).on('keyup', 'input, textarea', function () {
                getoptiondata()

            })


            $('body').on('change', '.field-validation', function () {
                var value = $(this).val();
                if (typeof value != "undefined" && value == 'custom') {
                    $('.plugin_validations').removeClass('hide');
                } else {
                    $('.plugin_validations').addClass('hide');
                }
            })

            function htmlpreview() {
                $('[data-fieldsetting="setting"]').html('')
                if (htmlsdata[activefieldtype]) {
                    var htmlsfidl = $('<div></div>')
                    htmlsfidl.html(htmlsdata[activefieldtype].html)
                    if (htmlsdata['field']) {
                        htmlsfidl.find('[data-fcontrol="input"]').html(htmlsdata['field'])
                    }
                    if (htmlsdata[activefieldtype].settings) {
                        $('[data-fieldsetting="setting"]').html(htmlsdata[activefieldtype].settings)
                    }
                    $('.live-preview').html(htmlsfidl.html());
                } else {
                    $('.live-preview').html(htmlsdata['field']);
                }
            }

            function selecthtmls() {
                var gethtmlv = $('[data-selectcustomfield]').val()
                $('[data-fieldtype="form"]').val(gethtmlv)
                activefieldtype = gethtmlv
                $('[data-selectcustomfieldhtml]').addClass('hide')
                $('[data-selectcustomfieldhtml="' + gethtmlv + '"]').removeClass('hide')
                htmlpreview()
            }

            var fieldhtmlsty = $('[data-fieldtype="form"]').val()

            $('[data-selectcustomfield]').val(fieldhtmlsty)
            selecthtmls()

            $('[data-selectcustomfield]').change(function () {
                selecthtmls()
            })

            $('body').on('click', '.item-unit[data-key="default_field_html"]', function () {
                var gtid = $(this).find('input').data('value')
                $('[data-fieldtype="formdefutl"]').val(gtid)
                var data = {'slug': gtid}
                sendajaxvar('/admin/console/structure/get-custom-html', data, function (d) {
                    if (d) {
                        htmlsdata['custom'] = d;
                        htmlpreview()
                    }
                });
            })

        });
    </script>

    <script>
        $(document).ready(function () {
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
                            "name": 'json_data[manual]'
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
                            "name": 'json_data[bb]'
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
                            "name": 'json_data["api"]'
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
                                        "name": "json_data[data_source_table_name]"
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
                                "name": "json_data[data_source_type_key]"
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
                                "name": "json_data[data_source_type_val]",
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
                            "name": "json_data[data_source_columns]"
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
                            "name": "json_data[data_source_type_default]"
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

