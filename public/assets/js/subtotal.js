document.addEventListener('DOMContentLoaded', function() {
    var produkSelect = document.getElementById('produkID');
    var jumlahInput = document.getElementById('jumlah');
    var subtotalInput = document.getElementById('subtotal');

    var totalAkhirInput = document.getElementById('totalAkhir');
    var bayarInput = document.getElementById('bayar');
    var kembalianInput = document.getElementById('kembalian');
    var selesaiBtn = document.getElementById('selesaiBtn');

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

    // function getTotal() {
        
    //     if (totalCol) {
    //         var total = totalCol.textContent.trim();
    //         if (total != "" && total != "Undefined") {
    //             return parseFloat(total);
    //         }
    //     }
    //     return null;
    // }

    // function totalAkhir() {
    //     var selectedMember = memberSelect.options[memberSelect.selectedIndex];
    //     var member = selectedMember.value;
    //     if (member != "Bukan member") {
    //         var total = getTotal();
    //         if (total != null && !isNaN(total)) {
    //             alert("Diskon pada total sebesar " + total);
    //         } else {
    //             alert("tidak ada data");
    //         }
    //     }
    // }

    function bayar() {
        var totalAkhir = parseFloat(totalAkhirInput.value);
        var bayar = parseFloat(bayarInput.value);
        var kembalian = bayar - totalAkhir;

        kembalianInput.value = kembalian;
        if (kembalian >= 0) {
            selesaiBtn.disabled = false;
        } else {
            selesaiBtn.disabled = true;
        }
    }

    produkSelect.addEventListener('change', calculateSubtotal);
    jumlahInput.addEventListener('input', calculateSubtotal);
    bayarInput.addEventListener('input', bayar);
    totalAkhirInput.addEventListener('change', bayar);

    // Initialize subtotal calculation on page load
    calculateSubtotal();
});