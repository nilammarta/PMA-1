<?php

session_start();

if (!isset($_SESSION['userEmail'])) {
    header("Location: login-action.php");
    exit();
}

include("action/common-action.php");
include("action/persons-action.php");
$appName = "PERSONS - Person Management App";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link
          href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap"
          rel="stylesheet"
  />

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <link
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous"
  />

  <script
          type="module"
          src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"
  ></script>
  <script
          nomodule=""
          src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"
  ></script>

  <link
          rel="apple-touch-icon"
          sizes="57x57"
          href="assets/favicon/apple-icon-57x57.png"
  />
  <link
          rel="apple-touch-icon"
          sizes="60x60"
          href="assets/favicon/apple-icon-60x60.png"
  />
  <link
          rel="apple-touch-icon"
          sizes="72x72"
          href="assets/favicon/apple-icon-72x72.png"
  />
  <link
          rel="apple-touch-icon"
          sizes="76x76"
          href="assets/favicon/apple-icon-76x76.png"
  />
  <link
          rel="apple-touch-icon"
          sizes="114x114"
          href="assets/favicon/apple-icon-114x114.png"
  />
  <link
          rel="apple-touch-icon"
          sizes="120x120"
          href="assets/favicon/apple-icon-120x120.png"
  />
  <link
          rel="apple-touch-icon"
          sizes="144x144"
          href="assets/favicon/apple-icon-144x144.png"
  />
  <link
          rel="apple-touch-icon"
          sizes="152x152"
          href="assets/favicon/apple-icon-152x152.png"
  />
  <link
          rel="apple-touch-icon"
          sizes="180x180"
          href="assets/favicon/apple-icon-180x180.png"
  />
  <link
          rel="icon"
          type="image/png"
          sizes="192x192"
          href="assets/favicon/android-icon-192x192.png"
  />
  <link
          rel="icon"
          type="image/png"
          sizes="32x32"
          href="assets/favicon/favicon-32x32.png"
  />
  <link
          rel="icon"
          type="image/png"
          sizes="96x96"
          href="assets/favicon/favicon-96x96.png"
  />
  <link
          rel="icon"
          type="image/png"
          sizes="16x16"
          href="assets/favicon/favicon-16x16.png"
  />
  <link rel="manifest" href="assets/favicon/manifest.json"/>
  <meta name="msapplication-TileColor" content="#ffffff"/>
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png"/>
  <meta name="theme-color" content="#ffffff"/>

  <link href="assets/css/general.css" rel="stylesheet"/>
  <link href="assets/css/persons.css" rel="stylesheet"/>
  <link href="assets/query/query.css" rel="stylesheet"/>

  <title><?php
      echo $appName;
      ?>
  </title>
</head>
<body>
<header class="header-section">
  <div class="header">
    <div class="d-flex justify-content-between align-items-center">
      <div class="logo-box d-flex align-items-center gap-2">
        <img
                class="logo-img"
                src="assets/img/Permap-logo-2.png"
                alt="permap logo"
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
                      src="assets/img/Permap-logo-2.png"
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
                  <li class="nav-item">
                    <a class="main-nav-link" href="dashboard.php"
                    >
                      <ion-icon
                              name="file-tray-full-outline"
                              class="nav-icon"
                      ></ion-icon>
                      Dashboard</a
                    >
                  </li>
                  <li class="nav-item nav-open">
                    <a class="main-nav-link" href="persons.php"
                    >
                      <ion-icon
                              name="people-outline"
                              class="nav-icon"
                      ></ion-icon>
                      Persons</a
                    >
                  </li>
                </ul>
              </nav>

              <div class="profile">
                <h6 class="heading-6 sub-heading m-0">Account</h6>
                <nav class="main-nav">
                  <ul class="main-nav-list">
                    <li class="nav-item">
                      <a class="main-nav-link" href="myProfile.php"
                      >
                        <ion-icon
                                name="person-circle-outline"
                                class="nav-icon"
                        ></ion-icon>
                        My Profile</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="main-nav-link cta" href="logout.php"
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

