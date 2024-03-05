<?php

/**
 * @param string $nav => to add class nav open in sidebar
 * @return void
 * function to show sidebar for each page
 */
function showSidebar(string $nav): void
{
    ?>
  <div class="sidebar d-none d-lg-flex flex-column gap-5">
    <div class="sidebar-content">
      <nav class="main-nav">
        <ul class="main-nav-list">
          <li class="nav-item <?php if ($nav == "dashboard") {
              echo "nav-open";
          } ?>">
            <a class="main-nav-link" href="../dashboard.php">
              <ion-icon
                      name="file-tray-full-outline"
                      class="nav-icon"
              ></ion-icon>
              Dashboard
            </a>
          </li>
          <li class="nav-item <?php if ($nav == "persons") {
              echo "nav-open";
          } ?>">
            <a class="main-nav-link" href="../persons.php">
              <ion-icon
                    name="people-outline"
                    class="nav-icon"
              ></ion-icon>
              Persons
            </a>
          </li>
          <li class="nav-item <?php if ($nav == "jobs") {
              echo "nav-open";
          } ?>">
            <a class="main-nav-link" href="../jobs.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                   class="bi bi-pc-display-horizontal nav-icon" viewBox="0 0 16 16">
                <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v7A1.5 1.5 0 0 0 1.5 10H6v1H1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h14a1 1
                0 0 0 1-1v-3a1 1 0 0 0-1-1h-5v-1h4.5A1.5 1.5 0 0 0 16 8.5v-7A1.5 1.5 0 0 0 14.5 0zm0 1h13a.5.5 0 0 1
                .5.5v7a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .5-.5M12 12.5a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0m2
                0a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0M1.5 12h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1M1 14.25a.25.25 0 0 1
                .25-.25h5.5a.25.25 0 1 1 0 .5h-5.5a.25.25 0 0 1-.25-.25"/>
              </svg>
              Jobs
            </a>
          </li>
        </ul>
      </nav>

      <div class="profile">
        <h6 class="heading-6 sub-heading m-0">Account</h6>
        <nav class="main-nav">
          <ul class="main-nav-list">
            <li class="nav-item <?php if ($nav == "profile") {
                echo "nav-open";
            } ?>">
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