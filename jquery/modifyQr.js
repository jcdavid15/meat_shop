$(document).ready(() => {
    $("#submit").on("click", function(e) {
        e.preventDefault();
        const qrId = $("#prod_img").prop('files')[0];

        if (!qrId) {
            Swal.fire({
                title: "Empty Field!",
                text: "Please select a QR code.",
                icon: "warning"
            });
            return;
        }

        // Create a FormData object to send the file
        const formData = new FormData();
        formData.append('qr_img', qrId);

        $.ajax({
            url: "../backend/admin/updateQrCode.php",
            type: "POST",
            data: formData,
            contentType: false, // Important
            processData: false, // Important
            success: function(response) {
                if (response === 'success') {
                    Swal.fire({
                        title: "Successfully Modified",
                        text: "QR Code Modified Successfully!",
                        icon: "success",
                        showConfirmButton: false,
                    }).then((result) => {
                        if (result) {
                            $('#modifyQr')[0].reset();
                            location.reload();
                        }
                    });
                } else {
                    alert('Failed to modify QR code. Please try again later.');
                }
            },
            error: function() {
                alert('Error: Failed to communicate with server.');
            }
        });
    });
});
