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
    <link rel="stylesheet" href="../styles/login.css">
    <title>Reset Password</title>
</head>
<body>
    <?php include "./navbar.php" ?>
    <div class="center">
        <div class="wrapper" style="height: 410px;">
            <header>Reset Password</header>
            <form action="#">
            <div class="field email">
                <div class="input-area">
                <input type="email" id="email" placeholder="Email Address">
                <i class="icon fas fa-envelope"></i>
                <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Email can't be blank</div>
            </div>
            <div class="field password">
                <div class="input-area">
                <input type="password" id="password" placeholder="New Password">
                <i class="icon fas fa-lock"></i>
                <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Password can't be blank</div>
            </div>
            <input type="submit" id="submit" value="Submit">
            </form>
        </div>
    </div>
  <?php include "./footer.php" ?>
  <script src="../scripts/navbar.js"></script>
  <script src="../scripts/loginframe.js"></script>
  <script src="../jquery/forgotPass.js"></script>
</body>
</html>