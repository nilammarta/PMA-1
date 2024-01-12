<?php

/**
 * @param string $nav => to add class nav open in sidebar
 * @return void
 * function to show sidebar for each page
 */
function showSidebar(string $nav): void
{?>
  <div class="sidebar d-none d-lg-flex flex-column gap-5">
    <div class="sidebar-content">
      <nav class="main-nav">
        <ul class="main-nav-list">
          <li class="nav-item <?php if ($nav == "dashboard"){ echo "nav-open"; } ?>">
            <a class="main-nav-link" href="../dashboard.php">
              <ion-icon
                name="file-tray-full-outline"
                class="nav-icon"
              ></ion-icon>
              Dashboard
            </a>
          </li>
          <li class="nav-item <?php if ($nav == "persons"){ echo "nav-open";} ?>">
            <a class="main-nav-link" href="../persons.php">
              <ion-icon
                name="people-outline"
                class="nav-icon"
              ></ion-icon>
              Persons
            </a>
          </li>
        </ul>
      </nav>

      <div class="profile">
        <h6 class="heading-6 sub-heading m-0">Account</h6>
        <nav class="main-nav">
          <ul class="main-nav-list">
            <li class="nav-item <?php if ($nav == "profile"){ echo "nav-open";} ?>">
              <a class="main-nav-link" href="../my-profile.php">
                <ion-icon
                  name="person-circle-outline"
                  class="nav-icon"
                ></ion-icon>
                My Profile
              </a>
            </li>
            <li class="nav-item">
              <a class="main-nav-link cta" href="../logout.php">
                <ion-icon
                  name="log-out-outline"
                  class="nav-icon"
                ></ion-icon>
                Logout
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
<?php } ?>