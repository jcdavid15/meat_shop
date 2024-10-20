$(document).ready(() => {
    $('.updateResBtn').on('click', function() {
        const prod_id = $(this).val();
        const qnty = $(this).closest('.modal-content').find('.qnty').val();
        const stocks = $(this).closest('.modal-content').find('.stocks').val();
        const branch_id = $(this).data('branch-id');

        if(qnty <= 0){
            Swal.fire({
                title: "Invalid Quantity",
                text: "Make sure your quantity is right.",
                icon: "warning"
            });
            return;
        }

        if(qnty > stocks){
            Swal.fire({
                title: "Invalid Quantity",
                text: "Quantity exceeds the available stocks.",
                icon: "warning"
            });
            return;
        }

        $.ajax({
            url: "../backend/cashier/orderProduct.php",
            method: "post",
            data: {
                branch_id,
                qnty,
                prod_id
            },
            success: function(response) {
                if(response === 'success'){
                    Swal.fire({
                        title: "Product Ordered",
                        text: "Product has been ordered successfully.",
                        icon: "success"
                    }).then((result) => {
                        if(result.isConfirmed){
                            window.location.reload();
                        }
                    });
                }else if(response === 'low'){
                    Swal.fire({
                        title: "Invalid Quantity",
                        text: "Make sure your quantity is right.",
                        icon: "warning"
                    });
                }
            },
            error: function(){
                alert("Connection Error");
            }
        })
    })
});