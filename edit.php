<?php

require_once __DIR__ . "/action/common-action.php";
require_once "includes/html-head.php";
require_once "includes/header.php";
require_once "includes/sidebar.php";

session_start();
checkUserLogin($_SESSION['userEmail']);
checkUserLoginRole($_SESSION['userRole']);

addHeadCode("create.css", "EDIT - Persons Management App");
showHeader("persons");
?>
<main>
  <section class="main-section d-flex flex-row">
      <?php showSidebar("persons"); ?>

    <div class="main-content">
      <div class="create m-3 m-md-4">
        <div class="content-title">
          <h2 class="heading-2 m-0 p-3">EDIT PERSON</h2>
        </div>
        <div class="row justify-content-center">
          <!-- <div class="col-12 col-md-10 col-lg-11 col-xxl-6"> -->
          <div class="col-12 col-md-10 col-lg-12">
              <?php if (isset($_GET['person'])) {
                  $_SESSION['personId'] = $_GET['person'];
                  $_SESSION['page'] = $_GET['page'];
                  $_SESSION['filter'] = $_GET['filter'];
                  $_SESSION['search'] = $_GET['search'];
                  if (!is_numeric($_GET['person'])) {
                      $thePerson = [];
                  } else {
                      $thePerson = getUserById($_GET['person']);
                  }

                  if (isset($_SESSION['errorData']) || isset($_SESSION['errorPassword'])) {
                      $error = [];
                      if (isset($_SESSION['errorData']['nik'])) {
                          $error[] = $_SESSION['errorData']['nik'];
                      }
                      if (isset($_SESSION['errorData']['email'])) {
                          $error[] = $_SESSION['errorData']['email'];
                      }
                      if (isset($_SESSION['errorData']['birthDate'])) {
                          $error[] = $_SESSION['errorData']['birthDate'];
                      }
                      if (isset($_SESSION['errorPassword']['currentPass'])) {
                          $error[] = $_SESSION['errorPassword']['currentPass'];
                      }
                      if (isset($_SESSION['errorPassword']['newPass'])) {
                          $error[] = $_SESSION['errorPassword']['newPass'];
                      } ?>

                    <div class="alert alert-danger error-banner">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                           class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889
                        0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0
                        0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                      </svg>
                      Error while submit the form: <br>
                        <?php
                        for ($i = 0; $i < count($error); $i++) {
                            echo "- " . $error[$i] . "<br>";
                        }
                        ?>
                    </div>
                  <?php }
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
                      class="form-control mb-2 <?php if (isset($_SESSION['errorData']['nik'])) {
                          echo "is-invalid";
                      } ?>"
                      value="<?php if (isset($_SESSION['inputData'])) {
                          echo $_SESSION['inputData']['nik'];
                      } else {
                          echo $thePerson['nik'];
                      } ?>"
                      aria-label="NIK"
                      maxlength="16"
                      required
                    />

                      <?php if (isset($_SESSION['errorData']['nik'])) { ?>
                        <p class="error"><?php echo $_SESSION['errorData']['nik']; ?></p>
                      <?php } ?>
                  </div>

                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"
                    >Email &#42;</label>
                    <input
                      type="email"
                      name="email"
                      class="form-control mb-2 <?php if (isset($_SESSION['errorData']['email'])) {
                          echo "is-invalid";
                      } ?>"
                      id="exampleInputEmail1"
                      aria-describedby="emailHelp"
                      placeholder="name@example.com"
                      value="<?php if (isset($_SESSION['inputData'])) {
                          echo $_SESSION['inputData']['email'];
                      } else {
                          echo $thePerson['email'];
                      } ?>"
                      required
                    />

                      <?php if (isset($_SESSION['errorData']['email'])) { ?>
                        <p class="error"><?php echo $_SESSION['errorData']['email']; ?></p>
                      <?php } ?>
                  </div>

                  <div class="mb-3">
                    <label for="birthDateInput" class="form-label">
                      Birth date &#42;
                    </label>

                    <input
                      id="birthDateInput"
                      name="birthDate"
                      type="date"
                      class="form-control mb-2 <?php if (isset($_SESSION['errorData']['birthaDate'])) {
                          echo "is-invalid";
                      } ?>"
                      value="<?php if (isset($_SESSION['inputData'])) {
                          echo $_SESSION['inputData']['birthDate'];
                      } else if ($thePerson != null) {
                          echo date('Y-m-d', $thePerson['birthDate']);
                      } ?>"
                      required
                    />

                      <?php if (isset($_SESSION['errorData']['birthDate'])) { ?>
                        <p class="error"><?php echo $_SESSION['errorData']['birthDate']; ?></p>
                      <?php } ?>
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
                        value="<?php if (isset($_SESSION['inputData'])) {
                            echo $_SESSION['inputData']['sex'];
                        } else {
                            echo $thePerson['sex'];
                        } ?>"
                      >
                        <?php if (isset($_SESSION['inputData'])) {
                            echo $_SESSION['inputData']['sex'] == "f" ? "Female" : "Male";
                        } else {
                            echo $thePerson['sex'] == "f" ? "Female" : "Male";
                        } ?>
                      </option>
                        <?php if (isset($_SESSION['inputData']) == true && $_SESSION['inputData']['sex'] == "f") { ?>
                          <option class="option-value" value="m">Male</option>
                        <?php } else if ($thePerson['sex'] == "f") { ?>
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
                      value="<?php if (isset($_SESSION['inputData'])) {
                          echo $_SESSION['inputData']['address'];
                      } else {
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
                    ><?php if (isset($_SESSION['inputData'])) {
                            echo $_SESSION['inputData']['internalNotes'];
                        } else {
                            echo $thePerson['internalNotes'];
                        } ?></textarea>
                  </div>

                  <div class="mb-3">
                    <label for="exampleRoleInput" class="form-label"
                    >Role &#42;</label>
                    <select
                      id="exampleRoleInput"
                      name="role"
                      class="form-select"
                      aria-label="Default select example"
                    >
                      <option
                        selected
                        value="<?php if (isset($_SESSION['inputData'])) {
                            echo $_SESSION['inputData']['role'];
                        } else {
                            echo $thePerson['role'];
                        } ?>"
                      >
                        <?php if (isset($_SESSION['inputData'])) {
                            echo $_SESSION['inputData']['role'] == "ADMIN" ? "ADMIN" : "MEMBER";
                        } else {
                            echo $thePerson['role'] == "ADMIN" ? "ADMIN" : "MEMBER";
                        } ?>
                      </option>

                        <?php if (isset($_SESSION['inputData']) == true && $_SESSION['inputData']['role'] == "ADMIN") { ?>
                          <option class="option-value" value="MEMBER">MEMBER</option>
                        <?php } else if ($thePerson['role'] == "ADMIN") { ?>
                          <option class="option-value" value="MEMBER">MEMBER</option>
                        <?php } else { ?>
                          <option class="option-value" value="ADMIN">ADMIN</option>
                        <?php } ?>
                    </select>
                  </div>

                  <div
                    class="form-check form-switch mb-5 d-flex flex-row align-items-end gap-3"
                  >
                    <input
                      class="form-check-input"
                      type="checkbox"
                      role="switch"
                      name="alive"
                      id="flexSwitchCheckChecked"
                      <?php if (isset($_SESSION['inputData']) == true && $_SESSION['inputData']['alive'] == true) {
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
                Change Password
              </h5>
              <div class="mb-3 row">
                <label for="exampleInputPassword1" class="col-sm-2 col-form-label form-label"
                >Current Password </label>
                <div class="col-sm-9 col-xl-6">
                  <input
                    type="password"
                    name="currentPassword"
                    class="form-control mb-2 <?php if (isset($_SESSION['errorPassword']['currentPass'])) {
                        echo "is-invalid";
                    } ?>"
                    id="exampleInputPassword1"
                    placeholder="current password"
                  />

                    <?php if (isset($_SESSION['errorPassword'])) { ?>
                      <p class="error"> <?php echo $_SESSION['errorPassword']['currentPass']; ?></p>
                    <?php } ?>
                </div>
              </div>

