$(document).ready(function () {
    // Load the JSON data from the server
    $.getJSON('/load-car-data', function (data) {
        // Populate the car brand dropdown (#brand)
        var brandDropdown = $('#brand');
        brandDropdown.empty();
        brandDropdown.append($('<option>').text('Select Car Brand').attr('value', ''));
        $.each(data, function (brand, models) {
            brandDropdown.append($('<option>').text(brand).attr('value', brand));
        });

        // Initialize the car model dropdown (#model)
        var modelDropdown = $('#model');
        modelDropdown.empty();
        modelDropdown.append($('<option>').text('Select Car Model').attr('value', ''));

        // When the car brand dropdown is changed
        brandDropdown.on('change', function () {
            var selectedBrand = $(this).val();
            modelDropdown.empty();
            modelDropdown.append($('<option>').text('Select Car Model').attr('value', ''));
            
            if (selectedBrand && data[selectedBrand]) {
                $.each(data[selectedBrand], function (index, model) {
                    modelDropdown.append($('<option>').text(model).attr('value', model));
                });
            }
        });
    });
});