$(document).ready(function () {
    $('#category_id').change(function () {
        var category_id = $(this).val();
        var paymentTypeDropdown = $('#payment_type_id');

        // Reset payment type dropdown
        paymentTypeDropdown.empty();

        // Check if selected category is "Bayar/Top Up" with ID 11
        if (category_id === "11") {
            // Enable payment type dropdown
            paymentTypeDropdown.prop('disabled', false);

            // Replace placeholder ':id' with actual value
            var url = getPaymentTypesUrl.replace(':id', category_id);

            // Make Ajax request to fetch payment types based on category id
            $.ajax({
                url: url, // Using URL defined in Blade
                method: 'GET',
                data: {
                    category_id: category_id
                },
                success: function (response) {
                    if (response.payment_types.length > 0) {
                        // Populate payment type dropdown with options from response
                        $.each(response.payment_types, function (index, paymentType) {
                            paymentTypeDropdown.append($('<option>', {
                                value: paymentType.id,
                                text: paymentType.name
                            }));
                        });
                    } else {
                        // No payment types available for selected category
                        paymentTypeDropdown.append($('<option>', {
                            value: '',
                            text: 'No payment types available'
                        }));
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    paymentTypeDropdown.append($('<option>', {
                        value: '',
                        text: 'Error fetching payment types'
                    }));
                }
            });
        } else {
            // Disable payment type dropdown
            paymentTypeDropdown.prop('disabled', true);
        }
    });
});
