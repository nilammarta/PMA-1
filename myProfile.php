<?php
include("action/common-action.php");

session_start();
userLoginCheck($_SESSION['userEmail']);

//if (!isset($_SESSION['userEmail'])) {
//    header("Location: login-action.php");
//    exit();
//}

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

    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
    />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

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
    <link href="assets/query/query.css" rel="stylesheet"/>
    <link href="assets/css/create.css" rel="stylesheet"/>

    <title>MY PROFIL - Person Management App</title>
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
                      <li class="nav-item">
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
                        <li class="nav-item nav-open">
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
                  <a class="main-nav-link" href="dashboard.php">
                    <ion-icon
                      name="file-tray-full-outline"
                      class="nav-icon"
                    ></ion-icon>
                    Dashboard
                  </a>
                </li>
                <li class="nav-item">
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
                  <li class="nav-item nav-open">
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
          <div class="profile m-3 m-md-4">
            <div class="content-title">
              <h2 class="heading-2 m-0 p-3">MY PROFILE</h2>
            </div>

            <div class="row justify-content-center">
              <div class="col-12 col-md-10 col-lg-11 col-xxl-7">

                  <?php
                    $user = userLogin($_SESSION['userEmail']);
                    $_SESSION['personId'] = $user['id'];
                    if (isset($_GET['page']) == null){
                      $page = "1";
                    }else{
                      $page = $_GET['page'];
                    }
                    $_SESSION['page'] = $page;
                    $_SESSION['filter'] = $_GET['filter'];
                    $_SESSION['search'] = $_GET['search'];

                  ?>

                  <?php if (isset($_GET['saved'])){?>
                    <div class="alert alert-success saved mt-4" role="alert">
                      Your Profile has been updated!
                    </div>
                  <?php }?>

                <form name="editProfile" class="create-form needs-validation p-4 mb-5" method="post" action="action/myProfile-action.php">
                  <h5 class="form-text pb-2 mb-4">EDIT PROFILE</h5>
                  <div class="mb-3 row">
                    <label
                      for="inputFirstname"
                      class="col-sm-2 col-form-label form-label"
                    >Fist name</label>
                    <div class="col-sm-10">
                      <input
                        name="firstName"
                        type="text"
                        class="form-control"
                        id="inputFirstname"
                        value="<?php if (isset($_SESSION['inputData'])){
                          echo $_SESSION['inputData']['firstName'];
                        }else {
                          echo $user["firstName"];
                        }?>"
                      />
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label
                      for="inputLastname"
                      class="col-sm-2 col-form-label form-label"
                    >Last name</label
                    >
                    <div class="col-sm-10">
                      <input
                        name="lastName"
                        type="text"
                        class="form-control"
                        id="inputLastname"
                        value="<?php if (isset($_SESSION['inputData'])){
                          echo $_SESSION['inputData']['lastName'];
                        }else {
                          echo $user['lastName'];
                        } ?>"
                      />
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label
                      for="inputNIK"
                      class="col-sm-2 col-form-label form-label"
                    >NIK</label>
                    <div class="col-sm-10">
                      <input
                        name="nik"
                        type="number"
                        class="form-control mb-2 <?php if (isset($_SESSION['nikError'])){
                          echo "is-invalid";
                        } ?>"
                        id="inputNIK"
                        value="<?php if (isset($_SESSION['inputData'])){
                          echo $_SESSION['inputData']['nik'];
                        }else {
                          echo $user['nik'];
                        }?>"
                      />

                      <?php if (isset($_SESSION['nikError'])){ ?>
                        <p class="error"> <?php echo $_SESSION['nikError'] ?></p>
                      <?php }?>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label
                      for="inputEmail"
                      class="col-sm-2 col-form-label form-label"
                    >Email</label>
                    <div class="col-sm-10">
                      <input
                        name="email"
                        type="email"
                        class="form-control mb-2 <?php if (isset($_SESSION['emailError'])){
                          echo "is-invalid";
                        } ?>"
                        id="inputEmail"
                        value="<?php if (isset($_SESSION['inputData'])){
                          echo $_SESSION['inputData']['email'];
                        }else {
                          echo $user['email'];
                        }?>"
                      />

                      <?php if (isset($_SESSION['emailError'])){ ?>
                        <p class="error"><?php echo $_SESSION['emailError']; ?></p>
                      <?php } ?>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label
                      for="inputBirthdate"
                      class="col-sm-2 col-form-label form-label"
                    >Birth date</label>

                    <div class="col-sm-10">
                      <input
                        name="birthDate"
                        type="date"
                        class="form-control"
                        id="inputBirthdate"
                        value="<?php if ($_SESSION['inputData']){
                          echo $_SESSION['inputData']['birthDate'];
                        }else {
                          echo date('Y-m-d', $user['birthDate']);
                        }?>"
                      />

                      <?php if (isset($_SESSION['birthDateError'])){ ?>
                        <p class="error"><?php echo $_SESSION['birthDateError']; ?></p>
                      <?php } ?>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label
                      for="inputAddress"
                      class="col-sm-2 col-form-label form-label"
                    >Address</label>

                    <div class="col-sm-10">
                      <input
                        name="address"
                        type="text"
                        class="form-control"
                        id="inputAddress"
                        value="<?php if (isset($_SESSION['inputData'])){
                          echo $_SESSION['inputData']['address'];
                        } else {
                          echo $user['address'];
                        }?>"
                      />
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label
                      for="inputSex"
                      class="col-sm-2 col-form-label form-label"
                    >Sex</label>
                    <div class="col-sm-10">
                      <select
                        name="sex"
                        id="inputSex"
                        class="form-select"
                        aria-label="Default select example"
                        required
                      >
                        <option
                          selected
                          value="<?php if (isset($_SESSION['inputData'])){
                            echo $_SESSION['inputData']['sex'];
                          }else{
                            echo $user['sex'];
                          }?>"
                        >
                          <?php if (isset($_SESSION['inputData'])){
                            echo gender($_SESSION['inputData']['sex']);
                          }else{
                            echo gender($user['sex']);
                          } ?>
                        </option>
                        <?php if (isset($_SESSION['inputData']) == true && $_SESSION['inputData']['sex'] == "f"){ ?>
                          <option class="option-value" value="m">Male</option>
                        <?php }else if ($user['sex'] == "f") {?>
                          <option class="option-value" value="m">Male</option>
                        <?php }else { ?>
                          <option class="option-value" value="f">Female</option>
                        <?php }?>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Internal notes</label>
                    <textarea
                      name="internalNotes"
                      class="form-control"
                      id="exampleFormControlTextarea1"
                      rows="3"
                    ><?php if (isset($_SESSION['inputData'])){
                      echo $_SESSION['inputDate']['internalNotes'];
                    }else {
                        echo $user['internalNotes'];
                    }?></textarea>
                  </div>

