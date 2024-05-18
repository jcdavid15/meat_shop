$(document).ready(()=>{
    $("#submit").on("click", function(event){
        event.preventDefault();
        const gender = $('#gender').val();
        const fname = $('#fname').val();
        const mname = $('#mname').val();
        const lname = $('#lname').val();
        const email = $('#email').val();
        const contactNo = $('#contact').val();
        const address = $('#address').val();
        const username = $('#uname').val();
        const password = $('#password').val();
        const role_id = $('#selectRole').val();
        const branch = $('#selectBranch').val();

        if(gender && fname && lname && email && contactNo && address && username && password && role_id) {
            const data = {
                gender,
                fname,
                mname,
                lname,
                email,
                contactNo,
                address,
                username,
                password,
                role_id
            };
            
            if (role_id === '3') { // Cashier role ID
                data.branch = branch;
            }

            $.ajax({
                url: "../backend/admin/createAcc.php",
                method: "post",
                data: data,
                success: (response) => {
                    if (response !== "existed") {
                        Swal.fire({
                            title: "Registered Successfully",
                            text: "Account has been created",
                            icon: "success"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Account Existed!",
                            text: "Your username/email are already exist.",
                            icon: "warning"
                        });
                    }
                },
                error: () => {
                    alert("Failed to connect!");
                }
            });
        } else {
            Swal.fire({
                title: "Empty Field!",
                text: "Make sure all fields are filled.",
                icon: "warning"
            });
        }
    });
});
