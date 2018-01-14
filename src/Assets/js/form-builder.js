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

$(document).ready(function () {
    $("body")
        // Save field settings
        .on("click", ".save-field-settings", function () {
            var iframe = getIframeContent();
            $("#field-settings").addClass("hidden");
            iframe.find('.previewcontent').addClass('activeprevew');
        })
        // Add field to form
        .on("click", ".add-to-form", function () {
            var fields = [];
            var iframe = getIframeContent();

            $('[name=types]:checked').each(function (){
                fields.push($(this).val());
            });

            if(fields.length < 1) {
                alert("Please select at least one field type");
                return;
            }

            addFieldsToFormArea(fields);
            $("#select-fields").addClass("hidden");
            iframe.find('.previewcontent').addClass('activeprevew');
        })
        // Change field settings
        .on('change', '[name=settings]', function (){
            var iframe = getIframeContent();

            var $this = $(this);
            var settings = JSON.parse($this.val()),
                selectedField = $('[name=selected-field]').val(),
                field = iframe.find('[data-field-id='+selectedField+']'),
                selectedType = field.data('field-type'),
                fieldTemplate = $('#field-template').html();

            settings = $.extend({}, settings, {
                fieldType: selectedType,
                fieldTemplate: fieldTemplate,
                fieldID: selectedField
            });

            var newFieldHTML = $.fieldBuilder(settings);
            field.after(newFieldHTML);
            field.remove();
        });

    // Change layout
    $('[name=form_layout]').on('change', function (){
        var layout = $(this).val();
        var iframe = $('#unit-iframe');

        iframe.attr("src", ajaxLinks.changeLayout + layout);
    });

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
                        existingFields = existingFields.concat(group);
                    });
                }

                $.ajax({
                    url: ajaxLinks.renderFields,
                    data: {table: table, fields: JSON.stringify(existingFields)},
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        $("#select-fields").removeClass("hidden");
                        $("#select-fields .fields-container").html(data.html);
                        iframe.find('.previewcontent').removeClass('activeprevew');
                    },
                    type: 'POST'
                });
            })
            // Field settings
            .on('click', '.field-settings', function (){
                var fieldID = $(this).closest('.form-group').data('field-id');
                var fieldType = $(this).closest('.form-group').data('field-type');
                $('[name=selected-field]').val(fieldID);

                $.ajax({
                    url: ajaxLinks.baseUrl + "ajax-type-settings/" + fieldType,
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    success: function (data) {
                        $('.field-settings-container').html(data);
                        $("#field-settings").removeClass("hidden");
                        iframe.find('.previewcontent').removeClass('activeprevew');
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
            existingFieldsData[position].push(field);

            // Render fields
            fieldsHTMLData += renderFormField(field);
        });

        // Add existing fields to hidden input
        existingFields.val(JSON.stringify(existingFieldsData));

        return fieldsHTMLData;
    }

    // Render fields HTML
    function renderFormField(field) {

        var fieldTemplate = $('#field-template').html();

        return $.fieldBuilder({
            fieldTemplate: fieldTemplate,
            fieldType: field
        });
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