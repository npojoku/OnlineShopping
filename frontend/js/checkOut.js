$(function () {
  $('#qtyBtn').on('click', function () {
       var qty = $('#qty').val();
       var price = $('#price').text();
       var productQty = $('#cQty').text();

       var totalAmt = qty * price;
       document.getElementById('total').innerHTML = 'Total Amount: $' + totalAmt;
  })
})
