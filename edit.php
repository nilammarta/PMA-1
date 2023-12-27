<?php
session_start();

if (!isset($_SESSION['userEmail'])) {
    header("Location: login-action.php");
    exit();
}

require_once __DIR__ . "/action/common-action.php";
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

    <title>EDIT - Person Management App</title>
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
          <div class="create m-3 m-md-4">
            <div class="content-title">
              <h2 class="heading-2 m-0 p-3">EDIT PERSON</h2>
            </div>

            <div class="row justify-content-center">
              <!-- <div class="col-12 col-md-10 col-lg-11 col-xxl-6"> -->
              <div class="col-12">
                  <?php if (isset($_GET['person'])) {
                      $_SESSION['personId'] = $_GET['person'];
                      $_SESSION['page'] = $_GET['page'];
                      $_SESSION['filter'] = $_GET['filter'];
                      $_SESSION['search'] = $_GET['search'];
                      $thePerson = getUserById($_GET['person']);
                  } ?>

                <form name="editPerson" class="create-form needs-validation p-4 mb-5" method="post"
                      action="action/edit-action.php">
                  <h5 class="form-text pb-2 mb-4">
                    Edit person data in the form below:
                  </h5>
                  <div class="d-lg-flex gap-lg-3 gap-xl-5">
                    <div class="form-1">
                      <div class="mb-3">
                        <label for="FirstnameInput" class="form-label"
                        >First name &#42;</label>

                        <input
                          id="FirstnameInput"
                          name="firstName"
                          type="text"
                          class="form-control"
                          placeholder="first name"
                          value="<?php if (isset($_SESSION['inputData'])) {
                              echo $_SESSION['inputData']['firstName'];
                          } else {
                              echo $thePerson['firstName'];
                          } ?>"
                          aria-label="First name"
                          required
                        />
                      </div>

                      <div class="mb-3">
                        <label for="LastnameInput" class="form-label"
                        >Last name &#42;
                        </label>
                        <input
                          id="LastnameInput"
                          name="lastName"
                          type="text"
                          class="form-control"
                          placeholder="last name"
                          value="<?php if (isset($_SESSION['inputData'])) {
                              echo $_SESSION['inputData']['lastName'];
                          } else {
                              echo $thePerson['lastName'];
                          } ?>"
                          aria-label="Last name"
                          required
                        />
                      </div>

                      <div class="mb-3">
                        <label for="nikInput" class="form-label"
                        >NIK &#42;</label>
                        <input
                          id="nikInput"
                          name="nik"
                          type="text"
                          class="form-control mb-2 <?php if (isset($_SESSION['nikError'])) {
                              echo "is-invalid";
                          } ?>"
                          placeholder="Nomor Induk Kependudukan"
                          value="<?php if (isset($_SESSION['inputData'])) {
                              echo $_SESSION['inputData']['nik'];
                          } else {
                              echo $thePerson['nik'];
                          } ?>"
                          aria-label="NIK"
                          maxlength="16"
                          required
                        />

                        <?php if (isset($_GET['saved']) == null) { ?>
                          <p class="error"><?php echo $_SESSION['nikError']; ?></p>
                        <?php } ?>
                      </div>

                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label"
                        >Email &#42;</label>
                        <input
                          type="email"
                          name="email"
                          class="form-control mb-2 <?php if (isset($_SESSION['emailError'])) {
                              echo "is-invalid";
                          } ?>"
                          id="exampleInputEmail1"
                          aria-describedby="emailHelp"
                          placeholder="name@example.com"
                          value="<?php if (isset($_SESSION['inputData'])){
                            echo $_SESSION['inputData']['email'];
                          } else {
                            echo $thePerson['email'];
                          }?>"
                          required
                        />

                        <?php if (isset($_GET['saved']) == null) { ?>
                          <p class="error"><?php echo $_SESSION['emailError']; ?></p>
                        <?php } ?>
                      </div>

