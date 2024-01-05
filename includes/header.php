<?php

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
                        <a class="main-nav-link" href="../dashboard.php"
                        >
                          <ion-icon
                            name="file-tray-full-outline"
                            class="nav-icon"
                          ></ion-icon>
                          Dashboard</a
                        >
                      </li>
                      <li class="nav-item <?php if ($nav == "persons"){ echo "nav-open"; }?>">
                        <a class="main-nav-link" href="../persons.php"
                        >
                          <ion-icon
                            name="people-outline"
                            class="nav-icon"
                          ></ion-icon>
                          Persons</a>
                      </li>
                    </ul>
                  </nav>

                  <div class="profile">
                    <h6 class="heading-6 sub-heading m-0">Account</h6>
                    <nav class="main-nav">
                      <ul class="main-nav-list">
                        <li class="nav-item <?php if ($nav == "profile"){ echo "nav-open"; } ?>">
                          <a class="main-nav-link" href="../myProfile.php"
                          >
                            <ion-icon
                              name="person-circle-outline"
                              class="nav-icon"
                            ></ion-icon>
                            My Profile</a
                          >
                        </li>
                        <li class="nav-item">
                          <a class="main-nav-link cta" href="../logout.php"
                          >
                            <ion-icon
                              name="log-out-outline"
                              class="nav-icon"
                            ></ion-icon>
                            Logout</a
                          >
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