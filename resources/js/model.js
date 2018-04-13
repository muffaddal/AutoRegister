$(function() {

    $('#makeModel').on('submit', function(e) {

        e.preventDefault();

        validateForm([
            'name',
            'note',
            'year',
            'color',
            'reg_number',
            'manufacturer_id'
        ]);

        insertModel();

    });
});


function insertModel() {

    var form = $("#makeModel");

    var formData = new FormData(form[0]);

    var files = form.find("#images")[0].files;

    console.log(files);

    $.each(files, function(key, val) {
        var file = $(this);
        formData.append(key, file[0]);
    });

    $.ajax({
        type: "POST",
        url: ajaxUrl + '/makeAutoModel.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {

            $("#modelSuccess").hide();
            $("#modelFailure").hide();

            if (data == true) {
                $('#makeModel')[0].reset();
                $("#modelSuccess").show();
            } else {
                $("#modelFailure").show();
                $("#modelFailure").append("<br>" + data);
            }
        }

    });
}