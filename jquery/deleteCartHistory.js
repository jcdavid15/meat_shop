$(document).ready(()=>{
    $(".delete-js").on("click", function(){
        const prodId = $(this).attr("id");
        const branchId = $(this).data("branch-id");
        if(prodId){
            $.ajax({
                url:"../backend/user/deleteCartHistory.php",
                metehod: "get",
                data:{
                    prodId,
                    branchId
                },
                success: function(response){
                    if(response === "deleted"){
                        Swal.fire({
                            title: "Order cancelled",
                            text: "Product item has been cancelled in your cart.",
                            icon: "warning",
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result)=>{
                            window.location.href = "./history.php";
                        })
                    }
                },
                error: function(){
                    alert("Connection Error!");
                }
            })
        }
    })
})