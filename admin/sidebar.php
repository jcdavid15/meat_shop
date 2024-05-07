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
              <a class="nav-link" href="announcement.php">
                <div class="sb-nav-link-icon">
                  <i class="fa-solid fa-bullhorn"></i>
                </div>
                Announcement List
              </a>
              <a class="nav-link" href="request.php">
                <div class="sb-nav-link-icon">
                  <i class="fa-solid fa-hand-holding-heart"></i>
                </div>
                Service Request Status
              </a>
              <a class="nav-link" href="manageServices.php">
                <div class="sb-nav-link-icon">
                  <i class="fa-solid fa-hand-holding-dollar"></i>
                </div>
                Manage Services
              </a>
              <a class="nav-link" href="templateModify.php">
                <div class="sb-nav-link-icon">
                  <i class="fa-solid fa-edit"></i>
                </div>
                Template Configuration
              </a>

              <div class="sb-sidenav-menu-heading">Account Management</div>
              <a
                class="nav-link collapsed"
                href="#"
                data-bs-toggle="collapse"
                data-bs-target="#collapseEmployee"
                aria-expanded="false"
                aria-controls="collapseEmployee"
              >
                <div class="sb-nav-link-icon">
                  <i class="fa-solid fa-briefcase"></i>
                </div>
                Employee
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
                  <a class="nav-link" href="employeeList.php"
                    >Accounts List</a
                  >
                </nav>
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="employeeDeactivated.php"
                    >Deactivated Accounts</a
                  >
                </nav>

              </div>
              <a
                class="nav-link collapsed"
                href="#"
                data-bs-toggle="collapse"
                data-bs-target="#collapseResidence"
                aria-expanded="false"
                aria-controls="collapseResidence"
              >
                <div class="sb-nav-link-icon">
                  <i class="fa-solid fa-house-user"></i>
                </div>
                Residence
                <div class="sb-sidenav-collapse-arrow">
                  <i class="fas fa-angle-down"></i>
                </div>
              </a>
              <div
                class="collapse"
                id="collapseResidence"
                aria-labelledby="headingOne"
                data-bs-parent="#sidenavAccordion"
              >
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="residenceList.php"
                    >Accounts List</a
                  >
                </nav>
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="residenceDeactivated.php"
                    >Deactivated Accounts</a
                  >
                </nav>
              </div>
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