<main>
  <section class="main-section d-flex flex-row">
    <div class="sidebar d-none d-lg-flex flex-column gap-5">
      <div class="sidebar-content">
        <nav class="main-nav">
          <ul class="main-nav-list">
            <li class="nav-item">
              <a class="main-nav-link" href="dashboard.php"
              >
                <ion-icon
                        name="file-tray-full-outline"
                        class="nav-icon"
                ></ion-icon>
                Dashboard</a
              >
            </li>
            <li class="nav-item nav-open">
              <a class="main-nav-link" href="persons.php"
              >
                <ion-icon
                        name="people-outline"
                        class="nav-icon"
                ></ion-icon>
                Persons</a
              >
            </li>
          </ul>
        </nav>

        <div class="profile">
          <h6 class="heading-6 sub-heading m-0">Account</h6>
          <nav class="main-nav">
            <ul class="main-nav-list">
              <li class="nav-item">
                <a class="main-nav-link" href="myProfile.php"
                >
                  <ion-icon
                          name="person-circle-outline"
                          class="nav-icon"
                  ></ion-icon>
                  My Profile</a
                >
              </li>
              <li class="nav-item">
                <a class="main-nav-link cta" href="logout.php"
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

    <div class="main-content">
      <div class="persons m-3 m-md-4">
        <nav class="navbar bg-body-tertiary p-0">
          <div class="container-fluid nav p-0">
            <h2 class="heading-2 m-0 p-3">PERSONS</h2>
            <div class="d-sm-flex">
              <form name="search-form" class="d-sm-flex p-3" role="search" action="#table" method="get">
                <div class="d-flex mb-2">
                  <label for="search-input"></label>
                  <input
                          name="search"
                          id="search-input"
                          class="form-control me-1"
                          type="search"
                          placeholder="Search"
                          aria-label="Search"
                  />
                  <button class="btn btn-search me-2" type="submit">
                    <ion-icon name="search-outline"></ion-icon>
                  </button>
                </div>
              </form>

              <!-- dropdown filter person -->
              <div class="dropdown me-4 p-3">
                <button
                        class="btn btn-secondary dropdown-toggle btn-dropdown"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                >
                  Filter Person
                  <ion-icon name="filter"></ion-icon>
                </button>

                <!--<form name="filter" method="get">-->
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item" href="?adult">
<!--                      <button name="adult" class="btn-dropdown-item">-->
                      In Productive Ages
