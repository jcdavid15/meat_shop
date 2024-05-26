$(document).ready(()=>{
    $(".div-button").on("click", function(){
        
        const userDetails = JSON.parse(localStorage.getItem("userDetails"));
        if(userDetails){
            const check =  $(this).closest(".con-item").find(".check");

            const prodId = $(this).closest(".con-item").attr("id");
            const qnty = $(this).closest(".con-item").find(".qnty").val();
            const branch = $(this).closest('.con-item').find('.branch').val();
            $.ajax({
                url: "../backend/user/addcart.php",
                method: "post",
                data:{
                    prodId,
                    qnty,
                    branch
                },
                success: function(response){
                    if(response === 'exceeds'){
                        Swal.fire({
                            title: "Item already in cart!",
                            text: "This item is already in your cart.",
                            icon: "warning"
                        });
                    }else if(response === 'success'){
                        check.css("opacity", "1");
                        setTimeout(function(){
                            check.css("opacity", "0");
                        },2000)
                    }
                },  
                error: function(){
                    alert("Connection Error");
                }
            })
        }else{
            Swal.fire({
                title: "Log in first!",
                text: "You need to log in first before you order!",
                icon: "warning"
            });
        }
    })
})
