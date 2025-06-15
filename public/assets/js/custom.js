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
                    let cartTotalCounts = $('#cartTotalCounts').data('total');
                    let cartRowPrice = $(ele).parent().parent().find(`.row-cart-price`);
                    $('#cartTotalCounts').text('Rp ' + formatIdr(parseInt(cartTotalCounts) - parseInt(cartRowPrice.data('price'))));
                    $('#cartTotalCounts').data('total', parseInt(cartTotalCounts) - parseInt(cartRowPrice.data('price')));
                     
                    
                    $(ele).parent().parent().remove();

                    let cartCounts = parseInt($('#cartCounts').text());
                    $('#cartCounts').text(cartCounts - 1);
                }
            });

        
        }
    })

      var formatIdr = function (num) {
            var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
            if (str.indexOf(".") > 0) {
                parts = str.split(".");
                str = parts[0];
            }
            str = str.split("").reverse();
            for (var j = 0, len = str.length; j < len; j++) {
                if (str[j] != ",") {
                    output.push(str[j]);
                    if (i % 3 == 0 && j < (len - 1)) {
                        output.push(".");
                    }
                    i++;
                }
            }
            formatted = output.reverse().join("");
            return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
        };

  
}
// // select js
// $(document).ready(function() {
//     $('.category-select').select2();
// });   
