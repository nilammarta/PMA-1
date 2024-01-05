<?php
include("action/common-action.php");
require_once "includes/html-head.php";
require_once "includes/header.php";
require_once "includes/sidebar.php";

session_start();
checkUserLogin($_SESSION['userEmail']);

addHeadCode("create.css", "MY PROFILE - Persons Management App");

showHeader("profile");
?>
    <main>
      <section class="main-section d-flex flex-row">
        <?php showSidebar("profile"); ?>

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
                    <div class="alert alert-success saved mb-4" role="alert">
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
                        id="inputNIK"
                        type="text"
                        class="form-control mb-2 <?php if (isset($_SESSION['errorData']['nik'])){
                          echo "is-invalid";
                        } ?>"
                        value="<?php if (isset($_SESSION['inputData'])){
                          echo $_SESSION['inputData']['nik'];
                        }else {
                          echo $user['nik'];
                        }?>"
                        aria-label="NIK"
                        maxlength="16"
                        required
                      />

                      <?php if (isset($_SESSION['errorData']['nik'])){ ?>
                        <p class="error"> <?php echo $_SESSION['errorData']['nik']; ?></p>
                      <?php } ?>
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
                        class="form-control mb-2 <?php if (isset($_SESSION['errorData']['email'])){
                          echo "is-invalid";
                        } ?>"
                        id="inputEmail"
                        value="<?php if (isset($_SESSION['inputData'])){
                          echo $_SESSION['inputData']['email'];
                        }else {
                          echo $user['email'];
                        }?>"
                      />

                      <?php if (isset($_SESSION['errorData']['email'])){ ?>
                        <p class="error"><?php echo $_SESSION['errorData']['email']; ?></p>
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
                        class="form-control mb-2 <?php if (isset($_SESSION['errorData']['birthDate'])){
                          echo "is-invalid";
                        }?>"
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
                        <?php } ?>
                      </select>
                    </div>
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
                        class="form-control mb-2 <?php if (isset($_SESSION['errorPassword']['currentPass'])) {
                          echo "is-invalid";
                        }?>"
                        id="inputCurrentPassword"
                        placeholder="current password"
                      />

                      <?php if ($_SESSION['errorPassword']['currentPass']){ ?>
                        <p class="error"><?php echo $_SESSION['errorPassword']['currentPass']; ?></p>
                      <?php } ?>
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
                        class="form-control mb-2 <?php if (isset($_SESSION['errorPassword']['newPass']) == null && isset($_SESSION['errorData']['newPass'])){
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

                      <?php if (isset($_SESSION['errorPassword']['newPass']) == null && isset($_SESSION['errorPassword']['newPass'])){ ?>
                        <p class="error mt-3"><?php echo $_SESSION['errorPassword']['newPass']; ?></p>
                      <?php } ?>
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
  <?php
    unset($_SESSION['inputData']);
    unset($_SESSION['errorData']);
    unset($_SESSION['errorPassword']);
    require_once "includes/footer.php";
  ?>
