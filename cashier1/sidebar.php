<div id="layoutSidenav_nav">
  <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
      <div class="nav">
        <div class="sb-sidenav-menu-heading">Main</div>
        <!-- Link manipulation -->
        <a class="nav-link" href="index.php">
          <div class="sb-nav-link-icon">
            <i class="fas fa-tachometer-alt"></i>
          </div>
          Dashboard
        </a>
        <div class="sb-sidenav-menu-heading">Orders</div>
        <a class="nav-link" href="tableOrders.php">
          <div class="sb-nav-link-icon">
            <i class="fa-solid fa-utensils"></i>
          </div>
          Table Orders
        </a>

        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseEmployeeProducts" aria-expanded="false" aria-controls="collapseEmployeeProducts">
          <div class="sb-nav-link-icon">
            <i class="fa-solid fa-utensils"></i>
          </div>
          Products List
          <div class="sb-sidenav-collapse-arrow">
            <i class="fas fa-angle-down"></i>
          </div>
        </a>
        <div class="collapse" id="collapseEmployeeProducts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <?php
                $query = "SELECT * FROM tbl_product_type";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                while($data = $result->fetch_assoc()){
                    $prodId = $data["prod_type_id"];
                    $prodName = $data["prod_type_name"];
            ?>
            <nav class="sb-sidenav-menu-nested nav" data-type-id="<?php echo $prodId; ?>">
                <a class="nav-link prod-type" data-type-id="<?php echo $prodId; ?>" href=""><?php echo $prodName; ?></a>
            </nav>
            <?php } ?>
        </div>

        <a class="nav-link" href="claimedOrders.php">
          <div class="sb-nav-link-icon">
            <i class="fa-solid fa-clipboard-check"></i>
          </div>
          Claimed Orders
        </a>

        <a class="nav-link" href="cancelledOrders.php">
          <div class="sb-nav-link-icon">
            <i class="fa-solid fa-ban"></i>
          </div>
          Cancelled Orders
        </a>

        <div class="sb-sidenav-menu-heading">Report </div>
        <a class="nav-link" href="transHistory.php">
          <div class="sb-nav-link-icon">
            <i class="fa-solid fa-clock-rotate-left"></i>
          </div>
          Transaction History
        </a>
      </div>
    </div>
  </nav>
</div>



