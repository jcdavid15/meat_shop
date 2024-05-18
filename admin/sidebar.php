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
        <div class="sb-sidenav-menu-heading">Modify</div>
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
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="beef.php">Beef</a>
          </nav>
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="pork.php">Pork</a>
          </nav>
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="chicken.php">Chicken</a>
          </nav>
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="lamb.php">Lamb</a>
          </nav>
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="deli.php">Deli Meats</a>
          </nav>
        </div>
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseEmployeeAccounts" aria-expanded="false" aria-controls="collapseEmployeeAccounts">
          <div class="sb-nav-link-icon">
            <i class="fa-solid fa-user"></i>
          </div>
          Account List
          <div class="sb-sidenav-collapse-arrow">
            <i class="fas fa-angle-down"></i>
          </div>
        </a>
        <div class="collapse" id="collapseEmployeeAccounts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="customers.php">Active</a>
          </nav>
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="deactivated.php">Deactivated</a>
          </nav>
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="createAccount.php">Create Account</a>
          </nav>
        </div>
        <a class="nav-link" href="reports.php">
          <div class="sb-nav-link-icon">
            <i class="fa-solid fa-hand-holding-dollar"></i>
          </div>
          Reports
        </a>
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePickup" aria-expanded="false" aria-controls="collapsePickup">
          <div class="sb-nav-link-icon">
            <i class="fa-solid fa-truck-fast"></i>
          </div>
          For Pick Ups
          <div class="sb-sidenav-collapse-arrow">
            <i class="fas fa-angle-down"></i>
          </div>
        </a>
        <div class="collapse" id="collapsePickup" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="branch1.php">Branch 1</a>
          </nav>
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="branch2.php">Branch 2</a>
          </nav>
        </div>

        <div class="sb-sidenav-menu-heading">Report </div>
        <a class="nav-link" href="auditLogs.php">
          <div class="sb-nav-link-icon">
            <i class="fa-solid fa-person-walking"></i>
          </div>
          Audit Logs
        </a>
        <a class="nav-link" href="auditTrail.php">
          <div class="sb-nav-link-icon">
            <i class="fa-solid fa-chart-line"></i>
          </div>
          Audit Trail
        </a>
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
