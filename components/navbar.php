<?php require_once("../backend/config/config.php") ?>
<?php 
  session_start();
?>
<nav>
      <div class="left">
        <a href="../index.php"><div class="img-con">
            <img src="../assets/imgs/logo.jpeg" alt="">
        </div>
        </a>
        <a href="../index.php"><div>Home</div></a>
        <a href="./aboutUs.php"><div>About Us</div></a>
        <a href="./contactUs.php"><div>Contact Us</div></a>
        <a href="./login.php"><div class="login">Log in</div></a>
      </div>

      <div id="bar">
        <i class="fa-solid fa-bars"></i>
      </div>

      <div class="mid">
        
        <div>Manny And Susse Meatshop</div>
    
      </div>


      <div class="right">
          <a href="./products.php"><div class="prod">Products</div></a>
          <?php if(!empty($_SESSION["user_id"])){ ?>
              <a href="./history.php"><div class="history">History</div></a>
          <?php }?>
            <?php if(!empty($_SESSION["user_id"])){ 
                $query = "SELECT COUNT(*) AS CountItems FROM tbl_cart WHERE status_id = 4 and account_id = ?;";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $_SESSION["user_id"]);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_assoc();
            ?>
            <a href="./ProcessOrders.php">
                <div class="count-div">
                    <i class="fa-regular fa-bell"></i>
                    <div class="count">
                        <?php echo $data["CountItems"]; ?>
                    </div>
                </div>
            </a>
            <?php } ?>
          <a href="./cart.php"><i class="fa-solid fa-cart-shopping"></i></a>

          <?php if(!empty($_SESSION["user_id"])){ ?>
              <div class="dropdown">
                  <i class="fa-regular fa-user" onclick="toggleDropdown()"></i>
                  <div class="dropdown-content" id="dropdownContent">
                      <a href="./profile.php">Profile</a>
                      <a href="./logout.php">Log out</a>
                  </div>
              </div>
          <?php } else { ?>
              <a href="./login.php"><div class="login">Log in</div></a>
          <?php }?>
      </div>
</nav>

<script>
    function toggleDropdown() {
        document.getElementById("dropdownContent").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.fa-user')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>