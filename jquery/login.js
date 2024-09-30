$(document).ready(()=>{
    $("#submit").on("click", function(e){
        const check = $('input[name="terms"]').is(':checked');
    
        if (!check) {
            Swal.fire({
                title: "Please read and accept the terms and conditions.",
                icon: "warning",
                showConfirmButton: true,
            });
            return;
        }
        const email = $("#email").val()
        const password = $("#password").val()

        if(email && password){
            $.ajax({
                url: "../backend/user/login.php",
                method: "post",
                data:{
                    email,
                    password
                },
                success: function(response){
                    if(response === "Invalid Password"){
                        Swal.fire({
                            title: "Invalid Password",
                            icon: "warning",
                            showConfirmButton: false,
                            timer: 3000,
                        });
                    }else if(response === "deactivated"){
                        Swal.fire({
                            title: "Account Deactivated!",
                            icon: "warning",
                            showConfirmButton: false,
                            timer: 3000,
                        });
                    }else{
                        console.log(response)
                        Swal.fire({
                            title: "Welcome back!",
                            text: "Successfully Log in",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 3000,
                          }).then((result) => {
                            const data = JSON.parse(response);
                            if(data.role_id == 1){
                                localStorage.setItem("userDetails", response);
                                window.location.href = "./products.php";
                            }else if(data.role_id == 2){
                                localStorage.setItem("adminDetails", response);
                                window.location.href = "../admin/index.php"
                            }else if(data.role_id == 3){
                                localStorage.setItem("cashierDetails", response);
                                if(data.branch_id == 1){
                                    window.location.href = "../cashier1/index.php";
                                }else{
                                    window.location.href = "../cashier2/index.php";
                                }
                            }
                        });
                    }
                },
                error: function(){
                    alert("Connection Error")
                }
            })
        }
    })
})