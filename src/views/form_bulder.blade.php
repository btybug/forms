@php
    $page = \Btybug\btybug\Services\RenderService::getPageByURL();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Builder</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    {!! HTML::style('public/css/admin.css') !!}
    {!! HTML::style('public/css/cms.css') !!}
    {!! HTML::style('public/css/menus.css?v='.rand(1111,9999)) !!}
    {!! BBstyle(plugins_path("vendor/btybug.hook/blog/src/Assets/css/blog-form.css")) !!}

    {!! HTML::script('public/js/jquery-2.1.4.min.js') !!}

    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>

    {!! HTML::script('public/css/bootstrap/js/bootstrap-switch.min.js') !!}
    {!! HTML::script('public/css/font-awesome/js/fontawesome-iconpicker.min.js') !!}
    {!! HTML::script('public/js/jquery-ui/jquery-ui.min.js') !!}
    {!! HTML::script("/public/js/UiElements/bb_styles.js?v.5") !!}
    {!! BBscript(plugins_path("vendor/btybug.hook/blog/src/Assets/js/blog-fields.js")) !!}

    {!! BBstyle(plugins_path("vendor/btybug.hook/blog/src/Assets/css/form-builder.css")) !!}
    {!! BBscript(plugins_path("vendor/btybug.hook/blog/src/Assets/js/form-builder.js")) !!}

    {!! HTML::style('public-x/custom/css/'.str_replace(' ','-',$page->slug).'.css', ["id"=>"custom_css"]) !!}
    {!! HTML::script('public-x/custom/js/'.str_replace(' ','-',$page->slug).'.js') !!}
</head>
<body>

{!! Form::model($form,['route' => 'add_or_update_form_builder']) !!}
{!! Form::hidden('id',null) !!}
{!! Form::hidden('fields_type','posts') !!}

<div class="bb-form-header">
    <div class="row">
        <div class="col-md-8">
            <label>Form name</label>
            {!! Form::text('name',null,['class' => 'form-name', 'placeholder' => 'Form Name']) !!}
        </div>
        <div class="col-md-4">
            <button type="submit" class="form-save pull-right"><span>Save</span></button>
        </div>
    </div>
</div>

<div class="bb-form-options">

    <span class="form-preview">FORM PREVIEW</span>

    <div class="form-layout pull-right">
        {!! BBbutton2('unit','form_layout','form_layout','Select Layout',['class'=>'form-control','model'=>$form]) !!}
    </div>

    <div class="pull-right">
        <a class="btn btn-danger" style="margin-right: 10px;" data-toggle="modal" data-target="#formSettingsModal">
            <i class="fa fa-gear"></i> Form Settings
        </a>
        <a class="btn btn-warning layout-settings" style="margin-right: 10px;">
            <i class="fa fa-pencil"></i> Layout settings
        </a>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="formSettingsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Form Settings</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group m-l-0 m-r-0">
                            <label for="success_message" class="col-sm-4 ">Success Message</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="message" type="text">
                            </div>
                        </div>

                        <div class="form-group m-l-0 m-r-0">
                            <label for="success_message" class="col-sm-4 ">Event/Trigger</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="event"><option value="" selected="selected">Select Event</option><option value="App\Events\AfterLoginEvent">After Login</option><option value="App\Events\AfterLogOutEvent">After Log out</option><option value="Illuminate\Auth\Events\Registred">on registred</option><option value="App\Events\FormSubmit">on Form Submit</option><option value="App\Events\PageCreateEvent">on Page Create</option></select>
                            </div>
                        </div>

                        <div class="form-group m-l-0 m-r-0">
                            <label for="" class="col-sm-4">Redirect Page</label>
                            <div class="col-sm-8">
                                <select id="target" class="form-control" name="redirect_Page" title="Select Target">
                                    <option value="alert">BB get page</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group m-l-0 m-r-0">
                            <label for="" class="col-sm-4">Is Ajax</label>

                            <div class="col-sm-8">
                                <div class="customelement radio-inline">
                                    <input name="is_ajax" id="is_ajax_yes" value="yes" type="radio">
                                    <label for="is_ajax_yes">Yes</label>
                                </div>
                                <div class="customelement radio-inline">
                                    <input name="is_ajax" id="is_ajax_no" value="no" type="radio"> <label for="is_ajax_no">No</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group m-l-0 m-r-0">
                            <button type="submit" class="bty-btn bty-btn-save bty-btn-cl-black bty-btn-size-sm pull-right m-r-10" data-action="save-form"><span>Save</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="">
    <iframe src="" id="unit-iframe"></iframe>

    <input type="hidden" name="fields_json" value="{}" id="existing-fields" />
    <input type="hidden" name="unit_json" value="{}" />