<!--                      <div class="mb-3">-->
<!--                        <label for="exampleInputPassword1" class="form-label"-->
<!--                        >Password &#42;</label>-->
<!--                        <input-->
<!--                          type="password"-->
<!--                          name="password"-->
<!--                          class="form-control mb-2 --><?php //if (isset($_SESSION['passwordError'])) {
//                              echo "is-invalid";
//                          } ?><!--"-->
<!--                          id="exampleInputPassword1"-->
<!--                          placeholder="password"-->
<!--                          value="--><?php //if (isset($_SESSION['inputData'])){
//                            echo $_SESSION['inputData']['password'];
//                          } else {
//                            echo $thePerson['password'];
//                          } ?><!--"-->
<!--                          required-->
<!--                        />-->
<!---->
<!--                          --><?php //if (isset($_GET['saved']) == null) { ?>
<!--                            <p class="error">--><?php //echo $_SESSION['passwordError']; ?><!--</p>-->
<!--                          --><?php //} ?>
<!--                      </div>-->

                      <div class="mb-3">
                        <label for="birthDateInput" class="form-label">
                          Birth date &#42;
                        </label>

                        <input
                          id="birthDateInput"
                          name="birthDate"
                          type="date"
                          class="form-control"
                          value="<?php if (isset($_SESSION['inputData'])){
                            echo $_SESSION['inputData']['birthDate'];
                          } else if ($thePerson != null){
                            echo date('Y-m-d', $thePerson['birthDate']);
                          } ?>"
                          required
                        />
                      </div>
                    </div>
                    <div class="form-2">
                      <div class="mb-3">
                        <label for="exampleSexInput" class="form-label"
                        >Sex &#42;
                        </label>
                        <select
                          id="exampleSexInput"
                          name="sex"
                          class="form-select"
                          aria-label="Default select example"
                          required
                        >
                            <option selected
                              value="<?php if (isset($_SESSION['inputData'])){
                                  echo $_SESSION['inputData']['sex'];
                              } else {
                                  echo $thePerson['sex'];
                              } ?>"
                            >
                              <?php if (isset($_SESSION['inputData'])){
                                echo $_SESSION['inputData']['sex'] == "f" ? "Female" : "Male";
                              } else {
                                echo $thePerson['sex'] == "f" ? "Female" : "Male" ;
                              } ?>
                            </option>
                            <?php if (isset($_SESSION['inputData']) == true && $_SESSION['inputData']['sex'] == "f") { ?>
                              <option class="option-value" value="m">Male</option>
                            <?php }else if($thePerson['sex'] == "f"){?>
                              <option class="option-value" value="m">Male</option>
                            <?php } else { ?>
                              <option class="option-value" value="f">Female</option>
                            <?php } ?>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label for="addressInput" class="form-label"> Address &#42; </label>
                        <input
                          id="addressInput"
                          name="address"
                          type="text"
                          class="form-control"
                          placeholder="address"
                          value="<?php if (isset($_SESSION['inputData'])){
                            echo $_SESSION['inputData']['address'];
                          } else{
                            echo $thePerson['address'];
                          } ?>"

                          aria-label="Last name"
                          required
                        />
                      </div>

                      <div class="mb-3">
                        <label
                          for="exampleFormControlTextarea1"
                          class="form-label"
                        >Internal notes</label>
                        <textarea
                          name="internalNotes"
                          class="form-control"
                          id="exampleFormControlTextarea1"
                          rows="3"
                        ><?php if (isset($_SESSION['inputData'])){
                          echo $_SESSION['inputData']['internalNotes'];
                        } else{
                          echo $thePerson['internalNotes'];
                        } ?></textarea>
                      </div>

