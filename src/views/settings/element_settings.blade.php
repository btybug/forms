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
                        <input type="radio" value="{{$layout}}" name="bb-layout-select" />
                        <img src="{!! url('public/images/layouts/cols-'.$layout.'.png') !!}" />
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
            <li role="presentation">
                <a href="#fields" aria-controls="profile" role="tab" data-toggle="tab">Fields</a>
            </li>
            <li role="presentation">
                <a href="#elements" aria-controls="profile" role="tab" data-toggle="tab">HTML Elements</a>
            </li>
            <li role="presentation">
                <a href="#units" aria-controls="profile" role="tab" data-toggle="tab">Units</a>
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
            <div role="tabpanel" class="tab-pane" id="fields">
                <div class="fields-container"></div>
            </div>
            <div role="tabpanel" class="tab-pane" id="elements">

            </div>
            <div role="tabpanel" class="tab-pane" id="units">

            </div>
        </div>
    </div>
</script>

<script type="template/html" id="element-button-settings">
    <div class="element-settings-tabs">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#content" aria-controls="home" role="tab" data-toggle="tab">Content</a>
            </li>
            <li role="presentation">
                <a href="#style" aria-controls="profile" role="tab" data-toggle="tab">Style</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="content">
                <div class="form-group">
                    <label>Text Content</label>
                    <textarea id="text-content" class="form-control" rows="4"></textarea>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="style">
                <div class="form-group">
                    <label>Text Class</label>
                    <select name="" id="" class="form-control"></select>
                </div>
                <div class="form-group">
                    <label>Container Class</label>
                    <select name="" id="" class="form-control"></select>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="template/html" id="element-image-settings">
    <div class="element-settings-tabs">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#content" aria-controls="home" role="tab" data-toggle="tab">Content</a>
            </li>
            <li role="presentation">
                <a href="#style" aria-controls="profile" role="tab" data-toggle="tab">Style</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="content">
                <div class="form-group">
                    <label>Image Content</label>
                    <select name="" id="" class="form-control"></select>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="style">
                <div class="form-group">
                    <label>Image Class</label>
                    <select name="" id="" class="form-control"></select>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="template/html" id="element-text-settings">
    <div class="element-settings-tabs">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#content" aria-controls="home" role="tab" data-toggle="tab">Content</a>
            </li>
            <li role="presentation">
                <a href="#style" aria-controls="profile" role="tab" data-toggle="tab">Style</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="content">
                <div class="form-group">
                    <label>Text Content</label>
                    <textarea id="text-content" class="form-control" rows="4"></textarea>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="style">
                <div class="form-group">
                    <label>Text Class</label>
                    <select name="" id="" class="form-control"></select>
                </div>
                <div class="form-group">
                    <label>Container Class</label>
                    <select name="" id="" class="form-control"></select>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="template/html" id="element-field-settings">
    <div class="element-settings-tabs">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#content" aria-controls="home" role="tab" data-toggle="tab">Content</a>
            </li>
            <li role="presentation">
                <a href="#style" aria-controls="profile" role="tab" data-toggle="tab">Style</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="content">
                <div class="form-group">
                    <label>Text Content</label>
                    <textarea id="text-content" class="form-control" rows="4"></textarea>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="style">
                <div class="form-group">
                    <label>Text Class</label>
                    <select name="" id="" class="form-control"></select>
                </div>
                <div class="form-group">
                    <label>Container Class</label>
                    <select name="" id="" class="form-control"></select>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="template/html" id="form-settings-template">
    @include('forms::settings.form_settings')
</script>