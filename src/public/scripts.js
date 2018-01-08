$(function () {
    $("body").on('input', '.form-title-settings', function () {
        var val = $(this).val();

        $(".form-title").text(val);
    });

    $("body").on('change', '.select-field', function () {
        var checkbox = this;
        var field = $(checkbox).val();
        if (checkbox.checked) {
            var table = "posts";
            $.ajax({
                url: "/admin/blog/render-fields",
                data: {table: table, field: field},
                headers: {
                    'X-CSRF-TOKEN': $("input[name='_token']").val()
                },
                dataType: 'json',
                success: function (data) {
                    if (!data.error) {
                        $(".field-box").append(data.html);
                    }
                },
                type: 'POST'
            });
            // alert($(checkbox).val());
        } else {

            $("#bty-input-id-" + $(checkbox).data('id')).remove();
        }
    });


    $('button[data-action=save-form]').on('click', function () {
        var data = $('#fields-list').serialize();
        $.ajax({
            url: "/admin/blog/save-form",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $("input[name='_token']").val()
            },
            dataType: 'json',
            success: function (data) {
                if (!data.error) {
                    window.location.href = "/admin/blog/form-list";
                }
            },
            type: 'POST'
        });
    });
});