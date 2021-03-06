$(document).ready(function () {
    $('#flightvehicle-id').on('change', function () {
        $('.flights, .map').hide();
        var vehicle = ($('#flightvehicle-id :selected').val());
        if (vehicle) {
            $.ajax({
                url: '/flights/get-available-flights',
                type: "POST",
                data: {
                    vehicle: vehicle
                },
                success: function (response) {
                    $('.flights').html(response).show();
                }
            });
        }
    });

    $(document).on('change', '#flight-id', function () {
        $('.map').hide();
        var flight = ($('#flight-id :selected').val());
        if (flight) {
            $.ajax({
                url: '/flights/get-flight-map',
                type: "POST",
                data: {
                    flight: flight
                },
                success: function (response) {
                    $('.map').html(response).show();
                }
            });
        }
    });

    $('#add-coordinate').on('click', function () {
        var self = $(this);
        var flightForm = $('#flight-form');
        var counterText = self.data('counter');
        var counterNumber = Number(counterText);
        $.ajax({
            url: '/details/get-coordinates-template',
            type: "POST",
            data: {
                counter: counterNumber
            },
            success: function (response) {
                $('.coordinates-block').append(response);

                flightForm.yiiActiveForm('add', {
                    id: 'flightdetail-' + counterText + '-longitude',
                    name: '[' + counterText + ']longitude',
                    container: '.field-flightdetail-' + counterText + '-longitude',
                    input: '#flightdetail-' + counterText + '-longitude',
                    validate: function (attribute, value, messages, deferred, $form) {
                        yii.validation.required(value, messages, {message: "Необхідно заповнити \"Довгота\""});
                    }
                });
                flightForm.yiiActiveForm('add', {
                    id: 'flightdetail-' + counterText + '-latitude',
                    name: '[' + counterText + ']latitude',
                    container: '.field-flightdetail-' + counterText + '-latitude',
                    input: '#flightdetail-' + counterText + '-latitude',
                    validate: function (attribute, value, messages, deferred, $form) {
                        yii.validation.required(value, messages, {message: "Необхідно заповнити \"Широта\""});
                    }
                });

                self.data('counter', ++counterNumber);
            }
        });
    });

    $('body').on('click', '.delete-coordinate', function () {
        var self = $(this);
        var flightForm = $('#flight-form');
        var rowNumber = self.data('number');
        var rowId = self.data('row');
        var recordId = self.data('id');

        if (recordId) {
            $.ajax({
               url: '/details/delete?id=' + recordId,
               type: 'POST',
               success: function() {
                   $('#' + rowId).remove();
               }
            });
        } else {
            $('#' + rowId).remove();
        }

        flightForm.yiiActiveForm('remove', 'flightdetail-' + rowNumber + '-longitude');
        flightForm.yiiActiveForm('remove', 'flightdetail-' + rowNumber + '-latitude');
    });
});