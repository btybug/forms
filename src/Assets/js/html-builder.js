(function ($, undefined) {
    "use strict";
    $.jstree.plugins.noclose = function () {
        this.close_node = $.noop;
    };
})(jQuery);

$.fn.extend({
    pixels: function (property, base) {
        var value = $(this).css(property);
        var original = value;
        var outer = property.indexOf('left') !== -1 || property.indexOf('right') !== -1
            ? $(this).parent().outerWidth()
            : $(this).parent().outerHeight();

        // EM Conversion Factor
        base = base || 16;

        if (value === 'auto' || value === 'inherit')
            return outer || 0;

        value = value.replace('rem', '');
        value = value.replace('em', '');

        if (value !== original) {
            value = parseFloat(value);
            return value ? base * value : 0;
        }

        value = value.replace('pt', '');

        if (value !== original) {
            value = parseFloat(value);
            return value ? value * 1.333333 : 0; // 1pt = 1.333px
        }

        value = value.replace('%', '');

        if (value !== original) {
            value = parseFloat(value);
            return value ? (outer * value / 100) : 0;
        }

        value = value.replace('px', '');
        return parseFloat(value) || 0;
    }
});

function cssPath(el) {
    var fullPath = 0,  // Set to 1 to build ultra-specific full CSS-path, or 0 for optimised selector
        useNthChild = 0,  // Set to 1 to use ":nth-child()" pseudo-selectors to match the given element
        cssPathStr = '',
        testPath = '',
        parents = [],
        parentSelectors = [],
        tagName,
        cssId,
        cssClass,
        tagSelector,
        vagueMatch,
        nth,
        i,
        c;

    // Go up the list of parent nodes and build unique identifier for each:
    vagueMatch = 0;

    // Get the node's HTML tag name in lowercase:
    tagName = el.nodeName.toLowerCase();

    // Get node's ID attribute, adding a '#':
    cssId = (el.id) ? ('#' + el.id) : false;

    // Get node's CSS classes, replacing spaces with '.':
    cssClass = (el.className) ? ('.' + el.className.replace(/\s+/g, ".")) : '';

    // Build a unique identifier for this parent node:
    if (cssId) {
        // Matched by ID:
        tagSelector = tagName + cssId + cssClass;
    } else if (cssClass) {
        // Matched by class (will be checked for multiples afterwards):
        tagSelector = tagName + cssClass;
    } else {
        // Couldn't match by ID or class, so use ":nth-child()" instead:
        vagueMatch = 1;
        tagSelector = tagName;
    }

    // Add this full tag selector to the parentSelectors array:
    parentSelectors.unshift(tagSelector);


    // Build the CSS path string from the parent tag selectors:
    for (i = 0; i < parentSelectors.length; i++) {
        cssPathStr += ' ' + parentSelectors[i];// + ' ' + cssPathStr;

        // If using ":nth-child()" selectors and this selector has no ID / isn't the html or body tag:
        if (useNthChild && !parentSelectors[i].match(/#/) && !parentSelectors[i].match(/^(html|body)$/)) {

            // If there's no CSS class, or if the semi-complete CSS selector path matches multiple elements:
            if (!parentSelectors[i].match(/\./) || $(cssPathStr).length > 1) {

                // Count element's previous siblings for ":nth-child" pseudo-selector:
                for (nth = 1, c = el; c.previousElementSibling; c = c.previousElementSibling, nth++) ;

                // Append ":nth-child()" to CSS path:
                cssPathStr += ":nth-child(" + nth + ")";
            }
        }

    }

    // Return trimmed full CSS path:
    return cssPathStr.replace(/^[ \t]+|[ \t]+$/, '');
}

function isColumn(text){
    return text.indexOf("col") !== -1;
}

function getNodeGroup(node) {
    var nodeTag = node.tagName.toLowerCase();
    var nodeGroup = nodeTag;

    if ($.inArray(nodeTag, ["button"]) !== -1) nodeGroup = "Button";
    if ($.inArray(nodeTag, ["h1", "h2", "h3", "h4", "h5", "h6", "span", "p"]) !== -1) nodeGroup = "Text";

    if ($.inArray(nodeTag, ["input"]) !== -1) {
        if (node.attributes.type) {
            var inputType = node.attributes.type.nodeValue;
            if ($.inArray(inputType, ["submit", "reset", "button"]) !== -1) nodeGroup = "Button";
        }
    }

    if (node.attributes.class && node.attributes.class.nodeValue) {
        var nodeClasses = node.attributes.class.nodeValue;
        if (nodeClasses.indexOf("row") !== -1) nodeGroup = "Row";
        if (nodeClasses.indexOf("col-") !== -1) nodeGroup = "Column";
        if (nodeClasses.indexOf("container") !== -1) nodeGroup = "Container";
        if (nodeClasses.indexOf("main-wrapper") !== -1) nodeGroup = "Wrapper";
    }

    if (node.attributes["data-field-id"]) nodeGroup = "Field";

    return nodeGroup;
}

var DOMCounter = 0;

function DOMtoJSON(node) {
    node = node || this;

    // DOM Counter
    DOMCounter++;
    $(node).attr("data-bb-id", DOMCounter);

    var obj = {
        nodeType: node.nodeType,
        id: "j-node-" + DOMCounter
    };
    if (node.tagName) {
        obj.tagName = node.tagName.toLowerCase();
    }

    if (node.nodeName) {
        obj.nodeName = node.nodeName;
    }

    if (node.nodeValue) {
        obj.nodeValue = node.nodeValue;
    }

    var attrs = node.attributes;
    var nodeClass = "", nodeID = "";
    if (attrs) {
        var length = attrs.length;
        var arr = obj.attributes = new Array(length);
        for (var i = 0; i < length; i++) {
            var attr = attrs[i];
            arr[i] = [attr.nodeName, attr.nodeValue];

            if (attr.nodeName === "class") nodeClass = attr.nodeValue;
            if (attr.nodeName === "id") nodeID = attr.nodeValue;
        }
    }

    var nodeIcon = "fa-eye";
    var nodeGroup = getNodeGroup(node);

    obj.icon = "fa " + nodeIcon;

    var nodeGroupID = nodeGroup + " #" + DOMCounter;
    var nodeGroupType = nodeGroup.toLowerCase().replace(" ", "-");

    if (nodeGroup !== "NODE") {
        nodeGroupID += '<a href="#" class="bb-node-btn bb-node-edit" data-type="' + nodeGroupType + '" data-id="' + DOMCounter + '"><i class="fa fa-pencil"></i></a>';
    }

    if (nodeGroup !== "Wrapper") {
        nodeGroupID += '<a href="#" class="bb-node-btn bb-node-delete" data-id="' + DOMCounter + '"><i class="fa fa-trash"></i></a>';
    }

    if (nodeGroup === "Wrapper" || nodeGroup === "Container" || nodeGroup === "Row") {
        nodeGroupID += '<a href="#" class="bb-node-btn bb-add-section" data-type="' + nodeGroup + '" data-id="' + DOMCounter + '"><i class="fa fa-plus"></i></a>';
    }

    nodeGroupID = '<span class="bb-node-' + nodeGroup.toLowerCase() + '">' + nodeGroupID + '</span>';


    obj.text = nodeGroupID;

    obj.bbID = DOMCounter;
    obj.state = {
        opened: true
    };

    // Check if children loop required
    var childNodes = node.childNodes;
    var childrenLoop = true;

    if (!childNodes || childNodes.length === 0) {
        $(node).addClass('bb-placeholder-area');
        childrenLoop = false;
    }

    if (nodeGroup === "Field") childrenLoop = false;
    // if(node.attributes["bb-group"]) childrenLoop = false;

    if (childrenLoop) {
        var cleanNodes = [];
        for (i = 0; i < childNodes.length; i++) {
            if (childNodes[i].nodeName !== "#text") {
                cleanNodes.push(childNodes[i]);
            }
        }

        length = cleanNodes.length;
        obj.children = [];
        for (i = 0; i < length; i++) {
            var children = DOMtoJSON(cleanNodes[i]);
            obj.children.push(children);
        }
    }

    return obj;
}

var fieldsJSON;

$(document).ready(function () {
    $("body")
        // Disabled tabs
        .on("click", '#settings-tabs>.disabled', function () {
            return false;
        })
        // Change column type
        .on("click", '.change-column-type', function () {
            var iframe = getIframeContent();
            var selectedType = $('#column-type').val(),
                nodeID = $(this).data('id');

            iframe.find('[data-bb-id=' + nodeID + ']')
                .removeClass('item-column')
                .addClass('parent-column')
                .html('<div class="row bb-section"><div class="col-md-12 item-column"></div></div>');

            // ReGenerate tree list
            generateDOMTree();

            // Recall column identification
            onFrameLoaded();
        })
        // Node edit
        .on("click", '.bb-node-edit', function () {
            editNode($(this).data("type"), $(this).data("id"));
        })
        // Node edit
        .on("click", '.bb-node-delete', function () {
            var iframe = getIframeContent();

            var nodeID = $(this).data("id"),
                node = iframe.find("[data-bb-id=" + nodeID + "]");

            node.remove();
            generateDOMTree();
        })
        // Column Content
        .on("click", '.bb-column-content', function () {
            var nodeID = $(this).data('id'),
                template = $('#column-content').html();

            template = template.replace('{id}', nodeID);

            jsPanel.create({
                container: 'body',
                theme: 'primary',
                headerTitle: 'Section Layout',
                position: 'left-bottom 0 50',
                contentSize: '450 300',
                content: template
            });
        })
        // Section columns
        .on("click", '.bb-section-columns', function () {
            var nodeID = $(this).data('id'),
                template = $('#section-layout-template').html();

            template = template.replace('{id}', nodeID);

            jsPanel.create({
                container: 'body',
                theme: 'primary',
                headerTitle: 'Section Layout',
                position: 'center-bottom 0 50',
                contentSize: '450 200',
                content: template
            });
        })
        // Apply layout
        .on('click', '.apply-layout', function () {
            var iframe = getIframeContent();
            var section = iframe.find('[data-bb-id=' + $(this).data("id") + ']');

            var columnString = $('[name=bb-layout-select]:checked').val(),
                columnArray = columnString.split("-");

            var columnHTML = "";

            $.each(columnArray, function (index, columnClass) {
                columnHTML += '<div class="col-md-' + columnClass + ' item-column"></div>';
            });

            section.html(columnHTML);

            // ReGenerate tree list
            generateDOMTree();

            // Recall column identification
            onFrameLoaded();
        })
        // Add section
        .on("click", '.bb-add-section', function () {
            var iframe = getIframeContent();

            var $this = $(this),
                type = $this.data("type"),
                wrapper = iframe.find('[data-bb-id="' + $this.data("id") + '"]'),
                template = "";

            if (type === "Container" || type === "Row") {
                $('.add-item-trigger').trigger("click");
                return;
            }

            if (type === "Wrapper") {
                template = '<div class="container" />';
            }

            wrapper.append(template);

            // ReGenerate tree list
            generateDOMTree();

            // Recall column identification
            onFrameLoaded();
        })
        // Open layers panel
        .on("click", '.open-layers-panel', function () {
            if ($(this).hasClass("disabled")) return;

            DOMCounter = 0;

            jsPanel.create({
                id: 'layers-panel',
                container: 'body',
                theme: 'primary',
                headerTitle: 'Layers',
                position: 'left-bottom 5 -20',
                contentSize: '450 250',
                content: '<div id="layers-tree"></div>',
                callback: function () {
                    $('.open-layers-panel').addClass("disabled");

                    // Load DOM tree
                    generateDOMTree();
                },
                onclosed: function () {
                    var iframe = getIframeContent();
                    $('.open-layers-panel').removeClass("disabled");
                    iframe.find('[data-bb-id]').removeAttr("data-bb-hovered");
                }
            });
        })
        // Add field trigger
        .on("click", '.add-item-trigger', function () {
            var template = $('#elements-panel').html(),
                $this = $(this);

            if (!$(this).hasClass("opened")) {
                jsPanel.create({
                    id: 'items-panel',
                    container: 'body',
                    theme: 'primary',
                    headerTitle: 'Fields & Elements',
                    position: 'right-bottom -5 -20',
                    contentSize: '450 350',
                    content: template,
                    callback: function () {
                        $(".fields-container").html(fieldsJSON.html);

                        // Fields draggable
                        activateSortable();
                    },
                    close: function () {
                        $this.removeClass("opened");
                    }
                });
                $(this).addClass("opened");
            }
        })
        // Open settings panel
        .on("click", '.open-settings-panel', function () {
            var iframe = getIframeContent();
            $('#settings-panel').removeAttr("hidden");
            iframe.find('.previewcontent').removeClass('activeprevew');
        })
        // Close settings panel
        .on("click", '.close-settings-panel', function () {
            var iframe = getIframeContent();
            $('#settings-panel').attr("hidden", true);
            iframe.find('.previewcontent').addClass('activeprevew');
        })
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

            $('[name=types]:checked').each(function () {
                fields.push($(this).val());
            });

            if (fields.length < 1) {
                alert("Please select at least one field type");
                return;
            }

            addFieldsToFormArea(fields);
            $("#select-fields").addClass("hidden");
            iframe.find('.previewcontent').addClass('activeprevew');
        })
        // Change field settings
        .on('change', '[name=settings]', function () {
            var iframe = getIframeContent();

            var $this = $(this);
            var settings = JSON.parse($this.val()),
                selectedField = $('[name=selected-field]').val(),
                field = iframe.find('[data-field-id=' + selectedField + ']'),
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
    $('[name=form_layout]').on('change', function () {
        var layout = $(this).val();
        var iframe = $('#unit-iframe');

        iframe.attr("src", ajaxLinks.changeLayout + layout);
    });

    // Edit node
    function editNode(nodeType, nodeID) {
        var iframe = getIframeContent();

        // Node settings
        var templateHTML = $('#element-' + nodeType + '-settings').html();

        if (templateHTML) {
            templateHTML = templateHTML.replace("{id}", nodeID);
        } else {
            templateHTML = $('#element-settings').html();
            var node = iframe.find('[data-bb-id=' + nodeID + ']'),
                children = node.children();

            if (children.length > 0) {
                var content = '',
                    style = '';

                $.each(children, function (index, child) {
                    var childType = getNodeGroup(child);
                    var contentTemplate = $('#bbt-' + childType.toLowerCase() + '-content').html();
                    var styleTemplate = $('#bbt-' + childType.toLowerCase() + '-style').html();

                    if (contentTemplate) {
                        content += contentTemplate;
                    }

                    if (styleTemplate) {
                        style += styleTemplate;
                    }
                });

                templateHTML = templateHTML.replace("{content}", content);
                templateHTML = templateHTML.replace("{style}", style);
            }

        }

        // Apply panel content
        $('.settings-panel-content').html(templateHTML);

        // Show panel
        $('#settings-panel').removeClass("hidden");
        iframe.find('.previewcontent').removeClass('activeprevew');
    }

    // Generate DOM tree
    function generateDOMTree() {
        DOMCounter = 0;

        var iframe = getIframeContent();

        // Remove placeholder
        iframe.find('.bb-placeholder-area').removeClass("bb-placeholder-area");

        // Generate tree
        var DOMTree = DOMtoJSON(iframe.find('.bb-main-wrapper')[0]);
        var layersTree = $('#layers-tree');

        // Clean tree if exists
        if ($.jstree.reference(layersTree)) {
            layersTree.jstree(true).settings.core.data = DOMTree;
            layersTree.jstree(true).refresh();
            return;
        }

        layersTree
            .jstree({
                "core": {
                    "animation": 0,
                    "check_callback": true,
                    "themes": {"stripes": true},
                    'data': DOMTree
                },
                "plugins": [
                    "wholerow", "noclose", "dnd"
                ]
            })
            .bind("hover_node.jstree", function (e, data) {
                // Add hover effect for hovered node
                var domNode = iframe.find('[data-bb-id="' + data.node.original.bbID + '"]');

                // Hover nodes
                hoverNode(domNode);
            })
            .on("select_node.jstree", function (e, data) {
                // Activate node
                var domNode = iframe.find('[data-bb-id="' + data.node.original.bbID + '"]');
                activateNode(domNode);
            });
    }

    function onFrameLoaded() {
        var iframe = getIframeContent();

        // Mark sortable areas
        iframe.find('.item-column').each(function (i) {
            var itemID = $(this).data("bb-id");
            if ($(this).find('[data-sortable]').length === 0) {
                $(this).append('<div data-sortable="' + itemID + '"></div>');
            }
        });

        // Open layers panel
        $('.open-layers-panel').trigger("click");

        // Close settings panel
        $('.close-settings-panel').trigger("click");

        // Context menu
        iframe.contextMenu({
            selector: '.has-context-menu',
            position: function (opt, x, y) {
                opt.$menu.css({top: y + 95, left: x});
            },
            items: {
                "edit": {name: "Edit", icon: "edit"},
                "cut": {name: "Cut", icon: "cut"},
                copy: {name: "Copy", icon: "copy"},
                "paste": {name: "Paste", icon: "paste"},
                "delete": {name: "Delete", icon: "delete"},
                "sep1": "---------",
                "quit": {
                    name: "Quit", icon: function () {
                        return 'context-menu-icon context-menu-icon-quit';
                    }
                }
            }
        });

        // Activate sortable
        activateSortable();
    }

    // iFrame functions
    $('#unit-iframe').load(function () {
        var headHTML = $('#iframe-inject-head').html();
        var iframe = getIframeContent();
        iframe.prepend(headHTML);

        // Enable settings tabs
        $('#settings-tabs>.disabled').removeClass("disabled");

        if ($('#settings-panel').data("state") === "open") {
            iframe.find('.previewcontent').removeClass("activeprevew");
        }

        // Load fields
        $.ajax({
            url: ajaxLinks.renderFields,
            headers: {
                'X-CSRF-TOKEN': $("input[name='_token']").val()
            },
            dataType: 'json',
            success: function (data) {
                fieldsJSON = data;
            },
            type: 'POST'
        });

        // Load saved fields
        if (typeof fieldsJSON !== "undefined") {
            $.each(fieldsJSON, function (index, areaJSON) {
                addFieldsToFormArea(areaJSON, index);
            });
        }

        // Unit settings
        if (typeof unitJSON !== "undefined") {
            $.each(unitJSON, function (key, value) {
                if (key !== "_token" && key !== "itemname") {
                    var field = iframe.find('#add_custome_page').find('[name=' + key + ']');
                    field.val(value);
                }
            });

            document.getElementById('unit-iframe').contentWindow.savesettingevent();
        }

        $('.layout-settings').click(function () {
            var $this = $(this);
            if ($this.hasClass('active')) {
                $this.removeClass('active');
                iframe.find('[data-settinglive="settings"]').addClass('hide');
                iframe.find('.previewcontent').addClass('activeprevew');
            } else {
                $this.addClass('active');
                iframe.find('[data-settinglive="settings"]').removeClass('hide');
                iframe.find('.previewcontent').removeClass('activeprevew');
            }
        });

        // On frame loaded
        onFrameLoaded();

        // Actions
        iframe
            .on("click", ".item-column>div", function () {
                var toggle = $(this).hasClass("active");
                iframe.find('.item-column>div').removeClass("active");
                iframe.find('.bb-form-actions').removeClass("active");

                if (!toggle) {
                    $(this).addClass("active");
                    $(this).closest('.item-column-container').find('.bb-form-actions').addClass("active");
                }
            })
            // Field settings
            .on('click', '.field-settings', function () {
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

                $.each(oldData, function (index, item) {
                    if (!isRemoved) {
                        var itemToRemoveIndex = item.indexOf(itemtoRemove);
                        if (itemToRemoveIndex !== -1) {
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
                $('#fields-backup').find('[data-field-id=' + itemtoRemove + ']').remove();
            })
            // Hover nodes
            .on('mouseover', '[data-bb-id]', function (e) {
                e.stopPropagation();

                // Check if the layers panel is open
                if (!$('.open-layers-panel').hasClass("disabled")) return;

                // Hover nodes
                hoverNode($(this));
            })
            // Hover parent node
            .on('mouseover', '.corepreviewSetting', function (e) {
                e.stopPropagation();
                hideHoverNode();
            })
            // On node click
            .on('click', '[data-bb-id]', function (e) {
                e.stopPropagation();

                var $this = $(this);

                // Activate node
                activateNode($this);

                // Check if the layers panel is open
                if (!$('.open-layers-panel').hasClass("disabled")) return;
                var nodeID = 'j-node-' + $this.attr("data-bb-id");
                var layersTree = $('#layers-tree');

                layersTree
                    .jstree("deselect_all")
                    .jstree(true).select_node(nodeID);

                layersTree.animate({
                    scrollTop: ($("#" + nodeID).position().top)
                }, 500);
            })
            // On node double click
            .on('dblclick', '[data-bb-id]', function (e) {
                e.stopPropagation();

                var nodeType = getNodeGroup(this);
                // editNode(nodeType.toLowerCase(), $(this).attr("data-bb-id"));
                hoverNode($(this));
            })
            .bind('scroll', function () {
                console.log("Ok");
            });
    });

    // Activate selected node
    function activateNode($this) {

        if(!$this.offset()) return;

        var iframe = $('#unit-iframe');
        var scrollTop = iframe.contents().scrollTop();
        var iframeTopFixer = iframe.offset().top - scrollTop;
        var width = $this.outerWidth(),
            height = $this.outerHeight(),
            left = $this.offset().left,
            top = $this.offset().top;

        var nodePath = cssPath($this.get(0));

        // Activate node
        var nodeActionMenu = $('.bb-node-action-menu'),
            nodeActionSize = $('.bb-node-action-size');

        nodeActionMenu
            .css({
                left: left + width - nodeActionMenu.outerWidth(),
                top: (top + iframeTopFixer) - nodeActionMenu.outerHeight()
            })
            .attr("data-selected-node", $this.attr("data-bb-id"));

        nodeActionSize.css({
            width: parseFloat(window.getComputedStyle($this.get(0)).width),
            height: height + 4,
            left: left,
            top: (top + iframeTopFixer) - 2
        });

        $('.bb-node-active-title').css({
            left: left,
            top: (top + iframeTopFixer) - nodeActionMenu.outerHeight()
        }).text(nodePath);

        // Add resize handler for columns
        var columnResizeHandler = $('.bb-column-resize-handler');
        columnResizeHandler.hide();

        nodeActionSize.css("pointer-events", "none");

        if(isColumn(nodePath)){

            nodeActionSize.css("pointer-events", "all");

            // Column resize
            var rowWidth = getActiveNodeEl().parent('.row').outerWidth(),
                columnWidth = rowWidth/12;

            console.log(columnWidth);

            var columnResize = $('.bb-node-action-size');

            if(columnResize.hasClass("ui-resizable")){
                columnResize.resizable("destroy");
            }

            columnResize.resizable({
                handles: 'e',
                grid: columnWidth,
                minWidth: 0.5,
                classes: {
                    "ui-resizable-e": "bb-column-resize-handler"
                },
                start: function (){
                    hideHoverNode();
                    $('#unit-iframe').css("pointer-events", "none");
                    getActiveNodeEl().parent('.row').addClass("grid-overlay");
                },
                stop: function (){
                    $('#unit-iframe').css("pointer-events", "all");
                    // getActiveNodeEl().parent('.row').removeClass("grid-overlay");
                },
                resize: function (event,ui){
                    hideHoverNode();
                    console.log("Resize");
                }
            });

            columnResizeHandler.show();
        }
    }

    function hoverNode($this) {

        if(!$this.offset()) return;

        var iframe = $('#unit-iframe');
        var scrollTop = iframe.contents().scrollTop();
        var iframeTopFixer = iframe.offset().top - scrollTop;

        var width = $this.outerWidth(),
            height = $this.outerHeight(),
            left = $this.offset().left,
            top = $this.offset().top,
            paddingLeft = $this.pixels("padding-left"),
            paddingRight = $this.pixels("padding-right"),
            paddingTop = $this.pixels("padding-top"),
            paddingBottom = $this.pixels("padding-bottom"),
            marginLeft = $this.pixels("margin-left"),
            marginRight = $this.pixels("margin-right"),
            marginTop = $this.pixels("margin-top"),
            marginBottom = $this.pixels("margin-bottom");

        // Element path
        $('.bb-hover-marker-element')
            .text(cssPath($this.get(0)))
            .css({
                left: left - 2,
                top: (top + iframeTopFixer) - 18
            });

        // Element Size
        $('.bb-hover-marker-size').css({
            width: width + 4,
            height: height + 4,
            left: left - 2,
            top: (top + iframeTopFixer) - 2
        });

        // Padding
        $('.bb-hover-marker-padding-top').css({
            width: width,
            height: paddingTop,
            left: left,
            top: (top + iframeTopFixer)
        });

        $('.bb-hover-marker-padding-bottom').css({
            width: width,
            height: paddingBottom,
            left: (left),
            top: (top + iframeTopFixer + height - paddingBottom)
        });

        $('.bb-hover-marker-padding-left').css({
            width: paddingLeft,
            height: height,
            left: (left),
            top: (top + iframeTopFixer)
        });

        $('.bb-hover-marker-padding-right').css({
            width: paddingRight,
            height: height,
            left: (left + width - paddingRight),
            top: (top + iframeTopFixer)
        });

        // Margin
        $('.bb-hover-marker-margin-top').css({
            width: width,
            height: marginTop,
            left: (left),
            top: (top + iframeTopFixer) - marginTop
        });

        $('.bb-hover-marker-margin-bottom').css({
            width: width,
            height: marginBottom,
            left: (left),
            top: (top + iframeTopFixer + height)
        });

        $('.bb-hover-marker-margin-left').css({
            width: marginLeft,
            height: height,
            left: (left - marginLeft),
            top: (top + iframeTopFixer)
        });

        $('.bb-hover-marker-margin-right').css({
            width: marginRight,
            height: height,
            left: (left + width),
            top: (top + iframeTopFixer)
        });
    }

    function hideHoverNode() {
        $('.bb-hover-marker').css({
            width: 0,
            height: 0,
            top: 'auto',
            bottom: -10,
            left: -10
        });

        $('.bb-hover-marker-element').text("");
    }

    function hideActiveNode() {
        $('.bb-node-action-menu').css({
            left: -200
        });

        $('.bb-node-action-size').css({
            width: 0,
            height: 0,
            left: -200
        });
    }

    function getIframeContent() {
        return $('#unit-iframe').contents().find('body');
    }

    // Add fields to form area
    function addFieldsToFormArea(fieldsJSON, position) {
        var iframe = getIframeContent();

        if (!position) position = 0;

        // Build form
        var fieldHTML = formBuilder(fieldsJSON, position);
        iframe.find('[data-bb-id=' + position + ']').html(fieldHTML);

        // Add field to backup
        $('#fields-backup').append(fieldHTML);

        // Tooltip
        iframe.find('[data-toggle="tooltip"]').tooltip();

        // Action buttons
        addActionsButton(iframe, position);
    }

    // Add action button to fields
    function addActionsButton(iframe, position) {
        iframe.find('[data-sortable=' + position + ']>.form-group').each(function () {
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

        var fieldsHTMLData = iframe.find('[data-bb-id=' + position + ']').html();

        $(fields).each(function (index, field) {
            // Render fields
            fieldsHTMLData += renderFormField(field);
        });

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

    // Get active node element
    function getActiveNodeEl(){
        var iframe = getIframeContent();
        return iframe.find('[data-bb-id=' + $('.bb-node-action-menu').attr("data-selected-node") + ']');
    }

    function allElementsFromPointIframe(x, y) {
        var iframe  = $('#unit-iframe');
        var offsetX = iframe.offset().left;
        var offsetY = iframe.offset().top;

        var element, elements = [];
        var old_visibility = [];
        while (true) {
            element = document.getElementById('unit-iframe').contentWindow.document.elementFromPoint(x - offsetX, y - offsetY);
            if (!element || element === document.getElementById('unit-iframe').contentWindow.document.documentElement) {
                break;
            }
            elements.push(element);
            old_visibility.push(element.style.visibility);
            element.style.visibility = 'hidden';
        }
        for (var k = 0; k < elements.length; k++) {
            elements[k].style.visibility = old_visibility[k];
        }

        return elements[0];
    }

    function hideDropPlaceholder(){
        $('.bb-drop-placeholder').css({
            left: -3000,
            width: 0
        });
    }

    // Where to drop
    var toDrop,
        toDropElement;

    function whereToDrop(el){

        var whereToDrop = null;

        if(el.offset()){
            var iframeEl = $('#unit-iframe');
            var scrollTop = iframeEl.contents().scrollTop();
            var iframeTopFixer = iframeEl.offset().top - scrollTop;

            var mouseTop = event.pageY,
                elTop = el.offset().top + iframeTopFixer,
                elHeight = el.outerHeight(),
                elQuart = elHeight/4;

            whereToDrop = 'inside';

            if(mouseTop <= (elTop+elQuart)) whereToDrop = 'above';
            if(mouseTop >= (elTop+elHeight-elQuart)) whereToDrop = 'below';
        }

        return whereToDrop;
    }

    // Activate sortable
    function activateSortable() {
        var iframe = getIframeContent();
        var iframeEl = $('#unit-iframe');
        var dropPlaceHolder = $('.bb-drop-placeholder');

        // Active node dragging
        var dropInsideClass = "bb-drop-inside";
        var scrollTop = iframeEl.contents().scrollTop();
        var iframeTopFixer = iframeEl.offset().top - scrollTop;

        if($('.bb-node-move').hasClass("ui-draggable")){
            $('.bb-node-move').draggable("destroy");
        }

        if($('.draggable-element').hasClass("ui-draggable")){
            $('.draggable-element').draggable("destroy");
        }

        $('.bb-node-move, .draggable-element')
            .draggable({
                appendTo: 'body',
                iframeFix: true,
                iframeOffset: iframeEl.offset(),
                helper: function (){

                    if($(this).hasClass("draggable-element")) return $(this).clone(false);

                    var activeNode = getActiveNodeEl()
                        .clone(false)
                        .css({
                            opacity: 0.5,
                            transform: "scale(0.33, 0.33)",
                            transformOrigin: "0 0"
                        });

                    $("body").append(activeNode);

                    return activeNode.get(0);
                }
            })
            .on("dragstart", function () {
                hideActiveNode();

                if($(this).hasClass("bb-node-move")){
                    getActiveNodeEl().hide();
                }
            })
            .on("drag", function (event) {
                $('.bb-hover-marker, .bb-hover-marker-element').hide();

                var el = $(allElementsFromPointIframe(event.pageX, event.pageY));
                toDrop = whereToDrop(el);
                toDropElement = el;

                console.log(el, toDrop);

                if(toDrop){
                    var elTop = el.offset().top + iframeTopFixer,
                        elLeft = el.offset().left,
                        elHeight = el.outerHeight();

                    iframe.find('.' + dropInsideClass).removeClass(dropInsideClass);

                    hideDropPlaceholder();

                    dropPlaceHolder.find('span').css({
                        left: el.outerWidth()/2 - 35
                    });

                    if(toDrop === "above"){
                        dropPlaceHolder.css({
                            top: elTop - 2,
                            left: elLeft,
                            width: el.outerWidth()
                        });
                    }

                    if(toDrop === "below"){
                        dropPlaceHolder.css({
                            top: elTop + elHeight + 2,
                            left: elLeft,
                            width: el.outerWidth()
                        });
                    }

                    if(toDrop === "inside"){
                        el.addClass(dropInsideClass);
                    }
                }else{
                    hideDropPlaceholder();
                }

            })
            .on("dragstop", function () {
                iframe.find('.' + dropInsideClass).removeClass(dropInsideClass);
                getActiveNodeEl().show();
                hideDropPlaceholder();
                $('.bb-hover-marker, .bb-hover-marker-element').show();

                var activeElement = getActiveNodeEl(),
                    removeActiveElement = true;

                if($(this).hasClass("draggable-element")){
                    activeElement = $(this).find('.html-element-item-sample').html();
                    removeActiveElement = false;
                }

                console.log(getNodeGroup($(activeElement).get(0)));

                // Move element
                if(toDrop === "above"){
                    toDropElement.before(activeElement);
                }

                if(toDrop === "below"){
                    toDropElement.after(activeElement);
                }

                if(toDrop === "inside"){
                    toDropElement.append(activeElement);
                }

                // if(removeActiveElement) getActiveNodeEl().remove();

                generateDOMTree();
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
        if (data.TODO) {

            var TODO = data.TODO;

            // On Save settings form
            if (TODO === "POST_SETTINGS_CALLBACK") {
                var json = data.json;
                $('[name="unit_json"]').val(JSON.stringify(json));

                // Reload frame
                onFrameLoaded();
            }

        }
    }
});