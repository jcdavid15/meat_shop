<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="../jquery/jquery.js"></script>
    <script src="../scripts/sweetalert2.js"></script>
    <link rel="stylesheet" href="../styles/signup.css">
    <title>Sign up</title>
</head>
<body>
    <?php include "./navbar.php" ?>
        <div class="center">
            <div class="container">
                <div class="title">Sign up</div>
                <div class="content">
                <form>
                    <div class="user-details">
                    <div class="input-box">
                        <span class="details">First name<span>*</span></span>
                        <input type="text" id="fname" placeholder="Enter first name">
                    </div>
                    <div class="input-box">
                        <span class="details">Middle name</span>
                        <input type="text" id="mname" placeholder="Enter middle name">
                    </div>
                    <div class="input-box">
                        <span class="details">Last name<span>*</span></span>
                        <input type="text" id="lname" placeholder="Enter last name">
                    </div>
                    <div class="input-box">
                        <span class="details">Email<span>*</span></span>
                        <input type="text" id="email" placeholder="Enter your email">
                    </div>
                    <div class="input-box">
                        <span class="details">Phone Number<span>*</span></span>
                        <input type="text" id="phoneNum" placeholder="Enter your number" oninput="validateInput(this)" pattern="\d*" maxlength="11">
                    </div>
                    <div class="input-box">
                        <span class="details">Address<span>*</span></span>
                        <input type="text" id="address" placeholder="Enter your address">
                    </div>
                    <div class="input-box">
                        <span class="details">Username<span>*</span></span>
                        <input type="text" id="uname" placeholder="Enter your username">
                    </div>
                    <div class="input-box">
                        <span class="details">Password<span>*</span></span>
                        <input type="password" id="password" placeholder="Enter your password">
                    </div>
                    <div class="input-box">
                        <span class="details">Confirm Password<span>*</span></span>
                        <input type="password" id="confirmPass" placeholder="Confirm your password">
                    </div>
                    </div>
                    <div class="gender-details">
                    <input type="radio" value="Male" name="gender" id="dot-1">
                    <input type="radio" value="Female" name="gender" id="dot-2">
                    <input type="radio" value="Other" name="gender" id="dot-3">
                    <span class="gender-title">Gender</span>
                    <div class="category">
                        <label for="dot-1">
                        <span class="dot one"></span>
                        <span class="gender">Male</span>
                    </label>
                    <label for="dot-2">
                        <span class="dot two"></span>
                        <span class="gender">Female</span>
                    </label>
                    <label for="dot-3">
                        <span class="dot three"></span>
                        <span class="gender">Prefer not to say</span>
                        </label>
                    </div>
                    </div>
                    <div class="button">
                    <input type="submit" value="Register">
                    </div>
                </form>
                </div>
            </div>
        </div>

    <?php include "./footer.php" ?>

  <script src="../scripts/navbar.js"></script>
  <script src="../jquery/signup.js"></script>
</body>
</html>