<!--              <div class="mb-3 row">-->
<!--                <label for="exampleInputPassword2" class="col-sm-2 col-form-label form-label"-->
<!--                >New Password </label>-->
<!--                <div class="col-sm-9 col-xl-6">-->
<!--                  <input-->
<!--                    type="password"-->
<!--                    name="newPassword"-->
<!--                    class="form-control mb-2 --><?php //if (isset($_SESSION['errorPassword']['currentPass']) == null && isset($_SESSION['errorPassword']['newPass'])) {
//                        echo "is-invalid";
//                    } ?><!--"-->
<!--                    id="exampleInputPassword2"-->
<!--                    placeholder="new password"-->
<!--                  />-->
<!--                </div>-->
<!--              </div>-->

              <div class="mb-3 row">
                <label for="exampleInputPassword3" class="col-sm-2 col-form-label form-label"
                >Confirm Password </label>
                <div class="col-sm-9 col-xl-6">
                  <input
                    type="password"
                    name="confirmPassword"
                    class="form-control mb-2 <?php if (isset($_SESSION['errorPassword']['currentPass']) == null && isset($_SESSION['errorPassword']['newPass'])) {
                        echo "is-invalid";
                    } ?>"
                    id="exampleInputPassword3"
                    placeholder="confirm password"
                  />
                    <?php if (isset($_SESSION['errorPassword']["currentPass"]) == null && isset($_SESSION['errorPassword']['newPass'])) { ?>
                      <p class="error mt-3"> <?php echo $_SESSION['errorPassword']['newPass']; ?></p>
                    <?php } ?>
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
                      } else {
                          $url = "";
                      } ?>
                    <a
                      type="reset"
                      role="button"
                      class="btn btn-secondary btn-cancel"
                      href="persons.php?<?php echo $url ?>page=<?php echo $_SESSION['page'] ?>"
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

<?php
unset($_SESSION['errorData']);
unset($_SESSION['inputData']);
unset($_SESSION['errorPassword']);
require_once "includes/footer.php";
?>
