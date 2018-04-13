$(function () {

    $('#listing_table').DataTable();

    $("td").addClass('model_details');

    $(".modal").on("hidden.bs.modal", function () {
        $(this).removeData();
    });

    // Modal popup dynamic data
    $('.view_details').on('click', function (e) {

        e.preventDefault();

        var model_id = $(this).attr('DB-id');

        $("body").find('.modal').attr("id", "myModal_" + model_id);

        $.ajax({
            type: 'POST',
            url: ajaxUrl + '/makeAutoModelDetails.php',
            data: {
                model_id: model_id
            },
            success: function (data) {

                var json = $.parseJSON(data);
                var model_id = json[0].id;
                $("#model_img_1").hide();

                var img_arr = json[0]['model_img'];

                // Loading multiple images in modal popup
                if (img_arr.indexOf(",") != -1) {

                    img_arr = img_arr.split(',');

                    $.each(img_arr, function (key, val) {
                        $("#model_img_1").show();
                        $("#model_img_" + key).attr('src', uploadsPath + val);
                    });

                } else if (img_arr) {

                    var img_path = uploadsPath + json[0].model_img;
                    $("#model_img_0").attr('src', img_path);

                } else {

                    img_path = "http://radior2b.com/wp-content/uploads/2014/12/placeholder_noImage_bw.png";
                    $("#model_img_0").attr('src', img_path);
                }


                $.each(json[0], function (key, val) {
                    // Renaming Sold status as unsold,
                    // setting up the sold status update link
                    if (key == "sold_status" && val == 0) {
                        val = "Unsold ";
                        val += "<a id='" + "set_sold_" + model_id + "' href='#'>Mark as Sold</a>";
                    }

                    $("#" + key).html(val);
                });

            },
        });

    });

    // Updating sold status 
    $("#sold_status").on('click', function (e) {

        if (confirm('Are you sure you want to mark this DB as sold?')) {

            var model_id = $(this).children()[0].id.split('set_sold_')[1];

            if (model_id !== null) {
                updateSoldStatus(model_id);
            }
        }
    });
});

function updateSoldStatus(model_id) {

    $.ajax({
        type: 'POST',
        url: ajaxUrl + '/makeAutoModelDetails.php',
        data: {
            sold_status: model_id
        },
        success: function (data) {
            $('.modal').modal('toggle');
            $("#model_row_" + model_id).html("");
        },
    });
}