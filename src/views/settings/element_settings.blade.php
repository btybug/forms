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
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#elements" role="tab" aria-controls="home" aria-selected="true">HTML Elements</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#fields" role="tab" aria-controls="profile" aria-selected="false">Fields</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#units" role="tab" aria-controls="contact" aria-selected="false">Units</a>
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

<script type="template/html" id="bbt-text-style">
    <div class="form-group">
        <label>Text Class</label>
        <select name="" id="" class="form-control">
            <option value="">Select Class</option>
            <option value="">Custom Style</option>
            <option value="">Studio</option>
        </select>
    </div>

    <div class="form-group">
        <label>Available Classes</label>
        <div class="html-elements-list">
            <div class="html-element-item">Class 1</div>
            <div class="html-element-item">Class 2</div>
            <div class="html-element-item">Class 3</div>
        </div>
    </div>
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