<!--                      </button>-->
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="?children">
                      Children
                      <!--<button name="children" class="btn-dropdown-item"> Children</button>-->
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="?male">
                      Male
                      <!--<button name="male" class="btn-dropdown-item"> Male</button>-->
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="?female">
                      Female
                      <!--<button name="female" class="btn-dropdown-item">Female</button>-->
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="?passedAway">
                      <!--<button name="passedAway" class="btn-dropdown-item">-->
                      Passed Away
                      <!--</button>-->
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </nav>


        <!-- add -->
        <div class="d-flex">
          <a
            href="create.php"
            class="table-btn btn-primary btn-lg btn-add p-3 mt-5 btn-link"
            type="button"
          >
            <ion-icon class="add-icon me-2" name="person-add"></ion-icon>
            Add
          </a>
        </div>

        <!-- table -->
        <div class="table-data mt-4" id="table">
          <div class="table-responsive">
            <table class="table table-hover">
                <?php
                if (isset($_GET["adult"])) {
                    $persons = filter("adult");
                } else if (isset($_GET['children'])) {
                    $persons = filter('child');
                } else if (isset($_GET["male"])) {
                    $persons = filter("male");
                } else if (isset($_GET["female"])) {
                    $persons = filter("female");
                } else if (isset($_GET["passedAway"])) {
                    $persons = filter("passedAway");
                } else {
                    $persons = personsData();
                }

                if ($persons == null) { ?>
                  <div class="alert alert-warning mx-5" role="alert">
                    Data is empty!
                  </div>
                <?php } elseif ($_GET["search"] == null && $persons != null) { ?>
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Email</th>
                      <th scope="col">Name</th>
                      <th scope="col" colspan="2">Role</th>
                    </tr>
                  </thead>

                  <tbody>
                  <?php
                  $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
                  $limit = 3;

                  $previous = $page - 1;
                  $next = $page + 1;

                  $data = getPaginatedData($persons, $page, $limit);
                  $personsData = $data["pagingData"];

                  $number = ($page - 1) * $limit + 1;

                  for ($i = 0; $i < count($personsData); $i++) { ?>
                    <tr>
                      <td><?php echo $number++ ?></td>
                      <td><?php echo $personsData[$i]["email"] ?></td>
                      <td><?php echo $personsData[$i]["firstName"] . " " . $personsData[$i]["lastName"] ?></td>
                      <td><?php echo $personsData[$i]["role"] ?></td>
                      <td>
                        <div class="d-grid gap-2 d-flex justify-content-md-end">
                          <form name="person" method="post">
                            <?php if (isset($_GET['search']) == null){ ?>
                              <a
                                class="btn btn-outline-light me-md-2 btn-table"
                                type="button"
                                href="view.php?<?php echo $_GET['search']?>&person=<?php echo $persons[$number - 2]["id"] ?>"
                                role="button"
                              >
                                <ion-icon
                                  class="btn-icon"
                                  name="eye-sharp"
                                ></ion-icon>
                              </a>
                            <?php } ?>
                            <a
                              class="btn btn-outline-light btn-table"
                              type="button"
                              href="edit.php"
                            >
                              <ion-icon
                                class="btn-icon"
                                name="create-sharp"
                              ></ion-icon>
                            </a>
                          </form>
                        </div>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                <?php } elseif ($_GET['search'] != null && $persons != null) {
                    $searchResults = searchPerson($persons);
                    if ($searchResults == null) { ?>
                      <div class="alert alert-warning mx-5" role="alert">
                        Search results is not found!
                      </div>
                    <?php } else { ?>
                      <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Email</th>
                        <th scope="col">Name</th>
                        <th scope="col" colspan="2">Role</th>
                      </tr>
                      </thead>
                      <?php for ($i = 0; $i < count($searchResults); $i++) { ?>
                        <tbody>
                          <tr>
                            <td><?php echo $i + 1 ?></td>
                            <td><?php echo $searchResults[$i]["email"] ?></td>
                            <td><?php echo $searchResults[$i]["firstName"] . " " . $searchResults[$i]["lastName"] ?></td>
                            <td><?php echo $searchResults[$i]["role"] ?></td>
                            <td>
                              <div class="d-grid gap-2 d-flex justify-content-md-end">
                                <a
                                  class="btn btn-outline-light me-md-2 btn-table"
                                  type="button"
                                  href="view.php?search=<?php echo$_GET['search']?>&person=<?php echo $searchResults[$i]["id"] ?>"
                                  role="button"
                                >
                                  <ion-icon
                                    class="btn-icon"
                                    name="eye-sharp"
                                  ></ion-icon>
                                </a>
                                <a
                                  class="btn btn-outline-light btn-table"
                                  type="button"
                                  href="edit.php"
                                >
                                  <ion-icon
                                    class="btn-icon"
                                    name="create-sharp"
                                  ></ion-icon>
                                </a>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      <?php } ?>
                    <?php } ?>
                <?php } ?>
            </table>
            <?php if (isset($_GET["search"]) == null) {
                if (isset($_GET["adult"])) {
                    $filter = "?adult&";
                } elseif (isset($_GET["children"])) {
                    $filter = "?children&";
                } elseif (isset($_GET["male"])) {
                    $filter = "?male&";
                } elseif (isset($_GET["female"])) {
                    $filter = "?female&";
                } elseif (isset($_GET["passedAway"])) {
                    $filter = "?passedAway&";
                } else {
                    $filter = "?";
                } ?>

                <!--Pagination -->
                <div class="page">
                  <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                      <li class="page-item">
                          <?php if ($page > 1) { ?>
                            <a class="page-link"
                               href='<?php echo $filter ?>page=<?php echo $previous ?>'
                            >
                              <ion-icon
                                      class="page-icon"
                                      name="caret-back-outline"
                              ></ion-icon>
                            </a>
                          <?php } ?>
                      </li>

                      <?php if ($data['totalPage'] > 1) {
                          for ($i = 1; $i <= $data["totalPage"]; $i++) {
                              if (isset($_GET['page']) == null && $i == 1) {
                                  ?>
                                <li class="page-item active">
                                  <a class="page-link"
                                     href="<?php echo $filter ?>page=<?php echo $i ?>"> <?php echo $i ?>
                                  </a>
                                </li>
                              <?php } else if ($_GET["page"] == $i) { ?>
                                <li class="page-item active">
                                  <a class="page-link"
                                     href="<?php echo $filter ?>page=<?php echo $i ?>"> <?php echo $i ?>
                                  </a>
                                </li>
                              <?php } else { ?>
                                <li class="page-item">
                                  <a class="page-link"
                                     href="<?php echo $filter ?>page=<?php echo $i ?>"> <?php echo $i ?>
                                  </a>
                                </li>
                              <?php } ?>
                          <?php }
                      } ?>

                    <li class="page-item">
                        <?php if ($page < $data["totalPage"]) { ?>
                          <a class="page-link"
                             href='<?php echo $filter ?>page=<?php echo $next ?>'
                          >
                            <ion-icon
                              class="page-icon"
                              name="caret-forward-outline"
                            ></ion-icon>
                          </a>
                        <?php } ?>
                    </li>
                  </ul>
                </nav>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"
></script>

<script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"
></script>
<script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"
></script>
</body>
</html>
