$(".datatable-original").DataTable({
    responsive: true,
    order: [[2, 'desc']]
});


function removeCart(ele){
     Swal.fire({
        title: 'Hapus dari keranjang?',
        text: "Proses hapus tidak bisa dibatalkan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {                 
            
            let cartId = $(ele).data('cart');
            $.ajax({
                type: "GET",
                url: `/customer_cart_delete/${cartId}`,
                success: function (response) {
                    $(ele).parent().parent().remove();

                    // let cartTotalCounts = parseInt($('#cartTotalCounts').text());
                    // $('#cartTotalCounts').text(cartTotalCounts + parseInt(response.carts.product_price));

                    let cartCounts = parseInt($('#cartCounts').text());
                    $('#cartCounts').text(cartCounts - 1);
                }
            });

        
        }
    })
  
}
// // select js
// $(document).ready(function() {
//     $('.category-select').select2();
// });   
