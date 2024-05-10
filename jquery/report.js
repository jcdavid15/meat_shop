$(document).ready(()=>{
   $('#submit').on('click', function(e){
        e.preventDefault();
        const name = $('#name').val();
        const email = $('#email').val();
        const message = $('#message').val();
        
        if(name && email && message){
            $.ajax({
                url: "../backend/user/report.php",
                method: "post",
                data:{
                    name,
                    email,
                    message
                },
                success: function(response){
                    if(response === 'success'){
                        Swal.fire({
                            title: "Message Submitted",
                            text: "Message has been submitted successfully",
                            icon: "success"
                        }).then((result)=>{
                            if(result.isConfirmed){
                                window.location.reload();
                            }
                        })
                    }else{
                        alert("Connection error");
                    }
                },
                error: function(){
                    alert("Connection Error")
                }
            })
        }else{
            Swal.fire({
                title: "Empty Field!",
                text: "Make sure all fields are filled.",
                icon: "warning",
                showConfirmButton: false,
                timer: 1500
              });
        }
   })
})