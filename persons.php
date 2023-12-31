<?php

include("action/common-action.php");
include("action/persons-action.php");
require_once "includes/html-head.php";
require_once "includes/header.php";
require_once "includes/sidebar.php";

session_start();

checkUserLogin($_SESSION['userEmail']);

unset($_SESSION['personId']);
unset($_SESSION['page']);
unset($_SESSION['filter']);
unset($_SESSION['search']);
unset($_SESSION['inputData']);
unset($_SESSION['errorData']);
unset($_SESSION['errorPassword']);

$appName = "PERSONS - Person Management App";

if (isset($_GET["search"]) != null && isset($_GET['filter']) != null) {
    $url = "search=" . $_GET['search'] . "&filter=" . $_GET['filter'] . "&";
} else {
    $url = "";
}
addHeadCode("persons.css", "PERSONS - Persons Management App");
showHeader("persons");
?>
    <main>
      <section class="main-section d-flex flex-row">
        <?php showSidebar("persons"); ?>

        <div class="main-content">
          <div class="persons m-3 m-md-4">
            <nav class="navbar bg-body-tertiary p-0">
              <div class="container-fluid nav p-0">
                <h2 class="heading-2 m-0 p-3">PERSONS</h2>
                <div class="d-sm-flex">
                  <form name="search-form" class="d-sm-flex p-3" role="search" action="#table" method="get">
                    <div class="d-sm-flex">
                      <label for="search-input"></label>
                      <input
                        name="search"
                        id="search-input"
                        class="form-control me-2 mb-2"
                        type="search"
                        placeholder="Search"
                        value="<?php echo $_GET['search']; ?>"
                        aria-label="Search"
                      />

                      <select name="filter" class="form-select select-filter me-2 mb-2" aria-label="Default select example">
                        <option name="filter" class="select-item selected" value="<?php if (isset($_GET['filter'])) {
                          echo getFilterValue($_GET['filter']);
                        }else{
                          echo "allPersons";
                        } ?>" selected><?php if (isset($_GET['filter'])) {
                          echo getFilter($_GET['filter']);
                        } else {
                          echo "All Persons Data";
                        } ?></option>
                        <option class="select-item" value="allPersons">All Persons Data</option>
                        <option class="select-item" value="elderly">Elderly ( > 64 y.o)</option>
                        <option class="select-item" value="productive">In Productive Age (15-64 y.o)</option>
                        <option class="select-item" value="children">Children (0-15 y.o)</option>
                        <option class="select-item" value="male">Male</option>
                        <option class="select-item" value="female">Female</option>
                        <option class="select-item" value="passedAway">Passed Away</option>
                      </select>
                    </div>

                    <button class="btn btn-search mb-2 me-2" type="submit">
                      <ion-icon name="search-outline"></ion-icon>
                      search
                    </button>

                    <?php if (isset($_GET['filter']) && $_GET['filter'] != "allPersons" || isset($_GET['search']) && $_GET['search'] != null) { ?>
                      <a role="button" class="btn btn-search mb-2" type="reset" href="persons.php">
                        <ion-icon class="reset-icon" name="reload-outline"></ion-icon> reset
                      </a>
                    <?php } ?>
                  </form>
                </div>
              </div>
            </nav>

            <!-- add -->
            <?php if ($_SESSION['userRole'] == "ADMIN"){?>
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
            <?php } ?>

            <div class="table-data mt-5" id="table">
              <div class="table-responsive">

                  <?php
                  if (isset($_GET['search']) != null && isset($_GET['filter']) != null) {
                      $persons = searchPerson(filter(getFilterValue($_GET['filter'])), $_GET['search']);
                  } else if (isset($_GET["filter"])) {
                      $persons = filter(getFilterValue($_GET["filter"]));
                  } else {
                      $persons = getPersonsData();
                  }

                  if ($_GET["search"] != null && $persons == null) { ?>
                    <div class="alert alert-danger mx-5" role="alert">
                      Search result is not found!
                    </div>
                  <?php } elseif ($persons == null) { ?>
                    <div class="alert alert-danger mx-5" role="alert">
                      Data is empty!
                    </div>
                  <?php } else { ?>
                      <?php

                      if (isset($_GET['page']) && $_GET['page'] < 1) {
                          $page = 1;
                      } else if (isset($_GET['page']) == null) {
                          $page = 1;
                      } else if (isset($_GET['page']) && !is_numeric($_GET['page'])) {
                          $page = 1;
                      } else {
                          $page = $_GET['page'];
                      }

                      $limit = 5;

                      $data = getPaginatedData($persons, $page, $limit);
                      if ($data['totalPage'] < $_GET['page']) {
                          $page = 1;
                          $data = getPaginatedData($persons, $page, $limit);
                      }

                      $personsData = $data["pagingData"];
                      $previous = $page - 1;
                      $next = $page + 1;
                      $number = ($page - 1) * $limit + 1;

                      ?>

                    <table class="table table-hover table-bordered">

                      <thead>
                        <tr>
                          <th class="text-center p-3" scope="col">No</th>
                          <th class="text-center p-3" scope="col">Email</th>
                          <th class="text-center p-3" scope="col">Name</th>
                          <th class="text-center p-3" scope="col">Age</th>
                          <th class="text-center p-3" scope="col">Status</th>
                          <th class="text-center p-3" scope="col">Role</th>
                          <th scope="col"></th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php for ($i = 0; $i < count($personsData); $i++) { ?>
                          <tr>
                            <td class="text-center"><?php echo $number++ ?></td>
                            <td><?php echo $personsData[$i]["email"]; ?></td>
                            <td><?php echo $personsData[$i]["firstName"] . " " . $personsData[$i]["lastName"]; ?></td>
                            <td class="text-center"><?php echo getAge($personsData[$i]['birthDate']); ?></td>
                            <td class="text-center"><?php echo getStatus($personsData[$i]['alive']) ?></td>
                            <td class="text-center"><?php echo $personsData[$i]["role"]; ?></td>
                            <td>
                              <div class="d-grid gap-2 d-flex justify-content-md-center">
                                <!-- page untuk di tambahkan pada href -->
                                  <?php
                                  if (isset($_GET['page']) == null) {
                                      $page = 1;
                                  } elseif (is_numeric($_GET['page']) == false && $_GET['page'] < 1) {
                                      $page = 1;
                                  } else {
                                      $page = $_GET['page'];
                                  }
                                  ?>

                                <?php if ($personsData[$i]['email'] == $_SESSION['userEmail']){ ?>
                                  <a
                                    class="btn btn-outline-light me-md-2 btn-table"
                                    type="button"
                                    href="myProfile.php"
                                    role="button"
                                  >
                                    <ion-icon
                                      class="btn-icon"
                                      name="eye-sharp"
                                    ></ion-icon> <?php if ($_SESSION['userRole'] == "MEMBER"){
                                      echo "view";
                                      }?>
                                  </a>
                                <?php } else {?>
                                  <a
                                    class="btn btn-outline-light me-md-2 btn-table"
                                    type="button"
                                    href="view.php?<?php echo $url ?>page=<?php echo $page ?>&person=<?php echo $personsData[$i]["id"] ?>"
                                    role="button"
                                  >
                                    <ion-icon
                                      class="btn-icon"
                                      name="eye-sharp"
                                    ></ion-icon> <?php if ($_SESSION['userRole'] == "MEMBER"){
                                        echo "view";
                                      }?>
                                  </a>
                                <?php } ?>

                                <?php if ($_SESSION['userRole'] == "ADMIN") {
                                  if ($personsData[$i]['email'] == $_SESSION['userEmail']) { ?>
                                    <!-- link untuk mengarah ke my profile page, karena mengedit data user login (data dirisendiri)         -->
                                    <a
                                      class="btn btn-outline-light btn-table"
                                      type="button"
                                      href="myProfile.php"
                                    >
                                      <ion-icon
                                        class="btn-icon"
                                        name="create-sharp"
                                      ></ion-icon>
                                    </a>
                                  <?php } else { ?>
                                    <!-- edit profile page -->
                                    <a
                                      class="btn btn-outline-light btn-table"
                                      type="button"
                                      href="edit.php?<?php echo $url ?>page=<?php echo $page ?>&person=<?php echo $personsData[$i]["id"] ?>"
                                    >
                                      <ion-icon
                                        class="btn-icon"
                                        name="create-sharp"
                                      ></ion-icon>
                                    </a>
                                  <?php }
                                }?>
                              </div>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>

                    <!--Pagination -->
                    <div class="page">
                      <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                          <li class="page-item">

                              <?php if ($data['totalPage'] >= $_GET['page'] && $page > 1 && is_numeric($_GET['page']) != null) { ?>
                                <a class="page-link"
                                   href='?<?php echo $url ?>page=<?php echo $previous ?>'
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
                                    //                                untuk memberi warna pada halaman pertama saat membuka page
                                    if (isset($_GET['page']) == null && $i == 1) { ?>
                                      <li class="page-item active">
                                        <a class="page-link"
                                           href="?<?php echo $url ?>page=<?php echo $i ?>"> <?php echo $i ?>
                                        </a>
                                      </li>
                                      <!-- untuk memberikan warna pada halaman saat ini        -->
                                    <?php } else if ($_GET["page"] == $i) { ?>
                                      <li class="page-item active">
                                        <a class="page-link"
                                           href="?<?php echo $url ?>page=<?php echo $i ?>"> <?php echo $i ?>
                                        </a>
                                      </li>
                                      <!-- untuk memberikan warna pada halaman jika diinput "asdancasdw"      -->
                                    <?php } else if ($_GET['page'] > $data['totalPage'] && $i == 1) { ?>
                                      <li class="page-item active">
                                        <a class="page-link"
                                           href="?<?php echo $url ?>page=<?php echo $i ?>"> <?php echo $i ?>
                                        </a>
                                      </li>
                                      <!-- untuk memberikan warna pada halaman jika inputan -2              -->
                                    <?php } else if (is_numeric($_GET['page']) == true && $_GET['page'] < 1 && $i == 1) { ?>
                                      <li class="page-item active">
                                        <a class="page-link"
                                           href="?<?php echo $url ?>page=<?php echo $i ?>"> <?php echo $i ?>
                                        </a>
                                      </li>
                                      <!-- untuk membuat banyak halaman yang di perlukan -->
                                    <?php } else { ?>
                                      <li class="page-item">
                                        <a class="page-link"
                                           href="?<?php echo $url ?>page=<?php echo $i ?>"> <?php echo $i ?>
                                        </a>
                                      </li>
                                    <?php } ?>
                                <?php }
                            } ?>

                          <li class="page-item">
                              <?php if ($page < $data["totalPage"] || $_GET['page'] > $data['totalPage']) { ?>
                                <a class="page-link"
                                   href='?<?php echo $url ?>page=<?php echo $next ?>'>
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
<?php require_once "includes/footer.php";?>
