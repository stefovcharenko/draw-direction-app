$(document).ready(function () {
    $('#flightvehicle-id').on('change', function () {
        var vehicle = ($('#flightvehicle-id :selected').val());
        if (vehicle) {
            $.ajax({
                url: '/flights/get-available-flights',
                type: "POST",
                data: {
                    vehicle: vehicle
                },
                success: function (response) {
                    $('.flights').html(response);
                }
            });
        }
    })
});