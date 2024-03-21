<?php
include("action/dashboard-action.php");
require_once __DIR__ . "/action/common-action.php";
require_once "includes/html-head.php";
require_once "includes/header.php";
require_once "includes/sidebar.php";
require_once "includes/pma-db.php";
global $PDO;

session_start();
checkUserLogin($_SESSION['userEmail']);

//$persons = getPersonsData();

addHeadCode("dashboard.css", "DASHBOARD - Persons Management App");
showHeader("dashboard");
?>
    <main>
      <section class="main-section d-flex flex-row">
        <?php showSidebar("dashboard"); ?>

        <div class="main-content">
          <div class="dashboard m-3 m-md-4">
            <h2 class="heading-2 content-title m-0 p-3">DASHBOARD</h2>
            <p class="dashboard-description">
              Hi
              <?php {
                  echo $_SESSION['userName'];
              } ?>!, Welcome in Dashboard
            </p>
            <p class="card-text">Last Activity : <strong> <?php echo lastActivity($_SESSION['logout']) ?> </strong></p>

            <!-- widget -->
            <div class="widget">
              <div class="row row-gap-4">
                <div class="col-12 col-sm-6 col-xl-4">
                  <a href="persons.php" class="widget-link">
                    <div class="card card-1" style="width: 100%">
                      <div class="card-body">
                        <h3 class="card-title">
                          <ion-icon class="card-icon" name="people"></ion-icon>
                          <?php
                            echo getCountPersonsByCategory("allPersons");
                          ?>
                        </h3>

                        <p class="card-subtitle mb-2"
                        >Persons</p>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="col-12 col-sm-6 col-xl-4">
                  <a href="persons.php?search=&filter=productive" class="widget-link">
                    <div class="card card-2" style="width: 100%">
                      <div class="card-body">
                        <h3 class="card-title">
                          <ion-icon
                            class="card-icon"
                            name="accessibility"
                          ></ion-icon>
                          <?php
                            $adult = getCountPersonsByCategory("productive");
                            echo $adult;
                          ?>
                        </h3>
                        <p class="card-subtitle mb-2"
                        >In Productive Ages</p>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="col-12 col-sm-6 col-xl-4">
                  <a href="persons.php?search=&filter=passedAway" class="widget-link">
                    <div class="card card-3" style="width: 100%">
                      <div class="card-body">
                        <h3 class="card-title">
                          <ion-icon class="card-icon" name="man"></ion-icon>
                          <?php
                            $passed = getCountPersonsByCategory("passedAway", $persons);
                            echo $passed;
                          ?>
                        </h3>
                        <p class="card-subtitle mb-2">Passed Away</p>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="col-12 col-sm-6 col-xl-4">
                  <a href="persons.php?search=&filter=children" class="widget-link">
                    <div class="card card-4" style="width: 100%">
                      <div class="card-body">
                        <h3 class="card-title">
                          <ion-icon
                            class="card-icon"
                            name="people-circle-outline"
                          ></ion-icon>
                          <?php
                            $child = getCountPersonsByCategory("children", $persons);
                            echo $child;
                          ?>
                        </h3>
                        <p class="card-subtitle mb-2">Children</p>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="col-12 col-sm-6 col-xl-4">
                  <a href="persons.php?search=&filter=male" class="widget-link">
                    <div class="card card-5" style="width: 100%">
                      <div class="card-body">
                        <h3 class="card-title">
                          <ion-icon class="card-icon" name="body"></ion-icon>
                          <?php
                            $male = getCountPersonsByCategory("male", $persons);
                            echo $male;
                          ?>
                        </h3>
                        <p class="card-subtitle mb-2">Male</p>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="col-12 col-sm-6 col-xl-4">
                  <a href="persons.php?search=&filter=female" class="widget-link">
                    <div class="card card-6" style="width: 100%">
                      <div class="card-body">
                        <h3 class="card-title">
                          <ion-icon class="card-icon" name="woman"></ion-icon>
                          <?php
                            $female = getCountPersonsByCategory("female", $persons);
                            echo $female;
                          ?>
                        </h3>
                        <p class="card-subtitle mb-2">Female</p>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
<?php require_once "includes/footer.php"; ?>