</div>
{!! Form::close() !!}
@include('resources::assests.deleteModal')
@include('resources::assests.magicModal')

<div class="modal fade" id="select-fields" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="font-size: 32px;
    font-family: fantasy;
    text-align: center;">Select Fields</h4>
            </div>
            <div class="modal-body" style="min-height: 300px;">

            </div>
            <div class="modal-footer">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-success add-to-form">Add to Form</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Field Container Template -->
<script type="template/html" id="field-template"><div class="form-group" data-field-id="{id}">
    <label><i class="fa {icon}"></i> {label}</label>
    <i class="fa {tooltip_icon}" data-toggle="tooltip" data-placement="top" title="{help}"></i>
    {field}
</div></script>

<!-- Actions Buttons Template -->
<script type="template/html" id="actions-template">
    <div class="bb-field-actions">
        <button class="btn btn-xs btn-danger delete-field" data-id="{id}">
            <i class="fa fa-trash"></i>
        </button>
    </div>
</script>

<!-- From area controls -->
<script type="template/html" id="form-actions-template">
    <div class="bb-form-actions">
        <button class="btn btn-xs btn-success add-field-trigger" data-id="{id}">
            <i class="fa fa-plus"></i> ADD FIELD
        </button>
    </div>
</script>

<!-- Fields Backup -->
<script type="template/html" id="fields-backup"></script>

<!-- Injected templates to iframe -->
<script type="template/html" id="iframe-inject-head">
    <style>
        .bb-form-area {
            outline: 1px dashed #c0c0c0;
            outline-offset: 5px;
        }

        .bb-form-area:empty:after{
            content: "Add Form Fields Here";
            color: #bdbdbd;
            position: absolute;
            width: 100%;
            height: 100%;
            text-align: center;
            line-height: 50px;
        }

        .bb-form-area {
            min-height: 50px;
            position: relative;
        }

        .ui-sortable-handle:hover, .ui-sortable > div:hover {
            outline: 1px dashed #fbf7d9;
            outline-offset: 2px;
            cursor: move;
        }

        .ui-sortable-placeholder {
            background: #fbf7d9;
            visibility: visible !important;
            margin-bottom: 6px;
        }

        .bb-field-actions {
            position: absolute;
            top: 5px;
            right: 5px;
            display: none;
        }

        .bb-form-area > .form-group {
            position: relative;
        }

        .bb-form-area > .form-group:hover .bb-field-actions {
            display: block;
        }

        .bb-form-actions {
            position: absolute;
            top: -22px;
            right: 15px;
            z-index: 999;
            display: none;
        }

        .bb-form-area-container:hover > .bb-form-actions {
            display: block;
        }

        .bb-form-actions.active {
            display: block;
        }

        .bb-form-area.active {
            outline: 1px solid #c0c0c0;
        }
    </style>
</script>

<script>
    function reload_js(src) {
        $('script[src="' + src + '"]').remove();
        $('<script>').attr('src', src).appendTo('body');
    }

    function reload_css(href) {
        $('<link>').attr({
            'href': href,
            'type': 'text/css',
            'rel': 'stylesheet',
            'media': 'all'
        }).appendTo('head');

        if($('link[href="' + href + '"]').length > 1){
            $('link[href="' + href + '"]').first().remove();
        }
    }
</script>

