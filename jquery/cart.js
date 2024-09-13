const checkTerms = document.getElementById('checkTerms');
let check = false;
checkTerms.addEventListener('click', function() {
    if(checkTerms.checked){
        check = true;
    }else{
        check = false;
    }
})

$(document).ready(()=>{
    $(".delete-js").on("click", function(){
        // const prodId = $(this).attr("id");
        // const branchId = $(this).data("branch-id");
        const itemId = $(this).attr("id");
        if(itemId){
            $.ajax({
                url:"../backend/user/deleteprod.php",
                metehod: "get",
                data:{
                    itemId
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

    $('.proceed-btn').on('click', function() {
        const check = $('input[name="terms"]').is(':checked');
    
        if (!check) {
            Swal.fire({
                title: "Please read and accept the terms and conditions.",
                icon: "warning",
                showConfirmButton: true,
            });
            return;
        }
    
        const receiptFile = $('#receiptFile')[0].files[0];
        const refNumber = $("#refNumber").val().trim();
        const depositAmnt = $("#depAmount").val().trim();
        const totalAmnt = $("#overAllTotal").val().trim().replace("₱", "").replace(",", "");    
        
        // Check if the receipt file is uploaded
        if (!receiptFile) {
            Swal.fire({
                title: "Please upload your receipt",
                icon: "warning",
                showConfirmButton: true,
            });
            return;
        }
        
        const allowedExtensions = ['jpg', 'jpeg', 'png', 'svg', 'webp'];
        const fileExtension = receiptFile.name.split('.').pop().toLowerCase();
        
        // Validate file extension
        if (!allowedExtensions.includes(fileExtension)) {
            Swal.fire({
                title: "Invalid file type",
                text: "Please upload a file with one of the following extensions: jpg, jpeg, png, svg, webp",
                icon: "warning",
                showConfirmButton: true,
            });
            return;
        }
        
        // Validate reference number input
        if (!refNumber) {
            Swal.fire({
                title: "Please enter your reference number.",
                icon: "warning",
                showConfirmButton: true,
            });
            return;
        }

        if(refNumber.length < 13){
            Swal.fire({
                title: "Invalid reference number",
                text: "Reference number must be 13 characters long.",
                icon: "warning",
                showConfirmButton: true,
            });
            return;
        }
    
        // Validate deposit amount input
        if (!depositAmnt || isNaN(depositAmnt) || parseFloat(depositAmnt) <= 0) {
            Swal.fire({
                title: "Please enter a valid deposit amount.",
                icon: "warning",
                showConfirmButton: true,
            });
            return;
        }
        console.log(parseFloat(totalAmnt) / 2);
        if((parseFloat(totalAmnt) / 2) > depositAmnt){
            Swal.fire({
                title: "Invalid deposit amount",
                text: "Deposit amount must be at least 50% of the total amount.",
                icon: "warning",
                showConfirmButton: true,
            });
            return;
        }
        
        // Confirm pickup action
        Swal.fire({
            title: "Want to pick up now?",
            text: "Your items will be prepared right away.",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, proceed!"
        }).then((result) => {
            if (result.isConfirmed) {
                let formData = new FormData();
                formData.append('receipt', receiptFile);
                formData.append('refNumber', refNumber);
                formData.append('depositAmount', depositAmnt);
    
                $.ajax({
                    url: "../backend/user/proceed.php",
                    method: "post",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response === 'success') {
                            window.location.reload();
                        } else {
                            Swal.fire({
                                title: "Update error",
                                text: response,
                                icon: "error",
                                showConfirmButton: true,
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: "Connection Error!",
                            text: "Could not connect to the server.",
                            icon: "error",
                            showConfirmButton: true,
                        });
                    }
                });
            }
        });
    });
    
    
})
