$(document).ready(()=>{
    $(".delete-js").on("click", function(){
        const prodId = $(this).attr("id");
        if(prodId){
            $.ajax({
                url:"../backend/user/deleteprod.php",
                metehod: "get",
                data:{
                    prodId
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
})

$(document).ready(()=>{
    $('.minus-btn').on('click', function(){
        const prodId = $(this).parent().parent().parent().find('.delete-js').attr('id');
        const qnt = $(this).closest('.qnty-td').find('.qnty-js');
        if(prodId){
            $.ajax({
                url:"../backend/user/minusQnty.php",
                metehod: "get",
                data:{
                    prodId
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
})

$(document).ready(()=>{
    $('.add-btn').on('click', function(){
        const prodId = $(this).parent().parent().parent().find('.delete-js').attr('id');
        const qnt = $(this).closest('.qnty-td').find('.qnty-js');
        if(prodId){
            $.ajax({
                url:"../backend/user/addQnty.php",
                metehod: "get",
                data:{
                    prodId
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
})


$(document).ready(()=>{
    $('.proceed-btn').on('click', function(){
        
    })
})