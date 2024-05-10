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
              <div class="sb-sidenav-menu-heading">Products</div>
              <a
                class="nav-link collapsed"
                href="#"
                data-bs-toggle="collapse"
                data-bs-target="#collapseEmployee"
                aria-expanded="false"
                aria-controls="collapseEmployee"
              >
                <div class="sb-nav-link-icon">
                <i class="fa-solid fa-utensils"></i>
                </div>
                Products List
                <div class="sb-sidenav-collapse-arrow">
                  <i class="fas fa-angle-down"></i>
                </div>
              </a>
              <div
                class="collapse"
                id="collapseEmployee"
                aria-labelledby="headingOne"
                data-bs-parent="#sidenavAccordion"
              >
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="beef.php"
                    >Beef</a
                  >
                </nav>
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="pork.php"
                    >Pork</a
                  >
                </nav>
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="chicken.php"
                    >Chicken</a
                  >
                </nav>
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="lamb.php"
                    >Lamb</a
                  >
                </nav>
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="deli.php"
                    >Deli Meats</a
                  >
                </nav>

              </div>
              <a class="nav-link" href="customers.php">
                <div class="sb-nav-link-icon">
                  <i class="fa-solid fa-hand-holding-heart"></i>
                </div>
                Customers
              </a>
              <a class="nav-link" href="reports.php">
                <div class="sb-nav-link-icon">
                  <i class="fa-solid fa-hand-holding-dollar"></i>
                </div>
                Reports
              </a>
              <a class="nav-link" href="templateModify.php">
                <div class="sb-nav-link-icon">
                  <i class="fa-solid fa-edit"></i>
                </div>
                Inventory
              </a>

        
              <div class="sb-sidenav-menu-heading">Report </div>
              <a class="nav-link" href="auditLogs.php">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-person-walking"></i></div>
                Audit Logs
              </a>
              <a class="nav-link" href="auditTrail.php">
                <div class="sb-nav-link-icon">
                  <i class="fa-solid fa-chart-line"></i>
                </div>
                Audit Trail
              </a>
              <a class="nav-link" href="history.php">
                <div class="sb-nav-link-icon">
                <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                Transaction History
              </a>
            </div>
          </div>
        </nav>
      </div>