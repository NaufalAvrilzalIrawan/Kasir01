document.addEventListener('DOMContentLoaded', function() {
    var produkSelect = document.getElementById('produkID');
    var jumlahInput = document.getElementById('jumlah');
    var subtotalInput = document.getElementById('subtotal');

    function calculateSubtotal() {
        var selectedOption = produkSelect.options[produkSelect.selectedIndex];
        var harga = parseFloat(selectedOption.getAttribute('data-harga'));
        var stok = parseInt(selectedOption.getAttribute('data-stok'));
        var jumlah = parseInt(jumlahInput.value);

        // Validate jumlah input against minimum and maximum constraints
        if (isNaN(jumlah) || jumlah < 1) {
            jumlahInput.value = 1; // Set jumlah to minimum value (1) if less than 1
            jumlah = 1; // Update jumlah variable
        } else if (!isNaN(stok) && jumlah > stok) {
            jumlahInput.value = stok; // Set jumlah to maximum stok value if exceeds stok
            jumlah = stok; // Update jumlah variable
        }

        // Calculate subtotal based on valid jumlah value and harga
        var subtotal = harga * jumlah;
        subtotalInput.value = subtotal; // Display subtotal with two decimal places
    }

    produkSelect.addEventListener('change', calculateSubtotal);
    jumlahInput.addEventListener('input', calculateSubtotal);

    // Initialize subtotal calculation on page load
    calculateSubtotal();
});