<!--                      <div class="mb-3">-->
<!--                        <label for="exampleRoleInput" class="form-label"-->
<!--                        >Role &#42;</label>-->
<!--                        <select-->
<!--                          id="exampleRoleInput"-->
<!--                          name="role"-->
<!--                          class="form-select"-->
<!--                          aria-label="Default select example"-->
<!--                        >-->
<!--                            <option-->
<!--                              selected-->
<!--                              value="--><?php //if (isset($_SESSION['inputData'])){
//                                echo $_SESSION['inputData']['role'];
//                              } else{
//                                echo $thePerson['role'];
//                              } ?><!--"-->
<!--                            >-->
<!--                              --><?php //if (isset($_SESSION['inputData'])){
//                                  echo $_SESSION['inputData']['role'] == "ADMIN" ? "ADMIN" : "MEMBER" ;
//                              } else{
//                                  echo $thePerson['role'] == "ADMIN" ? "ADMIN" : "MEMBER";
//                              } ?>
<!--                            </option>-->
<!---->
<!--                            --><?php //if (isset($_SESSION['inputData']) == true && $_SESSION['inputData']['role'] == "ADMIN"){?>
<!--                              <option class="option-value" value="MEMBER">MEMBER</option>-->
<!--                            --><?php //}else if ($thePerson['role'] == "ADMIN"){ ?>
<!--                              <option class="option-value" value="MEMBER">MEMBER</option>-->
<!--                            --><?php //} else { ?>
<!--                              <option class="option-value" value="ADMIN">ADMIN</option>-->
<!--                            --><?php //} ?>
<!--                        </select>-->
<!--                      </div>-->

                      <div
                        class="form-check form-switch mb-5 d-flex flex-row align-items-end gap-3"
                      >
                        <input
                          class="form-check-input"
                          type="checkbox"
                          role="switch"
                          name="alive"
                          id="flexSwitchCheckChecked"
                          <?php if(isset($_SESSION['inputData']) == true && $_SESSION['inputData']['alive'] == true){
                            echo 'checked';
                          } else if ($thePerson['alive'] == true) {
                            echo "checked";
                          } ?>
                        />
                        <label
                          class="form-check-label"
                          for="flexSwitchCheckChecked"
                        >This person is alive</label>
                      </div>
                    </div>
                  </div>

<!--               change password   -->
                  <h5 class="form-text pb-2 mb-3 mt-5">
                    Edit Password
                  </h5>
                  <div class="mb-3 row">
                    <label for="exampleInputPassword1" class="col-sm-3 col-form-label form-label"
                    >Current Password </label>
                    <div class="col-sm-9 col-xl-7">
                      <input
                        type="password"
                        name="currentPassword"
                        class="form-control mb-2 <?php if (isset($_SESSION['currentPasswordError'])) {
                            echo "is-invalid";
                        } ?>"
                        id="exampleInputPassword1"
                        placeholder="current password"
                      />

                      <?php if (isset($_SESSION['currentPasswordError'])){ ?>
                        <p class="error"> <?php echo $_SESSION['currentPasswordError']; ?></p>
                      <?php }?>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label form-label"
                    >New Password </label>
                    <div class="col-sm-9 col-xl-7">
                      <input
                        type="password"
                        name="newPassword"
                        class="form-control mb-2 <?php if (isset($_SESSION['newPasswordError'])){
                          echo "is-invalid";
                        } ?>"
                        id="exampleInputPassword2"
                        placeholder="new password"
                        required
                      />

                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="exampleInputPassword3" class="col-sm-3 col-form-label form-label"
                    >Confirm Password </label>
                    <div class="col-sm-9 col-xl-7">
                      <input
                        type="password"
                        name="confirmPassword"
                        class="form-control mb-2 <?php if (isset($_SESSION[''])){
                          echo "is-invalid";
                        } ?>"
                        id="exampleInputPassword3"
                        placeholder="confirm password"
                        required
                      />
                      <?php if (isset($_SESSION['currentPasswordError']) == null && isset($_SESSION['newPasswordError'])) { ?>
                        <p class="error mt-3"> <?php echo $_SESSION['newPasswordError']; ?></p>
                      <?php }?>
                    </div>
                  </div>

<!--              bagian button untuk save dan cancel    -->
                  <div class="row justify-content-center mt-1">
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
                        <a
                          type="reset"
                          role="button"
                          class="btn btn-secondary btn-cancel"
                          href="persons.php?<?php echo $url?>page=<?php echo $_SESSION['page']?>"
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
    unset($_SESSION['passwordError']);
    unset($_SESSION['inputData']);
    unset($_SESSION['currentPasswordError']);
    unset($_SESSION['newPasswordError']);
//    unset($_SESSION['confirmPasswordError']);
    ?>

  </body>
</html>
