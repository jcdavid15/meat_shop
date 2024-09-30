$(document).ready(function() {
    const report = document.getElementById('message-response'); // Move outside to optimize
    const email = document.getElementById('email-val'); // Move outside to optimize
    
    $('#submit').on('click', function(e) {
        e.preventDefault();

        if (report.value.trim() === '') {
            Swal.fire({
                title: 'Empty Fields!',
                text: 'Please fill out the required fields.',
                icon: 'warning'
            });
            return;
        }

        // Show the loading modal before the AJAX call
        Swal.fire({
            title: 'Sending Report...',
            text: 'Please wait while we process your request.',
            icon: 'info',
            allowOutsideClick: false, // Prevent closing by clicking outside
            didOpen: () => {
                Swal.showLoading(); // Show loading spinner
            }
        });

        $.ajax({
            url: '../backend/admin/responseReport.php',
            method: 'post',
            data: {
                report: report.value,
                email: email.value
            },
            success: function(response) {
                
                // Close the loading modal
                Swal.close();

                if (response === 'success') {
                    Swal.fire({
                        title: 'Report Sent!',
                        text: 'Report has been sent successfully!',
                        icon: 'success'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong, please try again later.',
                        icon: 'error'
                    });
                }
            },
            error: function() {
                Swal.close(); // Close the loading modal
                Swal.fire({
                    title: 'Connection Error',
                    text: 'Failed to send the report. Please check your connection.',
                    icon: 'error'
                });
            }
        });
    });
});
