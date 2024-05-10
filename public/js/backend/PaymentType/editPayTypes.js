$(document).ready(function () {
    // Simpan kategori yang dipilih saat pertama kali halaman dimuat
    var initialCategory = $('#category_id').val();

    // Panggil fungsi untuk menonaktifkan form jika kategori yang dipilih bukan 11
    disablePaymentTypeIfNotCategory11(initialCategory);

    $('#category_id').change(function () {
        var category_id = $(this).val();
        disablePaymentTypeIfNotCategory11(category_id);
    });
});

function disablePaymentTypeIfNotCategory11(category_id) {
    var paymentTypeDropdown = $('#payment_type_id');

    // Reset payment type dropdown
    paymentTypeDropdown.empty();

    // Check if selected category is "Bayar/Top Up" with ID 11
    if (category_id === "11") {
        // Enable payment type dropdown
        paymentTypeDropdown.prop('disabled', false);

        // Populate payment type dropdown with options from backend
        // Assuming you have a JavaScript variable `paymentTypes` containing payment type data
        paymentTypes.forEach(function (paymentType) {
            paymentTypeDropdown.append($('<option>', {
                value: paymentType.id,
                text: paymentType.name
            }));
        });

        // Set selected value based on expenses data
        paymentTypeDropdown.val('{{ $expenses->payment_type_id }}');
    } else {
        // Disable payment type dropdown
        paymentTypeDropdown.prop('disabled', true);

        // Set payment type dropdown value to null
        paymentTypeDropdown.val(null);
    }
}
