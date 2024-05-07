<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Profile Update</title>
    <link rel="stylesheet" href="../styles/profile.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="../styles/profile.css">
    <script src="../jquery/jquery.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
   </head>
<body>

<?php include "./navbar.php" ?>

  <?php
    if(isset($_SESSION["user_id"]))
    {
        $acc_id = $_SESSION["user_id"];
        $query = "SELECT ta.account_id, ta.ac_username, 
        td.first_name, td.middle_name, td.last_name, 
        td.contact, td.gender, td.address
        FROM tbl_account ta
        INNER JOIN tbl_account_details td ON ta.account_id = td.account_id
        where ta.account_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $acc_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = $result->fetch_assoc();
    }else{
        header("Location: ../index.php");
    }
  ?>  
  <div class="container">
    <div class="title">Profile Details</div>
    <div class="content">
      <form action="#">
        <div class="user-details">
          <div class="input-box">
            <span class="details">First name</span>
            <input type="text" name="fname" id="fname" placeholder="Enter your first name" value="<?php echo $data["first_name"]; ?>" required>
          </div>
          <div class="input-box">
            <span class="details">Middle name</span>
            <input type="text" name="mname" id="mname" placeholder="Enter your middle name" value="<?php echo $data["middle_name"]; ?>" >
          </div>
          <div class="input-box">
            <span class="details">Last name</span>
            <input type="text"name="lname" id="lname" placeholder="Enter your last name" value="<?php echo $data["last_name"]; ?>" required>
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" name="uname" id="uname" placeholder="Enter your username" value="<?php echo $data["ac_username"]; ?>" required>
          </div>
          <div class="input-box">
            <span class="details">Address</span>
            <input type="text" name="address" id="address" placeholder="Enter your address" value="<?php echo $data["address"]; ?>" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" name="contact" id="contact" placeholder="Enter your number" value="<?php echo $data["contact"]; ?>" oninput="this.value = this.value.replace(/\D/g, '').slice(0, 11)" required>
          </div>
          <div class="input-box">
            <span class="details">Current Password</span>
            <input type="password" name="password" id="password" placeholder="Enter your current password" required>
          </div>
          <div class="input-box">
            <span class="details">New Password</span>
            <input type="password" name="confirmPass" id="confirmPass" placeholder="Confirm your new password" required>
          </div>
        </div>
        <div class="button">
          <input type="submit" value="Update">
        </div>
      </form>
    </div>
  </div>


  <script src="../jquery/updateProfile.js"></script>
</body>
</html>