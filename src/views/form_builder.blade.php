<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HTML Builder</title>

    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">--}}

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    {!! HTML::style('public/css/admin.css') !!}
    {!! HTML::style('public/css/cms.css') !!}
    {!! HTML::style('public/css/font-awesome/css/font-awesome.min.css') !!}
    {!! HTML::style('public/css/menus.css?v='.rand(1111,9999)) !!}
    {!! BBstyle(plugins_path("vendor/sahak.avatar/forms/src/Assets/css/forms-form.css")) !!}

    {!! HTML::script('public/js/jquery-2.1.4.min.js') !!}

    {{--<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>--}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    {!! HTML::script('public/css/bootstrap/js/bootstrap-switch.min.js') !!}
    {!! HTML::script('public/css/font-awesome/js/fontawesome-iconpicker.min.js') !!}
    {!! HTML::script('public/js/jquery-ui/jquery-ui.min.js') !!}
    {!! HTML::script("/public/js/UiElements/bb_styles.js?v.5") !!}

    <!-- DB -->
    {!! HTML::script("http://cdn.jsdelivr.net/npm/pouchdb@6.4.2/dist/pouchdb.min.js") !!}
    {!! HTML::script("https://unpkg.com/pouchdb@6.4.2/dist/pouchdb.find.min.js") !!}

    <script>
        var ajaxLinks = {
            baseUrl: "{!! url('admin/forms') !!}/",
            getFields: "{!! url('admin/forms/get-fields') !!}",
            changeLayout: "{!! url("/admin/uploads/gears/html-iframe/") !!}/",
            renderFields:  "{!! url('admin/forms/render-field-types') !!}"
        };
    </script>

    {!! BBstyle(plugins_path("vendor/sahak.avatar/forms/src/Assets/libs/jstree/themes/default/style.min.css")) !!}
    {!! BBscript(plugins_path("vendor/sahak.avatar/forms/src/Assets/libs/jstree/jstree.min.js")) !!}

    {!! HTML::script("public/libs/context_menu/jquery.contextMenu.min.js") !!}
    {!! HTML::style("public/libs/context_menu/jquery.contextMenu.min.css") !!}

    {!! HTML::style("public/libs/jspanel/jspanel.min.css") !!}
    {!! HTML::script("public/libs/jspanel/jspanel.min.js") !!}

    {!! HTML::style("public/libs/toast/jquery-toast.css") !!}
    {!! HTML::script("public/libs/toast/jquery-toast.js") !!}

    {!! HTML::style("public/libs/tagsinput/bootstrap-tagsinput.css") !!}
    {!! HTML::script("public/libs/tagsinput/bootstrap-tagsinput.min.js") !!}

    {!! HTML::script("public/libs/ace/ace.js") !!}
    {!! HTML::script("public/libs/ace/ext-beautify.js") !!}

    {!! HTML::script("public/libs/beautify/beautify-html.js") !!}

    {!! BBstyle(plugins_path("vendor/sahak.avatar/forms/src/Assets/css/html-builder.css")) !!}
    {!! BBscript(plugins_path("vendor/sahak.avatar/forms/src/Assets/js/jquery-ui-droppable-iframe.js")) !!}
    {!! BBscript(plugins_path("vendor/sahak.avatar/forms/src/Assets/js/field-builder.js")) !!}
    {!! BBscript(plugins_path("vendor/sahak.avatar/forms/src/Assets/js/html-builder.js")) !!}
    {{--{!! BBscript(plugins_path("vendor/sahak.avatar/forms/src/Assets/js/inspector.js")) !!}--}}

    {!! HTML::style('public-x/custom/css/formBuilder.css', ["id"=>"custom_css"]) !!}
    {!! HTML::script('public-x/custom/js/formBuilder.js') !!}
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

            <div class="pull-right mr-3 mt-1">
                <a class="btn btn-success btn-sm add-item-trigger">
                    <i class="fa fa-plus"></i> Add Item
                </a>
                <a class="btn btn-info btn-sm open-layers-panel">
                    <i class="glyphicon glyphicon-tasks"></i> Layers
                </a>
                <a class="btn btn-warning btn-sm open-settings-panel">
                    <i class="fa fa-gear"></i> Settings
                </a>
            </div>
        </div>
    </div>
</div>

<div class="bb-form-options">
    <ul id="breadcrumb"></ul>
</div>

<div class="">
    <iframe src="" id="unit-iframe"></iframe>

    <input type="hidden" name="fields_json" value="{}" id="existing-fields" />
    <input type="hidden" name="unit_json" value="{}" />
</div>
{!! Form::close() !!}
@include('resources::assests.deleteModal')
@include('resources::assests.magicModal')

<div class="select-fields-container" id="settings-panel" data-state="open">
    <div class="setting-nav">
        Settings

        <button class="btn btn-danger btn-sm mt-1 pull-right close-settings-panel"><i class="fa fa-close"></i></button>
    </div>

    <div class="settings-panel-content">
        @include('forms::settings.form_settings')
    </div>
</div>

<div class="select-fields-container" id="field-settings" hidden>
    <h3>Field Settings
        <button class="btn btn-primary btn-sm save-field-settings pull-right">Close</button>
    </h3>
    <div class="field-settings-container"></div>
    <input type="hidden" name="selected-field">
    <input type="hidden" name="settings">
</div>

<!-- Field Container Template -->
<script type="template/html" id="field-template"><div class="form-group" data-field-id="{id}" data-field-type="{type}">
    <label><i class="fa {icon}"></i> {label}</label>
    <i class="fa {tooltip_icon}" data-toggle="tooltip" data-placement="top" title="{help}"></i>
    {field}
    </div></script>

<!-- Actions Buttons Template -->
<script type="template/html" id="actions-template">
    <div class="bb-field-actions">
        <button class="btn btn-xs btn-warning field-settings" data-id="{id}">
            <i class="fa fa-gear"></i>
        </button>
        <button class="btn btn-xs btn-danger delete-field" data-id="{id}">
            <i class="fa fa-trash"></i>
        </button>
    </div>
</script>

<!-- Column Content Template -->
<script type="template/html" id="column-content">
    @php
        $tags = ["div", "h1", "h2", "span", "p"];
    @endphp
    <div class="form-group">
        <label>Select Tag</label>
        <select id="selected-tag" class="form-control">
            @foreach($tags as $tag)
                <option value="{{$tag}}">{{$tag}}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-primary apply-tag" data-id="{id}">Apply Tag</button>
</script>

<!-- Fields Backup -->
<script type="template/html" id="fields-backup"></script>

<!-- Elements Settings -->
@include('forms::settings.element_settings')

<!-- Injected templates to iframe -->
<script type="template/html" id="iframe-inject-head">
    <style>
        body{
            padding-top: 30px;
        }

        .medium-editor-element {
            outline: -webkit-focus-ring-color auto 5px;
        }

        [data-bb-hovered] {
            outline: 2px dashed #ff0707!important;
            cursor: pointer;
        }

        .item-column>div {
            outline: 1px dashed #c0c0c0;
            min-height: 50px;
            position: relative;
        }

        .item-column>div:empty:after{
            content: "Drop Here";
            color: #bdbdbd;
            position: absolute;
            width: 100%;
            height: 100%;
            text-align: center;
            line-height: 50px;
            font-size: 12px;
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

        .form-area-active {
            background: #fffacd;
        }

        .form-area-hover {
            background: #deffcd;
        }

        .html-element-item {
            border: 1px solid #d0d0d0;
            background: #f1f1f1;
            border-radius: 3px;
            padding: 3px 10px;
            float: left;
            margin-right: 10px;
            user-select: none;
            cursor: move;
            font-size: 15px;
            margin-bottom: 10px;
            z-index: 999999999;
            height: auto!important;
        }

        .bb-placeholder-area {
            min-height: 100px;
            box-shadow: 0 0 0 1px rgba(0,0,0,0.15);
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAQAAAAECAYAAACp8Z5+AAAADklEQVQIW2NgQAXGZHAAGioAza6+Hk0AAAAASUVORK5CYII=);
        }

        .bb-drop-inside{
            outline: 2px dashed red;
        }

        .row.grid-overlay{
            position: relative;
        }

        .row.grid-overlay:before {
            content: "";
            width: 100%;
            height: 100%;
            position: absolute;
            background: url(http://mainbug.local/public/images/grid_overlay.png) repeat-y;
            opacity: 0.3;
            background-size: contain;
        }

        /* Sample Classes */
        .class-1{
            background: red;
            border: 2px solid green;
        }
        .class-2{
            background: green;
            border: 2px solid yellow;
        }
        .class-3{
            background: yellow;
            border: 2px solid red;
        }
    </style>
</script>

<script>
    $(document).ready(function () {

        @if(isset($form) and $form->fields_json)
        // Default values
        var iframe = $('#unit-iframe');
        var fieldsJSON = {!! $form->fields_json !!};
        var unitJSON = {!! $form->unit_json !!};
        var layout = '{!! $form->form_layout !!}';

        iframe.attr("src", "{!! url("/admin/uploads/gears/settings-iframe/") !!}/" + layout);
        @endif
    });
</script>

<div class="bb-hover-marker bb-hover-marker-padding bb-hover-marker-padding-top"></div>
<div class="bb-hover-marker bb-hover-marker-padding bb-hover-marker-padding-bottom"></div>
<div class="bb-hover-marker bb-hover-marker-padding bb-hover-marker-padding-left"></div>
<div class="bb-hover-marker bb-hover-marker-padding bb-hover-marker-padding-right"></div>
<div class="bb-hover-marker bb-hover-marker-margin bb-hover-marker-margin-top"></div>
<div class="bb-hover-marker bb-hover-marker-margin bb-hover-marker-margin-bottom"></div>
<div class="bb-hover-marker bb-hover-marker-margin bb-hover-marker-margin-left"></div>
<div class="bb-hover-marker bb-hover-marker-margin bb-hover-marker-margin-right"></div>
<div class="bb-hover-marker bb-hover-marker-size"></div>
<div class="bb-hover-marker-element"></div>

<div class="bb-node-action-menu">
    <i class="fa fa-arrows bb-node-move"></i>
    {{--<i class="fa fa-trash bb-node-delete"></i>--}}
    {{--<i class="fa fa-paint-brush bb-node-edit"></i>--}}
    {{--<i class="fa fa-font bb-node-edit"></i>--}}
</div>

<div class="bb-breadcrumb-action-menu">
    <i class="fa fa-trash bb-node-delete"></i>
    <i class="fa fa-paint-brush bb-node-edit"></i>
    <i class="fa fa-font bb-node-content"></i>
    <i class="fa fa-code bb-node-code"></i>
    <i class="fa fa-copy bb-node-duplicate"></i>
</div>

<div class="bb-node-active-title"></div>

<div class="bb-node-action-size"></div>

<div class="bb-drop-placeholder"><span>Drop Here</span></div>


</body>
</html>