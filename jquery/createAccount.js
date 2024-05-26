$(document).ready(() => {
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

        // Validation functions
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

        if (gender && fname && lname && email && contactNo && address && username && password && role_id) {
            if (!validatePassword(password)) {
                Swal.fire({
                    title: "Invalid Password!",
                    text: "Password must be at least 8 characters long and contain at least one uppercase and one lowercase letter.",
                    icon: "warning"
                });
                return;
            }

            if (!validateEmail(email)) {
                Swal.fire({
                    title: "Invalid Email!",
                    text: "Please enter a valid email address (gmail.com, yahoo.com, outlook.com, hotmail.com).",
                    icon: "warning"
                });
                return;
            }

            if (!validateContactNo(contactNo)) {
                Swal.fire({
                    title: "Invalid Contact Number!",
                    text: "Contact number must start with '09' followed by 9 digits.",
                    icon: "warning"
                });
                return;
            }

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
