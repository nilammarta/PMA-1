<?php

/**
 * @param string $nav => to add class nav-open in sidebar
 * @return void
 * function to show header
 */
function showHeader(string $nav) : void
{
?>
  <body>
    <header class="header-section">
      <div class="header">
        <div class="d-flex justify-content-between align-items-center">
          <div class="logo-box d-flex align-items-center gap-2">
            <img
                class="logo-img"
                src="../assets/img/Permap-logo-2.png"
                alt="persons management logo"
            />
              <h5 class="heading-2 logo-text m-0">PERMAP</h5>
          </div>

          <div class="d-flex justify-content-end align-items-center">
            <div class="d-lg-none">
              <button
                  class="btn btn-menu p-0"
                  type="button"
                  data-bs-toggle="offcanvas"
                  data-bs-target="#staticBackdrop"
                  aria-controls="staticBackdrop"
              >
                  <ion-icon class="icon-menu" name="menu-outline"></ion-icon>
              </button>

              <!-- Side Bar -->
              <div
                class="offcanvas offcanvas-start"
                data-bs-backdrop="static"
                tabindex="-1"
                id="staticBackdrop"
                aria-labelledby="staticBackdropLabel"
              >
                <div class="offcanvas-header">
                  <img
                      class="logo-img"
                      src="../assets/img/Permap-logo-2.png"
                      alt="permap logo"
                  />
                  <h5
                      class="offcanvas-title heading-2 m-0"
                      id="staticBackdropLabel"
                  >
                      PERMAP
                  </h5>
                  <button
                      class="btn--close"
                      type="button"
                      data-bs-dismiss="offcanvas"
                      aria-label="Close"
                  >
                      <ion-icon class="icon-header" name="close"></ion-icon>
                  </button>
                </div>
                <div class="offcanvas-body d-flex flex-column gap-4">
                  <nav class="main-nav">
                    <ul class="main-nav-list">
                      <li class="nav-item <?php if ($nav == "dashboard"){ echo "nav-open"; } ?>">
                        <a class="main-nav-link" href="../dashboard.php">
                          <ion-icon
                            name="file-tray-full"
                            class="nav-icon"
                          ></ion-icon>
                          DASHBOARD
                        </a>
                      </li>
                      <li class="nav-item <?php if ($nav == "persons"){ echo "nav-open"; }?>">
                        <a class="main-nav-link" href="../persons.php">
                          <ion-icon
                            name="people"
                            class="nav-icon"
                          ></ion-icon>
                          PERSONS
                        </a>
                      </li>
                      <li class="nav-item <?php if ($nav == "jobs") {
                          echo "nav-open";
                      } ?>">
                        <a class="main-nav-link" href="../jobs/jobs.php">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                               class="bi bi-pc-display-horizontal nav-icon" viewBox="0 0 16 16">
                            <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v7A1.5 1.5 0 0 0 1.5 10H6v1H1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h14a1 1
                              0 0 0 1-1v-3a1 1 0 0 0-1-1h-5v-1h4.5A1.5 1.5 0 0 0 16 8.5v-7A1.5 1.5 0 0 0 14.5 0zm0 1h13a.5.5 0 0 1
                              .5.5v7a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .5-.5M12 12.5a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0m2
                              0a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0M1.5 12h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1M1 14.25a.25.25 0 0 1
                              .25-.25h5.5a.25.25 0 1 1 0 .5h-5.5a.25.25 0 0 1-.25-.25"/>
                          </svg>
                          JOBS
                        </a>
                      </li>
                    </ul>
                  </nav>

                  <div class="profile">
                    <h6 class="heading-6 sub-heading m-0">Account</h6>
                    <nav class="main-nav">
                      <ul class="main-nav-list">
                        <li class="nav-item <?php if ($nav == "profile"){ echo "nav-open"; } ?>">
                          <a class="main-nav-link" href="../my-profile.php">
                            <ion-icon
                              name="person-circle"
                              class="nav-icon"
                            ></ion-icon>
                            MY PROFILE
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="main-nav-link cta" href="../logout.php">
                            <ion-icon
                              name="log-out"
                              class="nav-icon"
                            ></ion-icon>
                            LOGOUT
                          </a>
                        </li>
                      </ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div>

            <div class="user-box">
              <ion-icon
                  class="user-icon btn-header"
                  name="person-circle-outline"
              ></ion-icon>
            </div>
            <div class="d-none d-lg-block">
              <div class="user-email btn-header">
                  <?php echo $_SESSION['userEmail'] ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
<?php } ?>