<script>
    $(document).ready(function () {

        $("body")
            // Select field
            .on("click", ".select-field", function () {
                var table = "posts";
                var fields = $("#existing-fields").val();
                var fieldsJSON = JSON.parse(fields);
                var existingFields = [];

                if(Object.keys(fieldsJSON).length > 0){
                    $.each(fieldsJSON, function (index, group){
                        console.log(existingFields, group);
                        existingFields = existingFields.concat(group);
                        console.log(existingFields);
                    });
                }

                $.ajax({
                    url: "{!! url('admin/blog/get-fields') !!}",
                    data: {table: table, fields: JSON.stringify(existingFields)},
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        $("#select-fields .modal-body").html(data.html);
                        $("#select-fields").modal();
                    },
                    type: 'POST'
                });

            })
            // Add field to form
            .on("click", ".add-to-form", function () {
                var data = $("#selected-fields").serialize();
                $.ajax({
                    url: "{!! url('admin/blog/render-unit') !!}",
                    data: data + '&existings=' + $("#existing-fields").val(),
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        $("#select-fields").modal("hide");
                        if (!data.error) {
                            addFieldsToFormArea(data.fields);
                        } else {
                            alert(data.message);
                        }
                    },
                    type: 'POST'
                });
            })
            // Change form style
            .on("click", ".bb-field-style>a", function () {
                var $this = $(this);
                var iframe = getIframeContent();

                iframe.find('.bb-form-area>.form-group').attr("class", "form-group " + $this.attr('data-id'));

                // Hide modal
                $('#formStyle').modal('hide');
            })
            // Activate form area
            .on("click", ".bb-form-area", function () {
                var toggle = $(this).hasClass("active");
                $('.bb-form-area').removeClass("active");

                if(!toggle) $(this).addClass("active");
            });

        // Change layout
        $('[name=form_layout]').on('change', function (){
            var layout = $(this).val();
            var iframe = $('#unit-iframe');

            iframe.attr("src", "{!! url("/admin/uploads/gears/settings-iframe/") !!}/" + layout);
        });

        @if(isset($form) and $form->fields_json)
        // Default values
        var iframe = $('#unit-iframe');
        var fieldsJSON = {!! $form->fields_json !!};
        var unitJSON = {!! $form->unit_json !!};
        var layout = '{!! $form->form_layout !!}';

        iframe.attr("src", "{!! url("/admin/uploads/gears/settings-iframe/") !!}/" + layout);
        @endif

        function onFrameLoaded(){
            var iframe = getIframeContent();

            // Mark sortable areas
            iframe.find('.bb-form-area').each(function (i){
                $(this).attr("data-sortable", i);
            });

            // Add form actions
            iframe.find('.bb-form-area').each(function (){
                var formActionsTemplate = $('#form-actions-template').html();

                $(this)
                    .wrap('<div class="bb-form-area-container"></div>')
                    .before(formActionsTemplate);
            });

            // Activate sortable
            activateSortable();

            // Restore fields from backup
            var fieldsJSONString = $('[name=fields_json]').val(),
                fieldsJSON = JSON.parse(fieldsJSONString);

            $.each(fieldsJSON, function (index, fields){
                var formArea = iframe.find('[data-sortable=' + index + ']');

                $.each(fields, function (index, field){
                    var fieldHTML = $('#fields-backup').find('[data-field-id='+field+']').clone();
                    formArea.append(fieldHTML);
                });

                // Action buttons
                addActionsButton(iframe, index);
            });

        }

        // iFrame functions
        $('#unit-iframe').load(function (){
            var headHTML = $('#iframe-inject-head').html();
            var iframe = getIframeContent();
            iframe.prepend(headHTML);

            // Load saved fields
            if(typeof fieldsJSON !== "undefined"){
                $.each(fieldsJSON, function (index, areaJSON){
                    addFieldsToFormArea(areaJSON, index);
                });
            }

            // Unit settings
            if(typeof unitJSON !== "undefined"){
                $.each(unitJSON, function (key, value){
                    if(key !== "_token" && key !== "itemname"){
                        var field = iframe.find('#add_custome_page').find('[name=' + key + ']');
                        field.val(value);
                    }
                });

                document.getElementById('unit-iframe').contentWindow.savesettingevent();
            }

            $('.layout-settings').click(function(){
                var  $this = $(this);
                if($this.hasClass('active')){
                    $this.removeClass('active');
                    iframe.find('[data-settinglive="settings"]').addClass('hide');
                    iframe.find('.previewcontent').addClass('activeprevew');
                }else{
                    $this.addClass('active');
                    iframe.find('[data-settinglive="settings"]').removeClass('hide');
                    iframe.find('.previewcontent').removeClass('activeprevew');
                }
            });

            // On frame loaded
            onFrameLoaded();

            // Actions
            iframe
                .on("click", ".bb-form-area", function () {
                    var toggle = $(this).hasClass("active");
                    iframe.find('.bb-form-area').removeClass("active");
                    iframe.find('.bb-form-actions').removeClass("active");

                    if(!toggle) {
                        $(this).addClass("active");
                        $(this).closest('.bb-form-area-container').find('.bb-form-actions').addClass("active");
                    }
                })
                .on('click', '.add-field-trigger', function (){
                    iframe.find('.bb-form-area').removeClass("active");

                    $(this)
                        .closest('.bb-form-area-container').find('.bb-form-area')
                        .addClass('active');

                    $(this)
                        .closest('.bb-form-area-container').find('.bb-form-actions')
                        .addClass('active');

                    // Open modal
                    var table = "posts";
                    var fields = $("#existing-fields").val();
                    var fieldsJSON = JSON.parse(fields);
                    var existingFields = [];

                    if(Object.keys(fieldsJSON).length > 0){
                        $.each(fieldsJSON, function (index, group){
                            console.log(existingFields, group);
                            existingFields = existingFields.concat(group);
                            console.log(existingFields);
                        });
                    }

                    $.ajax({
                        url: "{!! url('admin/blog/get-fields') !!}",
                        data: {table: table, fields: JSON.stringify(existingFields)},
                        headers: {
                            'X-CSRF-TOKEN': $("input[name='_token']").val()
                        },
                        dataType: 'json',
                        success: function (data) {
                            $("#select-fields .modal-body").html(data.html);
                            $("#select-fields").modal();
                        },
                        type: 'POST'
                    });
                })
                // Remove field
                .on("click", ".delete-field", function (e) {
                    e.preventDefault();

                    var itemtoRemove = $(this).data('id'),
                        fields = $("#existing-fields");

                    var oldData = JSON.parse(fields.val());
                    var newData = {};

                    var isRemoved = false;

                    $.each(oldData, function (index, item){
                        if(!isRemoved){
                            var itemToRemoveIndex = item.indexOf(itemtoRemove);
                            if(itemToRemoveIndex !== -1){
                                item.splice(itemToRemoveIndex, 1);
                                isRemoved = true;
                            }
                        }

                        newData[index] = item;
                    });

                    fields.val(JSON.stringify(newData));

                    // Remove from DOM
                    $(this).closest('.form-group').css("background", "red").fadeOut(function () {
                        $(this).remove();
                    });

                    // Remove from backup
                    $('#fields-backup').find('[data-field-id='+itemtoRemove+']').remove();
                });
        });

        function getIframeContent(){
            return $('#unit-iframe').contents().find('body');
        }

        // Add fields to form area
        function addFieldsToFormArea(fieldsJSON, position) {
            var iframe = getIframeContent();

            if(!position) position = 0;

            // Build form
            var activeFormArea = iframe.find('.bb-form-area.active');
            var fieldHTML = "";
            if(activeFormArea.length === 1){
                position = activeFormArea.data("sortable");
                fieldHTML = formBuilder(fieldsJSON, position);
                activeFormArea.html(fieldHTML);
            }else{
                fieldHTML = formBuilder(fieldsJSON, position);
                iframe.find('[data-sortable='+position+']').html(fieldHTML);
            }

            // Add field to backup
            $('#fields-backup').append(fieldHTML);

            // Tooltip
            iframe.find('[data-toggle="tooltip"]').tooltip();

            // Action buttons
            addActionsButton(iframe, position);
        }

        // Add action button to fields
        function addActionsButton(iframe, position){
            iframe.find('[data-sortable='+position+']>.form-group').each(function () {
                var $this = $(this),
                    actionsTemplate = $('#actions-template').html(),
                    id = $this.attr("data-field-id");

                actionsTemplate = actionsTemplate.replace(/{id}/g, id);

                $this.append(actionsTemplate);
            });
        }

        // Building form and hidden inputs
        function formBuilder(fields, position) {
            var iframe = getIframeContent();

            var existingFields = $("#existing-fields"),
                existingFieldsData = JSON.parse(existingFields.val());

            var fieldsHTMLData = iframe.find('[data-sortable=' + position + ']').html();

            $(fields).each(function (index, field) {
                // Add to existing fields
                if(!existingFieldsData[position]) existingFieldsData[position] = [];
                existingFieldsData[position].push(field.object.id);

                // Render fields
                fieldsHTMLData += renderFormField(field);
            });

            // Add existing fields to hidden input
            existingFields.val(JSON.stringify(existingFieldsData));

            return fieldsHTMLData;
        }

        // Render fields HTML
        function renderFormField(fieldObject) {

            var field = fieldObject.object;

            // Check if not object
            if (!field.id) return;

            var fieldHTML = '',
                fieldTemplate = $('#field-template').html();

            // Switch types
            switch (field.type) {
                // Input fields "text, number, email, url"
                case 'text':
                case 'number':
                case 'email':
                case 'url':
                    fieldHTML = '<input name="{name}" type="' + field.type + '" class="form-control" placeholder="{placeholder}" />';
                    break;

                case 'textarea':
                    fieldHTML = '<textarea name="{name}" class="form-control" placeholder="{placeholder}"></textarea>';
                    break;

                case 'select':
                    fieldHTML = '<select name="{name}" class="form-control">';

                    var json_data = fieldObject.field_data;

                    // Read data
                    if (json_data) {
                        // var options = JSON.parse(json_data);
                        $.each(json_data, function (key, option) {
                            fieldHTML += '<option value="' + key + '">' + option + '</option>';
                        });
                    }

                    fieldHTML += '</select>';
                    break;

                case 'special':
                    fieldHTML = fieldObject.html;
                    break;
            }

            fieldHTML = fieldHTML.replace(/{placeholder}/g, field.placeholder);
            fieldHTML = fieldHTML.replace(/{name}/g, field.column_name);

            // Insert into template
            fieldTemplate = fieldTemplate.replace(/{label}/g, field.label);
            fieldTemplate = fieldTemplate.replace(/{id}/g, field.id);
            fieldTemplate = fieldTemplate.replace(/{icon}/g, field.icon);
            fieldTemplate = fieldTemplate.replace(/{help}/g, field.help);
            fieldTemplate = fieldTemplate.replace(/{tooltip_icon}/g, field.tooltip_icon);
            fieldTemplate = fieldTemplate.replace(/{field}/g, fieldHTML);

            return fieldTemplate;
        }

        // Activate sortable
        function activateSortable(){
            var iframe = getIframeContent();
            // Form sortable
            iframe.find('.bb-form-area').sortable({
                connectWith: ".connectedSortable",
                stop: function (event, ui) {
                    var fieldsJSON = $('[name=fields_json]'),
                        fieldsJSONData = JSON.parse(fieldsJSON.val());

                    iframe.find('.bb-form-area').each(function (){

                        var ids = [],
                            container = $(this),
                            sortableIndex = container.attr('data-sortable');

                        container.find('.form-group').each(function () {
                            var id = $(this).attr("data-field-id");
                            ids.push(parseInt(id));
                        });

                        fieldsJSONData[sortableIndex] = ids;
                    });

                    fieldsJSON.val(JSON.stringify(fieldsJSONData));
                }
            });
        }

        // Listen to iframe
        if (window.addEventListener) {
            window.addEventListener("message", onMessage, false);
        }
        else if (window.attachEvent) {
            window.attachEvent("onmessage", onMessage, false);
        }

        function onMessage(event) {

            var data = event.data;
            if(data.TODO){

                var TODO = data.TODO;

                // On Save settings form
                if(TODO === "POST_SETTINGS_CALLBACK"){
                    var json = data.json;
                    $('[name="unit_json"]').val(JSON.stringify(json));

                    // Reload frame
                    onFrameLoaded();
                }

            }
        }
    });
</script>

</body>
</html>