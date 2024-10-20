function validateInput(input) {
    
    input.value = input.value.replace(/\D/g, '');
}

function validateEmail(email) {
    const emailPattern = /^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com|outlook\.com|hotmail\.com)$/;
    return emailPattern.test(email);
}

function validatePassword(password) {
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    return passwordPattern.test(password);
}

function validateContactNo(contactNo) {
    const contactPattern = /^09\d{9}$/;
    return contactPattern.test(contactNo);
}

$(document).ready(() => {
    $(".button").on("click", function(event) {
        event.preventDefault();
        const check = $('input[name="terms"]').is(':checked');
    
        if (!check) {
            Swal.fire({
                title: "Please read and accept the terms and conditions.",
                icon: "warning",
                showConfirmButton: true,
            });
            return;
        }


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

        if (gender && fname && lname && email && contactNo && address && username && password && confirmPass) {
            if (!validateEmail(email)) {
                Swal.fire({
                    title: "Invalid Email!",
                    text: "Please enter a valid email address from gmail.com, yahoo.com, etc.",
                    icon: "warning"
                });
                return;
            }

            if (!validatePassword(password)) {
                Swal.fire({
                    title: "Weak Password!",
                    text: "Password must be at least 8 characters long and include at least one uppercase letter and one lowercase letter.",
                    icon: "warning"
                });
                return;
            }

            if (!validateContactNo(contactNo)) {
                Swal.fire({
                    title: "Invalid Contact Number!",
                    text: "Contact number must be 11 digits long and start with 09.",
                    icon: "warning"
                });
                return;
            }

            if (password === confirmPass) {
                $.ajax({
                    url: "../backend/user/signup.php",
                    method: "post",
                    data: {
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
                    success: (response) => {
                        if (response !== "existed") {
                            Swal.fire({
                                title: "Registered Successfully",
                                text: "Account has been created",
                                icon: "success"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "./login.php";
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
                    title: "Password doesn't match!",
                    text: "Make sure that your password are the same.",
                    icon: "warning"
                });
            }
        } else {
            Swal.fire({
                title: "Empty Field!",
                text: "Make sure all fields are filled.",
                icon: "warning"
            });
        }
    });
});
