<script type="template/html" id="element-section-settings">
    <div class="element-settings-tabs">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#style" aria-controls="profile" role="tab" data-toggle="tab">Style</a>
            </li>
            <li role="presentation">
                <a href="#layout" aria-controls="profile" role="tab" data-toggle="tab">Layout</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="style">
                <div class="form-group">
                    <label>Container Class</label>
                    <select name="" id="" class="form-control"></select>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="layout">
                @php
                    $layouts = ["3-3-3-3", "3-3-6", "3-6-3", "3-9", "4-4-4", "6-3-3", "6-6", "9-3", "12"];
                @endphp

                @foreach($layouts as $layout)
                    <label>
                        <input type="radio" value="{{$layout}}" name="bb-layout-select"/>
                        <img src="{!! url('public/images/layouts/cols-'.$layout.'.png') !!}"/>
                    </label>
                @endforeach

                <button class="btn btn-primary apply-layout" data-id="{id}">Apply Layout</button>
            </div>
        </div>
    </div>
</script>

<script type="template/html" id="element-parent-column-settings">
    <div class="element-settings-tabs">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#style" aria-controls="home" role="tab" data-toggle="tab">Style</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="style">
                <div class="form-group">
                    <label>Container Class</label>
                    <select name="" id="" class="form-control"></select>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="template/html" id="element-item-column-settings">
    <div class="column-type form-group">
        <div class="form-group">
            <label>Column Type</label>
            <select id="column-type" class="form-control">
                <option value="item-column">Item column</option>
                <option value="parent-column">Parent column</option>
            </select>
        </div>
        <button class="btn btn-info change-column-type" data-id="{id}">Apply Change</button>
    </div>
    <div class="element-settings-tabs">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#style" aria-controls="profile" role="tab" data-toggle="tab">Style</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="style">
                <div class="form-group">
                    <label>Container Class</label>
                    <select name="" id="" class="form-control"></select>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="template/html" id="elements-panel">
    <div class="element-settings-tabs">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#elements" role="tab"
                   aria-controls="home" aria-selected="true">HTML Elements</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#fields" role="tab" aria-controls="profile"
                   aria-selected="false">Fields</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#units" role="tab" aria-controls="contact"
                   aria-selected="false">Units</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="elements">
                @include('forms::settings.html_elements')
            </div>
            <div role="tabpanel" class="tab-pane" id="fields">
                <div class="fields-container"></div>
            </div>
            <div role="tabpanel" class="tab-pane" id="units">

            </div>
        </div>
    </div>
</script>

<script type="template/html" id="form-settings-template">
    @include('forms::settings.form_settings')
</script>

<script type="template/html" id="bbt-text-content">
    <div class="form-group">
        <label>Text Content</label>
        <select name="" id="" class="form-control">
            <option value="">Custom Text</option>
            <option value="">Custom Style</option>
            <option value="">Studio</option>
        </select>

        <textarea id="text-content" class="form-control" rows="4"></textarea>
    </div>
</script>

<script type="template/html" id="bbt-image-content">
    <div class="form-group">
        <label>Image Content</label>
        <textarea id="image-content" class="form-control" rows="4"></textarea>
    </div>
</script>

<script type="template/html" id="bbt-link-content">
    <div class="form-group">
        <label>Link Content</label>
        <textarea id="link-content" class="form-control" rows="4"></textarea>
    </div>
</script>

<!-- Edit Element Panel -->
<script type="template/html" id="bbt-edit-panel">
    <div class="p-2" id="element-edit-panel">
        <div class="card mb-2">
            <div class="card-body p-2">
                <input type="text" class="element-classes"/>

                <a href="#" class="btn btn-primary btn-sm ml-1 float-right open-add-class-panel"><i
                            class="fa fa-plus"></i></a>

                <a href="#" class="btn btn-primary btn-sm float-right open-edit-class-panel"><i
                            class="fa fa-pencil"></i></a>
            </div>
        </div>

        <!-- Available Classes -->
        <div class="bb-type-panel mb-2 bb-css-add-panel">
            <input type="text" class="form-control form-control-sm mb-2" placeholder="Search Available Classes"/>

            <div class="class-list">
                <div class="class-item badge badge-warning" data-class="class-1">Class 1</div>
                <div class="class-item badge badge-warning" data-class="class-2">Class 2</div>
                <div class="class-item badge badge-warning" data-class="class-3">Class 3</div>
            </div>
        </div>

        <!-- CSS Editor -->
        <div class="card bb-type-panel mb-2 bb-css-edit-panel">
            <div class="card-header p-2">
                <select id="bb-new-class-type">
                    <option value="css-editor">CSS Editor</option>
                    <option value="css-studio">Studio</option>
                </select>

                <a href="#" class="btn btn-primary btn-sm float-right apply-custom-class">Apply Class</a>
            </div>
            <div class="card-body p-2">
                <div id="css-editor" class="css-edit-option"></div>
                <div id="css-studio" class="css-edit-option">
                    Loading studio...
                </div>
            </div>
        </div>

    </div>
</script>

<script type="template/html" id="bbt-code-editor-bar">
    <select id="code-editor-theme">
        <option value="chrome">chrome</option>
        <option value="clouds">clouds</option>
        <option value="crimson_editor">crimson_editor</option>
        <option value="tomorrow_night"selected="selected">tomorrow_night</option>
        <option value="dawn">dawn</option>
        <option value="dreamweaver">dreamweaver</option>
        <option value="eclipse">eclipse</option>
        <option value="github">github</option>
        <option value="solarized_light">solarized_light</option>
        <option value="textmate">textmate</option>
        <option value="tomorrow">tomorrow</option>
        <option value="xcode">xcode</option>
        <option value="kuroir">kuroir</option>
        <option value="katzen_milch">katzen_milch</option>
        <option value="ambiance">ambiance</option>
        <option value="chaos">chaos</option>
        <option value="clouds_midnight">clouds_midnight</option>
        <option value="cobalt">cobalt</option>
        <option value="idle_fingers">idle_fingers</option>
        <option value="kr_theme">kr_theme</option>
        <option value="merbivore">merbivore</option>
        <option value="merbivore_soft">merbivore_soft</option>
        <option value="mono_industrial">mono_industrial</option>
        <option value="monokai">monokai</option>
        <option value="pastel_on_dark">pastel_on_dark</option>
        <option value="solarized_light">solarized_light</option>
        <option value="terminal">terminal</option>
        <option value="tomorrow_night_blue">tomorrow_night_blue</option>
        <option value="tomorrow_night_bright">tomorrow_night_bright</option>
        <option value="tomorrow_night_80s">tomorrow_night_80s</option>
        <option value="twilight">twilight</option>
        <option value="vibrant_ink">vibrant_ink</option>
    </select>
</script>

<script type="template/html" id="bbt-container-style">
    <div class="form-group">
        <label>Container Class</label>
        <select name="" id="" class="form-control"></select>
    </div>
</script>

<script type="template/html" id="element-settings">
    <div class="element-settings-tabs">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a href="#content" class="nav-link active" data-toggle="tab">Content</a>
            </li>
            <li class="nav-item">
                <a href="#style" class="nav-link" role="tab" data-toggle="tab">Style</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="content">
                {content}
            </div>
            <div role="tabpanel" class="tab-pane" id="style">
                {style}
            </div>
        </div>
    </div>
</script>