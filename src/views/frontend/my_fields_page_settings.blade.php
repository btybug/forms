@if($page)

    {!! Form::model($page,['url' => route('frontsite_settings',$id), 'id' => 'page_settings_form']) !!}
    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 col-xl-9 page-data p-20">
        <div class="panel panel-default custompanel m-t-20">
            <div class="panel-heading">Page Info</div>
            <div class="panel-body">
                <div class="row rows">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 row_inputs">
                        <i class="fa fa-file-text" aria-hidden="true"></i><span
                                class="labls">Page Name</span>
                        {!! Form::text('title',null,['class' => 'page_name form-control']) !!}
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 row_inputs">
                        <i class="fa fa-file-text" aria-hidden="true"></i><span
                                class="labls">Page URL</span>
                        @if($page->type == 'custom')
                            {!! Form::text('url',null,['class' => 'page_url form-control']) !!}
                        @else
                            <div class="page_address page_labels">{!! $page->url !!}</div>
                            {!! Form::hidden('url',null) !!}
                        @endif
                    </div>
                </div>
                {!! Btybug\btybug\Models\ContentLayouts\ContentLayouts::getPageLayout($page) !!}
            </div>
        </div>

        {!! Btybug\btybug\Models\ContentLayouts\ContentLayouts::getChildrenPageLayout($page) !!}

        <div class="panel panel-default custompanel m-t-20">
            <div class="panel-heading">All Hooks</div>
            <div class="panel-body all-hooks-content">
                @if($page->type != 'classify' && $page->type != 'tags')
                    {!! Btybug\btybug\Models\ContentLayouts\ContentLayouts::getPageLayoutHooks($page) !!}
                @endif
            </div>
        </div>

        <div class="panel panel-default custompanel m-t-20">
            <div class="panel-heading">Main Content
            </div>

            <div class="panel-body template_body">
                {!! BBbutton2('unit','template','forms_my_fields',"Change",['class'=>'btn btn-default change-layout','data-action'=>'main_content','model'=>$page]) !!}
            </div>
        </div>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 p-20">
        <div class="panel panel-default custompanel m-t-20">
            <div class="panel-heading">General</div>
            <div class="panel-body">
                <a href="javascript:void(0)" class="btn btn-info btn-block full-page-view m-b-5">Full Preview</a>
                {{ Form::submit('Save', array('class' => 'save_btn m-b-5 btn-block','style' => "width:100%;")) }}

                <div class="form-group">
                    <i class="fa fa-file-o" aria-hidden="true"></i>
                    <span class="labls">Status</span>
                    {!! Form::select('status',['draft' => 'Draft','published' => 'Published'],null,["class" => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <input type="hidden" id="page" value="{!! $page->id !!}">
    @include('resources::assests.magicModal')

    <div class="modal fade" id="area-settings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        {{--{!! Form::open(['url'=>'/admin/backend/theme-edit/live-save', 'id'=>'magic-form']) !!}--}}
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    {{--{!! Form::submit('Save',['class' => 'btn btn-success pull-right m-r-10']) !!}--}}
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body" style="min-height: 500px;">
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="checkboxes">Area access</label>
                        <div class="col-md-4">
                            {{--@php--}}
                            {{--$frontendRoles=new \Btybug\User\Repository\RoleRepository();--}}
                            {{--@endphp--}}
                            {{--@foreach($frontendRoles->getFrontRoles() as $role)--}}
                            {{--<div class="checkbox">--}}
                            {{--<label for="checkboxes-1">--}}
                            {{--{!! Form::checkbox('page_layout_settings[sidebar_left_roles][]',$role->slug,(isset($page->page_layout_settings['sidebar_left_roles']) && in_array($role->slug,$page->page_layout_settings['sidebar_left_roles']))?1:0) !!}--}}
                            {{--{!! $role->name !!}--}}
                            {{--</label>--}}
                            {{--</div>--}}
                            {{--@endforeach--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--{!! Form::close() !!}--}}
    </div>
@else
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 design_panel">
        <div class="published_1">
            NO Page
        </div>
    </div>
@endif
<div class="modal fade" id="full-page-view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <button class="btn close-live-edit" data-dismiss="modal" aria-label="Close">
                <span class="fa fa-power-off"></span>
            </button>
            <div class="modal-body">
                <div class="live-edit-menu">
                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            Action
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Some live action</a></li>
                            <li><a href="#">Some live Settings</a></li>
                            <li><a href="#">Some live etc</a></li>
                        </ul>
                    </div>
                </div>
                <div class="iframe-area"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="view-unit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Unit Preview</h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

@section('CSS')
    {!! HTML::style('public/css/create_pages.css') !!}
@stop
@section('JS')
    {!! HTML::script("public/js/UiElements/bb_styles.js?v.5") !!}
    {!! HTML::script('public/js/page-setting.js') !!}
    {!! HTML::script("public/js/UiElements/ui-preview-setting.js") !!}
    {!! HTML::script("public/js/UiElements/ui-settings.js") !!}
    {!! HTML::script("public/js/UiElements/bb_div.js") !!}
    {!! HTML::script('public/js/tinymice/tinymce.min.js') !!}

    <script>
        tinymce.init({
            selector: '#main_content', // change this value according to your HTML
            height: 200,
            theme: 'modern',
            plugins: [
                'advlist anchor autolink autoresize autosave bbcode charmap code codesample colorpicker contextmenu directionality emoticons fullscreen hr image imagetools importcss insertdatetime legacyoutput link lists media nonbreaking noneditable pagebreak paste preview print save searchreplace spellchecker tabfocus table template textcolor textpattern visualblocks visualchars wordcount shortcodes',
            ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help shortcodes',
            image_advtab: true
        });

        $(document).ready(function () {
            $("body").on("click", ".reset-placeholder", function () {
                var key = $(this).data("reset");
                $("[data-id=" + key + "]").val("");
                $("[data-name=" + key + "]").val("");
            });

            $("body").on("click", ".view-placeholder", function () {
                var key = $(this).data("view");
                $.ajax({
                    type: "post",
                    datatype: "json",
                    url: "/admin/console/bburl/render-unit",
                    data: {id: key},
                    headers: {
                        'X-CSRF-TOKEN': $('[name="_token"]').val()
                    },
                    success: function (data) {
                        $("#view-unit .modal-body").html(data.html);
                        $("#view-unit").modal();
                    }
                });
            });
        });
    </script>

@stop