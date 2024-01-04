<?php
include "action/common-action.php";
require_once "includes/header.php";
require_once "includes/sidebar.php";

session_start();
userLoginCheck($_SESSION['userEmail']);

showHeader("CREATE - Persons Management App", "create.css", "persons");
?>
    <main>
      <section class="main-section d-flex flex-row">
        <?php showSidebar("persons"); ?>

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
                          >Email &#42;</label>
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
                            Password &#42;
                          </label>
                          <input
                            name="password"
                            type="password"
                            class="form-control mb-2 <?php if (isset($_SESSION['passwordError'])) {
                              echo "is-invalid";
                            } ?>"
                            id="exampleInputPassword1"
                            placeholder="password"
                            required
                          />
                        </div>

                        <div class="mb-3">
                          <label for="exampleInputPassword2" class="form-label">Confirm Password &#42;</label>
                          <input
                            name="confirmPassword"
                            type="password"
                            class="form-control mb-2 <?php if (isset($_SESSION['passwordError'])){
                              echo "is-invalid";
                            } ?>"
                            id="exampleInputPassword2"
                            placeholder="confirm password"
                            required
                          />

                          <?php if (isset($_GET['saved']) == null){ ?>
                            <p class="error"><?php echo $_SESSION['passwordError']; ?></p>
                          <?php } ?>
                        </div>
                      </div>

                      <div class="form-2">
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

                          <?php if (isset($_SESSION['birthDateError'])){ ?>
                             <p class="error"><?php echo $_SESSION['birthDateError']; ?></p>
                          <?php } ?>
                        </div>

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

                    <div class="row justify-content-center mt-1">
                      <div class="col-12">
                        <div class="btn-create">
                          <button
                            name="save"
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

<?php
unset($_SESSION['nikError']);
unset($_SESSION['passwordError']);
unset($_SESSION['emailError']);
unset($_SESSION['dataInput']);
unset($_SESSION['birthDateError']);
require_once "includes/footer.php";
?>

