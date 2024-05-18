$(document).ready(()=>{
    $('#submit').on('click', function(e){
        const email = $('#email').val();
        const password = $('#password').val();
        
        if(email && password){
            $.ajax({
                url: "../backend/user/newPassword.php",
                method: "post",
                data:{
                    email,
                    password
                },
                success: function(response){
                    if(response === 'success'){
                        Swal.fire({
                            title: "Success",
                            text: "Password reset successfully",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000
                          }).then((result)=>{
                            if(result){
                                window.location.href = "./login.php"
                            }
                          })
                    }else if(response === 'invalid'){
                        Swal.fire({
                            title: "Invalid Email!",
                            text: "Make sure your email is correct.",
                            icon: "warning",
                            showConfirmButton: false,
                            timer: 2000
                          });
                    }
                }
            })
        }
    })
})