<!--               change password       -->
                  <h5 class="form-text pb-2 mb-3 mt-5">Change Password</h5>
                  <div class="mb-3 row">
                    <label
                      for="inputCurrentPassword"
                      class="col-sm-3 col-form-label form-label"
                    >Current Password</label>

                    <div class="col-sm-9">
                      <input
                        name="currentPassword"
                        type="password"
                        class="form-control mb-2 <?php if (isset($_SESSION['currentPasswordError'])) {
                          echo "is-invalid";
                        }?>"
                        id="inputCurrentPassword"
                        placeholder="current password"
                      />

                      <?php if ($_SESSION['currentPasswordError']){ ?>
                        <p class="error"><?php echo $_SESSION['currentPasswordError']; ?></p>
                      <?php }?>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label
                      for="inputNewPassword"
                      class="col-sm-3 col-form-label form-label"
                    >New Password</label>

                    <div class="col-sm-9">
                      <input
                        name="newPassword"
                        type="password"
                        class="form-control mb-2 <?php if (isset($_SESSION['currentPasswordError']) == null && isset($_SESSION['newPasswordError'])){
                          echo "is-invalid";
                        } ?>"
                        id="inputNewPassword"
                        placeholder="new password"
                      />
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label
                      for="inputConfirmPassword"
                      class="col-sm-3 col-form-label form-label"
                    >Confirm Password</label>

                    <div class="col-sm-9">
                      <input
                        name="confirmPassword"
                        type="password"
                        class="form-control mb-2 <?php if (isset($_SESSION['currentPasswordError']) == null && isset($_SESSION['newPasswordError'])) {
                          echo "is-invalid";
                        }?>"
                        id="inputConfirmPassword"
                        placeholder="confirm password"
                      />

                      <?php if (isset($_SESSION['currentPasswordError']) == null && isset($_SESSION['newPasswordError'])){ ?>
                        <p class="error mt-3"><?php echo $_SESSION['newPasswordError']; ?></p>
                      <?php }?>
                    </div>
                  </div>

<!--              button untuk menyimpan dan membatalakan    -->
                  <div class="row justify-content-center mt-5">
                    <div class="col-12">
                      <div class="btn-create">
                        <button
                          type="submit"
                          class="btn btn-primary btn-save me-3"
                        >
                          Save
                        </button>

                        <?php if (isset($_SESSION['search']) != null && isset($_SESSION['filter']) != null) {
                            $url = "search=" . $_SESSION['search'] . "&filter=" . $_SESSION['filter'] . "&";
                        }else{
                            $url = "";
                        }?>

                        <?php if ($_GET['page'] == null && $_SESSION['page'] == null) {
                          $page = "1";
                        }else{
                          $page = $_SESSION['page'];
                        }?>
                        <a
                          type="reset"
                          role="button"
                          class="btn btn-secondary btn-cancel"
                          href="persons.php?<?php echo $url?>page=<?php echo $page?>"
                        >
                          Cancel
                        </a>
                      </div>
                    </div>
                  </div>
                </form>
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

    <?php
    unset($_SESSION['nikError']);
    unset($_SESSION['emailError']);
    unset($_SESSION['inputData']);
    unset($_SESSION['currentPasswordError']);
    unset($_SESSION['newPasswordError']);
    unset($_SESSION['birthDateError']);
    ?>
  </body>
</html>
