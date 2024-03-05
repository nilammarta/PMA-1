<?php

require_once "includes/html-head.php";
require_once "includes/header.php";
require_once "includes/sidebar.php";
require_once "includes/pma-db.php";

session_start();
addHeadCode("jobs.css", "JOBS - Person Management App");
showHeader("jobs");
?>
  <main>
    <section class="main-section d-flex flex-row">
        <?php showSidebar("jobs"); ?>
      <div class="main-content">
        <div class="job m-3 m-md-4">
          <div class="content-title">
            <h2 class="heading-2 m-0 p-3">LIST OF JOBS</h2>
          </div>
        </div>
        <div class="search-add d-flex justify-content-between">
            <?php if ($_SESSION['userRole'] == "A") { ?>
              <div class="d-flex">
                <a
                    href="create.php"
                    class="table-btn btn-primary btn-lg btn-add p-3 mb-5 ms-5 btn-link"
                    type="button"
                >
                  <ion-icon class="add-icon me-2" name="person-add"></ion-icon>
                  Add
                </a>
              </div>
            <?php } ?>
          <div class="me-5">
            <nav class="navbar search-job">
              <div class="container-fluid">
                <form class="d-flex" role="search">
                  <input class="form-control me-2 input-search" type="search" placeholder="Search job" aria-label="Search">
                  <button class="btn btn-search d-flex" type="submit">
                    <ion-icon class="me-1" name="search-outline"></ion-icon>
                    Search
                  </button>
                </form>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </section>
  </main>
<?php require_once "includes/footer.php" ?>