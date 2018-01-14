/*
 * Convert JSON to menu elements
 *
 * Copyright (c) 2017 Mohamed Tawfik
 * Licensed under the MIT license.
 */

(function($) {

    $.fn.fieldBuilder = function (settings){
        $.fieldBuilder(settings);
    };

    $.fieldBuilder = function( options ) {
        // Override default options with passed-in options.
        var settings = $.extend({}, $.fieldBuilder.options, options);

        var ID = settings.fieldType + '_' + Math.random().toString(36).substr(2, 9);

        if(settings.fieldID){
            ID = settings.fieldID;
        }

        var fieldHTML = '',
            fieldName = ID;

        if(settings.name){
            fieldName = settings.name;
        }

        var fieldTemplate = settings.fieldTemplate;

        // Switch types
        switch (settings.fieldType) {
            // Input fields "text, number, email, url"
            case 'text':
            case 'number':
            case 'email':
            case 'url':
                fieldHTML = '<input name="{name}" type="' + settings.fieldType + '" class="form-control" placeholder="{placeholder}" />';
                break;

            case 'textarea':
                fieldHTML = '<textarea name="{name}" class="form-control" placeholder="{placeholder}"></textarea>';
                break;

            case 'select':
                fieldHTML = '<select name="{name}" class="form-control">';
                fieldHTML += '</select>';
                break;
        }

        fieldHTML = fieldHTML.replace(/{placeholder}/g, settings.placeholder);
        fieldHTML = fieldHTML.replace(/{name}/g, fieldName);

        // Insert into template
        fieldTemplate = fieldTemplate.replace(/{label}/g, settings.label);
        fieldTemplate = fieldTemplate.replace(/{id}/g, ID);
        fieldTemplate = fieldTemplate.replace(/{type}/g, settings.fieldType);
        fieldTemplate = fieldTemplate.replace(/{icon}/g, settings.icon);
        fieldTemplate = fieldTemplate.replace(/{help}/g, settings.help);
        fieldTemplate = fieldTemplate.replace(/{tooltip_icon}/g, settings.tooltip_icon);

        fieldTemplate = fieldTemplate.replace(/{field}/g, fieldHTML);

        return fieldTemplate;

    };

    // Default plugin options
    $.fieldBuilder.options = {
        // Default options
        fieldID: null,
        fieldType	 : 'text',
        label: 'Field Label',
        placeholder: 'Field Placeholder',
        fieldTemplate: ''

        // Callbacks
    };

}(jQuery));