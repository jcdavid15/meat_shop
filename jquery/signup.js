function validateInput(input) {
    // Remove non-numeric characters
    input.value = input.value.replace(/\D/g, '');
}

$(document).ready(()=>{
    $(".button").on("click", function(event){
        event.preventDefault();
        const gender = $('input[name="gender"]:checked').val();
        const fname = $('#fname').val();
        const mname = $('#mname').val();
        const lname = $('#lname').val();
        const email = $('#email').val();
        const contactNo = $('#phoneNum').val();
        const address = $('#address').val();
        const username = $('#uname').val();
        const password = $('#password').val();
        const confirmPass = $('#confirmPass').val();

        if(gender && fname && lname && email && contactNo
        && address && username && password && confirmPass)
        {
            if(password == confirmPass){
                $.ajax({
                    url: "../backend/user/signup.php",
                    method: "post",
                    data:{
                        gender,
                        fname,
                        mname,
                        lname,
                        email,
                        contactNo,
                        address,
                        username,
                        password
                    },
                    success: (response)=>{
                        if(response !== "existed"){
                            Swal.fire({
                                title: "Registered Successfully",
                                text: "Account has been created",
                                icon: "success"
                              }).then((result)=>{
                                if(result.isConfirmed)
                                {
                                    window.location.href = "./login.php";
                                }
                              })
                        }else{
                            Swal.fire({
                                title: "Account Existed!",
                                text: "Your username/email are already exist.",
                                icon: "warning"
                            });
                        }
                    },
                    error: ()=>{
                        alert("Failed to connect!");
                    }
                })
            }else{
                Swal.fire({
                    title: "Password doesn't match!",
                    text: "Make sure that your password are the same.",
                    icon: "warning"
                  });
            } 
        }else{
            Swal.fire({
                title: "Empty Field!",
                text: "Make sure all field are filled.",
                icon: "warning"
            });
        }
    })
})