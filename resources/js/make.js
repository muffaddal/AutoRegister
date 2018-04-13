$(function () {

    $('#makeAutoManufacturer').on('submit', function (e) {
        e.preventDefault();

        var sd = validateForm(['manufacturer']);

        makeManufacturer();

    });
});

// Validating form inputs
function validateForm(input_fields) {

    $.each(input_fields, function (key, val) {
        if (!$("#" + val).val().trim()) {
            alert("Please provide " + val);
            exit();
        }
    });
}

// Inserting new Make
function makeManufacturer() {

    $.ajax({

        type: 'POST',
        url: ajaxUrl + '/makeAutoManufacturer.php',
        data: $('#makeAutoManufacturer').serialize(),

        success: function (data) {
            console.log(data);
            return false;
            var form_clear = $('#makeAutoManufacturer')[0].reset();

            $("#makeSuccess").hide();
            $("#makeFailure").hide();

            if (data == 1) {
                $("#makeSuccess").show();
            } else {
                $("#makeFailure").show();
            }
        }
    });
}