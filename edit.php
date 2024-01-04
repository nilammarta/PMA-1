<?php

require_once __DIR__ . "/action/common-action.php";
require_once "includes/header.php";
require_once "includes/sidebar.php";

session_start();
userLoginCheck($_SESSION['userEmail']);
showHeader("EDIT - Persons Management App", "create.css", "persons");
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
                      if (!is_numeric($_GET['person'])){
                          $thePerson = [];
                      }else {
                          $thePerson = getUserById($_GET['person']);
                      }
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

                        <?php if (isset($_SESSION['birthDateError'])){?>
                          <p class="error"><?php echo $_SESSION['birthDateError']; ?></p>
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
                              value="<?php if (isset($_SESSION['inputData'])){
                                  echo $_SESSION['inputData']['sex'];
                              } else {
                                  echo $thePerson['sex'];
                              } ?>"
                            >
                              <?php if (isset($_SESSION['inputData'])){
                                echo $_SESSION['inputData']['sex'] == "f" ? "Female" : "Male";
                              }else {
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
                              value="<?php if (isset($_SESSION['inputData'])){
                                  echo $_SESSION['inputData']['role'];
                                } else{
                                  echo $thePerson['role'];
                                } ?>"
                            >
                              <?php if (isset($_SESSION['inputData'])){
                                    echo $_SESSION['inputData']['role'] == "ADMIN" ? "ADMIN" : "MEMBER" ;
                                } else{
                                    echo $thePerson['role'] == "ADMIN" ? "ADMIN" : "MEMBER";
                                } ?>
                            </option>

                            <?php if (isset($_SESSION['inputData']) == true && $_SESSION['inputData']['role'] == "ADMIN"){?>
                              <option class="option-value" value="MEMBER">MEMBER</option>
                            <?php }else if ($thePerson['role'] == "ADMIN"){ ?>
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
                    Change Password
                  </h5>
                  <div class="mb-3 row">
                    <label for="exampleInputPassword1" class="col-sm-2 col-form-label form-label"
                    >Current Password </label>
                    <div class="col-sm-9 col-xl-6">
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
                    <label for="exampleInputPassword2" class="col-sm-2 col-form-label form-label"
                    >New Password </label>
                    <div class="col-sm-9 col-xl-6">
                      <input
                        type="password"
                        name="newPassword"
                        class="form-control mb-2 <?php if (isset($_SESSION['currentPasswordError']) == null && isset($_SESSION['newPasswordError'])){
                          echo "is-invalid";
                        } ?>"
                        id="exampleInputPassword2"
                        placeholder="new password"
                      />
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="exampleInputPassword3" class="col-sm-2 col-form-label form-label"
                    >Confirm Password </label>
                    <div class="col-sm-9 col-xl-6">
                      <input
                        type="password"
                        name="confirmPassword"
                        class="form-control mb-2 <?php if (isset($_SESSION['currentPasswordError']) == null && isset($_SESSION['newPasswordError'])){
                          echo "is-invalid";
                        } ?>"
                        id="exampleInputPassword3"
                        placeholder="confirm password"
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

<?php
unset($_SESSION['nikError']);
unset($_SESSION['emailError']);
unset($_SESSION['passwordError']);
unset($_SESSION['inputData']);
unset($_SESSION['currentPasswordError']);
unset($_SESSION['newPasswordError']);
unset($_SESSION['birthDateError']);
require_once "includes/footer.php";
?>
