$(document).ready(()=>{
    $(".delete-js").on("click", function(){
        const prodId = $(this).attr("id");
        const branchId = $(this).data("branch-id");
        if(prodId){
            $.ajax({
                url:"../backend/user/deleteprod.php",
                metehod: "get",
                data:{
                    prodId,
                    branchId
                },
                success: function(response){
                    if(response === "deleted"){
                        Swal.fire({
                            title: "Item removed",
                            text: "Product item has been deleted in your cart.",
                            icon: "warning"
                        }).then((result)=>{
                            if(result.isConfirmed){
                                window.location.href = "cart.php";
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

    $('.minus-btn').on('click', function(){
        const prodId = $(this).parent().parent().parent().find('.delete-js').attr('id');
        const qnt = $(this).closest('.qnty-td').find('.qnty-js');
        const branchId = $(this).data("branch-id");
        if(prodId){
            $.ajax({
                url:"../backend/user/minusQnty.php",
                metehod: "get",
                data:{
                    prodId,
                    branchId
                },
                success: function(response){
                    window.location.href = "./cart.php"
                },
                error: function(){
                    alert("Connection Error!");
                }
            })
        }
    })

    $('.add-btn').on('click', function(){
        const prodId = $(this).parent().parent().parent().find('.delete-js').attr('id');
        const qnt = $(this).closest('.qnty-td').find('.qnty-js');
        const branchId = $(this).data("branch-id");
        if(prodId){
            $.ajax({
                url:"../backend/user/addQnty.php",
                metehod: "get",
                data:{
                    prodId,
                    branchId
                },
                success: function(response){
                    window.location.href = "./cart.php"
                },
                error: function(){
                    alert("Connection Error!");
                }
            })
        }
    })

    $('.proceed-btn').on('click', function(){
        Swal.fire({
            title: "Want to pick up now?",
            text: "Your items will prepare right away.",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, proceed!"
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "../backend/user/proceed.php",
                    success: function(response){
                        if(response === 'success'){
                            window.location.reload();
                        }else{
                            alert("Update error");
                        }
                    },
                    error: function(){
                        alert("Connection Error!");
                    }
                })
            }
          });
        
    })
})
