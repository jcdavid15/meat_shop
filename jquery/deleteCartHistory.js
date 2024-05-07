$(document).ready(()=>{
    $(".delete-js").on("click", function(){
        const prodId = $(this).attr("id");
        if(prodId){
            $.ajax({
                url:"../backend/user/deleteCartHistory.php",
                metehod: "get",
                data:{
                    prodId
                },
                success: function(response){
                    if(response === "deleted"){
                        Swal.fire({
                            title: "Order cancelled",
                            text: "Product item has been cancelled in your cart.",
                            icon: "warning"
                        }).then((result)=>{
                            if(result.isConfirmed){
                                window.location.href = "./history.php";
                            }
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