$(document).ready(function() {
  var rowCount = 0; // Initialize row count variable

  $('#tambahBtn').click(function(event) {
    event.preventDefault();

    var formData = $('#produkForm').serialize();

    $.ajax({
      url: '/api/detailpembelian/simpan',
      method: 'POST',
      data: formData,
      success: function(response) {
        rowCount++; // Increment row count for each successful addition

        // Construct the new row with row number and response data
        var newRow = '<tr>' +
          '<td>' + rowCount + '</td>' + // Display row number
          '<td>' + response.produk + '</td>' +
          '<td>' + response.jumlah + '</td>' +
          '<td>' + response.subtotal + '</td>' +
          '<td><button class="btn btn-danger deleteBtn" data-detailid="' + response.detailID + '">'+ response.detailID +'</button></td>' +
          '</tr>';

        $('tbody').append(newRow);

        // Update total in table footer (assuming response includes total)
        $('tfoot th:last-child').text(response.total);

        $('#total').val(response.total);
        $('#totalAkhir').val(response.totalAkhir);
      },
      error: function(xhr, status, error) {
        alert(error);
        console.error(error);
      }
    });
  });

  // Handle click event on delete button
  $('body').on('click', '.deleteBtn', function() {
    var detailID = $(this).data('detailid'); // Get the detail ID from data attribute
    var row = $(this).closest('tr'); // Get the row to be deleted

    // Send AJAX request to delete the row
    $.ajax({
      url: '/api/detailpembelian/hapus' + detailID,
      method: 'GET',
      success: function(response) {
        // Remove the row from the table upon successful deletion
        row.remove();

        // Recalculate and update the total in the table footer
        $('tfoot th:last-child').text(response.total);
        $('#total').val(response.total);
        $('#totalAkhir').val(response.totalAkhir);
      },
      error: function(xhr, status, error) {
        console.error(error);
        alert('Failed to delete row. Please try again.');
      }
    });
  });
});
