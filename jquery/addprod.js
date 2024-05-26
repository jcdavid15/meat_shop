$(document).ready(function() {
    $('#addProd').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting normally
        
        // Get form values
        var productName = $('#prod_name').val();
        var productPrice = $('#prod_price').val();
        var productType = $('#prod_type').val();
        var productStocks = $('#prod_stocks').val();
        var productImage = $('#prod_img').prop('files')[0];

        // Validate form inputs
        if (!productName || !productPrice || !productType || !productStocks || !productImage) {
            Swal.fire({
                title: "Empty Field!",
                text: "Please fill in all fields.",
                icon: "warning",
                showConfirmButton: true,
            })
            return;
        }

        // Create FormData object
        var formData = new FormData();
        formData.append('prod_name', productName);
        formData.append('prod_price', productPrice);
        formData.append('prod_type', productType);
        formData.append('prod_stocks', productStocks);
        formData.append('prod_img', productImage);

        // AJAX request to submit form data
        $.ajax({
            url: '../backend/admin/add_product.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle success response
                if (response === 'success') {
                    Swal.fire({
                        title: "Successfully Added",
                        text: "Product Added Successfully!",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result)=>{
                        if(result){
                            $('#addProd')[0].reset();
                            location.reload();
                        }
                    })
                    
                } else {
                    alert('Failed to add product. Please try again later.');
                }
            },
            error: function() {
                // Handle error response
                alert('Error: Failed to communicate with server.');
            }
        });
    });
});
