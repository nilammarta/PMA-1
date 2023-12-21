<?php
session_start();

if (!isset($_SESSION['userEmail'])) {
    header("Location: action/login-action.php");
    exit();
}
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

    <title>CREATE - Person Management App</title>
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
                          Persons</a>
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
              <h2 class="heading-2 m-0 p-3">ADD PERSON</h2>
            </div>

            <div class="row justify-content-center">
              <!-- <div class="col-12 col-md-10 col-lg-11 col-xxl-6"> -->
              <div class="col-12">
                <div class="create-form p-4 mb-5">
                  <h5 class="form-text pb-2 mb-4">
                    Add new person data in the form below:
                  </h5>

                  <form name="newPerson" class="needs-validation" method="post" action="action/create-action.php">
                    <div class="d-lg-flex gap-lg-3 gap-xl-5">
                      <div class="form-1">
                        <div class="mb-3">
                          <label for="FirstnameInput" class="form-label"
                          >First name &#42;</label>
                          <input
                            name="firstName"
                            id="FirstnameInput"
                            type="text"
                            class="form-control"
                            placeholder="first name"
                            aria-label="First name"
                            value="<?php if (isset($_SESSION['dataInput'])) {
                              echo $_SESSION['dataInput']['firstName'];
                            }?>"
                            required
                          />

                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>

                        <div class="mb-3">
                          <label for="LastnameInput" class="form-label"
                          >Last name &#42;
                          </label>
                          <input
                            name="lastName"
                            id="LastnameInput"
                            type="text"
                            class="form-control"
                            placeholder="last name"
                            aria-label="Last name"
                            value="<?php if (isset($_SESSION['dataInput'])){
                              echo $_SESSION['dataInput']['lastName'];
                            } ?>"
                            required
                          />
                          <div class="invalid-feedback">
                            Please type the correct NIK, at least 16 characters
                          </div>
                        </div>

                        <div class="mb-3">
                          <label for="nikInput" class="form-label"
                          >NIK &#42;</label
                          >
                          <input
                            name="nik"
                            id="nikInput"
                            type="text"
                            class="form-control mb-2 <?php if (isset($_SESSION['nikError'])) { ?>
                              is-invalid
                            <?php } ?>"
                            placeholder="Nomor Induk Kependudukan"
                            aria-label="NIK"
                            maxlength="16"
                            value="<?php if (isset($_SESSION['dataInput'])) {
                              echo $_SESSION['dataInput']['nik'];
                            }?>"
                            required
                          />
                          <?php if (isset($_GET['saved']) == null) {?>
                            <p class="error"> <?php echo $_SESSION['nikError'];?> </p>
                          <?php } ?>
                        </div>

                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label"
                          >Email &#42;</label
                          >
                          <input
                            name="email"
                            type="email"
                            class="form-control mb-2 <?php if (isset($_SESSION['emailError'])) { ?>
                              is-invalid
                            <?php } ?>"
                            id="exampleInputEmail1"
                            aria-describedby="emailHelp"
                            placeholder="name@example.com"
                            value="<?php
                              echo $_SESSION['dataInput']['email'];
                            ?>"
                            required
                          />
                            <?php if (isset($_GET['saved']) == null){?>
                              <p class="error"> <?php echo $_SESSION['emailError']; ?> </p>
                            <?php } ?>
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">
                            Password &#42;</label>
                          <input
                            name="password"
                            type="password"
                            class="form-control mb-2 <?php if (isset($_SESSION['passwordError'])) { ?>
                              is-invalid
                            <?php } ?>"
                            id="exampleInputPassword1"
                            placeholder="password"
                            value="<?php if (isset($_SESSION['dataInput'])) {
                              echo $_SESSION['dataInput']['password'];
                            } ?>"
                            required
                          />
                          <?php if (isset($_GET['saved']) == null){ ?>
                            <p class="error"><?php echo $_SESSION['passwordError']; ?></p>
                          <?php } ?>
                        </div>

                        <div class="mb-3">
                          <label for="birthDateInput" class="form-label">
                            Birth date &#42;
                          </label>

                          <input
                            name="birthDate"
                            id="birthDateInput"
                            type="date"
                            class="form-control"
                            value="<?php if (isset($_SESSION['dataInput'])) {
                              echo $_SESSION['dataInput']['birthDate'];
                            }?>"
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
                            name="sex"
                            id="exampleSexInput"
                            class="form-select"
                            aria-label="Default select example"
                            required
                          >
                            <?php if (isset($_SESSION['dataInput'])){ ?>
                              <option selected value="<?php echo $_SESSION['dataInput']['sex'];?>">
                                  <?php if ($_SESSION['dataInput']['sex'] == "f"){
                                echo "Female";
                                }else{
                                echo "Male";
                                }?>
                              </option>
                              <?php if ($_SESSION['dataInput']['sex'] == "f"){ ?>
                                <option class="option-value" value="m">Male</option>
                              <?php }else{ ?>
                                <option class="option-value" value="f">Female</option>
                              <?php } ?>
                            <?php }else{ ?>
                              <option selected disabled value="">choose...</option>
                              <option class="option-value" value="m">Male</option>
                              <option class="option-value" value="f">Female</option>
                            <?php } ?>
                          </select>
                        </div>

                        <div class="mb-3">
                          <label for="addressInput" class="form-label"
                          >Address &#42;
                          </label>
                          <input
                            name="address"
                            id="addressInput"
                            type="text"
                            class="form-control"
                            placeholder="address"
                            aria-label="Last name"
                            value="<?php if (isset($_SESSION['dataInput'])){
                              echo $_SESSION['dataInput']['address'];
                            } ?>"
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
                          ><?php if (isset($_SESSION['dataInput'])){
                            echo $_SESSION['dataInput']['internalNotes'];
                              } ?></textarea>
                        </div>

                        <div class="mb-3">
                          <label for="exampleRoleInput" class="form-label"
                          >Role &#42;</label>
                          <select
                            name="role"
                            id="exampleRoleInput"
                            class="form-select"
                            aria-label="Default select example"
                            required
                          >
                            <?php if (isset($_SESSION['dataInput'])){ ?>
                                <option selected value="<?php echo $_SESSION['dataInput']['role']?>"><?php if ($_SESSION['dataInput']['role'] == 'ADMIN'){
                                  echo "ADMIN";
                                }else{
                                  echo 'MEMBER';
                                }?>
                                </option>

                                <?php if ($_SESSION['dataInput']['role'] == "ADMIN") {?>
                                  <option class="option-value" value="MEMBER">MEMBER</option>
                                <?php }else { ?>
                                  <option class="option-value" value="ADMIN">ADMIN</option>
                                <?php } ?>
                            <?php }else{ ?>
                              <option selected disabled value="">choose...</option>
                              <option class="option-value" value="ADMIN">ADMIN</option>
                              <option class="option-value" value="MEMBER">MEMBER</option>
                            <?php } ?>
                          </select>
                          <div class="invalid-feedback">
                            Please select a valid state.
                          </div>
                        </div>

                        <div
                          class="form-check form-switch mb-5 d-flex flex-row align-items-end gap-3"
                        >
                          <input
                            name="alive"
                            class="form-check-input"
                            type="checkbox"
                            role="switch"
                            id="flexSwitchCheckChecked"
                            <?php if ($_SESSION['dataInput'] == null || isset($_SESSION['dataInput']) == true && $_SESSION['dataInput']['alive'] == true) {
                              echo "checked";
                            }?>
                          />
                          <label
                            class="form-check-label"
                            for="flexSwitchCheckChecked"
                          >This person is alive</label>
                        </div>
                      </div>
                    </div>

                    <?php if (isset($_GET['saved'])){?>
                      <div class="alert alert-success saved mt-4" role="alert">
                          Person Data has been saved!
                      </div>
                    <?php } ?>

                    <div class="row justify-content-center mt-1">
                      <div class="col-12">
                        <div class="btn-create">
                          <button
                            type="submit"
                            class="btn btn-primary btn-save me-3"
                          >
                            Save
                          </button>

                          <a
                            type="reset"
                            class="btn btn-secondary btn-cancel"
                            role="button"
                            href="persons.php"
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
    unset($_SESSION['passwordError']);
    unset($_SESSION['emailError']);
    unset($_SESSION['dataInput']);
    ?>
  </body>
</html>
