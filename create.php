<?php
//include "action/common-action.php";
require_once "action/common-action.php";
require_once "includes/html-head.php";
require_once "includes/header.php";
require_once "includes/sidebar.php";
//require_once "includes/pma-db.php";

//global $PDO;
session_start();
checkUserLogin($_SESSION['userEmail']);
checkUserLoginRole($_SESSION['userRole']);

addHeadCode("create.css", "CREATE - Persons Management App");
showHeader("persons");

?>
    <main>
      <section class="main-section d-flex flex-row">
        <?php showSidebar("persons"); ?>

        <div class="main-content">
          <div class="create m-3 m-md-4">
            <div class="content-title">
              <h2 class="heading-2 m-0 p-3">ADD PERSON</h2>
            </div>

            <?php if (isset($_SESSION['errorData'])){
              $error = [];
              if (isset($_SESSION['errorData']['nik'])){
                $error[] = $_SESSION['errorData']['nik'];
              }
              if (isset($_SESSION['errorData']['email'])){
                $error[] = $_SESSION['errorData']['email'];
              }
              if (isset($_SESSION['errorData']['password'])){
                $error[] = $_SESSION['errorData']['password'];
              }
              if (isset($_SESSION['errorData']['birthDate'])){
                $error[] = $_SESSION['errorData']['birthDate'];
              }
              if (isset($_GET['error']) && $_GET['error'] == 1){
                $error[] = $_SESSION['error'];
              }?>
              <div class="alert alert-danger error-banner" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889
                            0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0
                            0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                </svg>
                Error while submit the form:<br>
                  <?php for ($i = 0; $i < count($error); $i++){
                      echo "- " . $error[$i] . "<br>";
                  } ?>
              </div>
            <?php } else if (isset($_SESSION['error']) && $_GET['error'] == 1){ ?>
              <div class="alert alert-danger error-banner" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889
                            0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0
                            0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                </svg>
                <?php echo $_SESSION['error']; ?>
              </div>
            <?php }?>


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
                            class="form-control mb-2 <?php if (isset($_SESSION['errorData']['nik'])) { ?>
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
                          <?php if (isset($_SESSION['errorData']['nik'])) {?>
                            <p class="error"> <?php echo $_SESSION['errorData']['nik'];?> </p>
                          <?php } ?>
                        </div>

                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label"
                          >Email &#42;</label>
                          <input
                            name="email"
                            type="email"
                            class="form-control mb-2 <?php if (isset($_SESSION['errorData']['email'])) { ?>
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
                          <?php if (isset($_SESSION['errorData']['email'])){?>
                            <p class="error"> <?php echo $_SESSION['errorData']['email']; ?></p>
                          <?php } ?>
                        </div>

                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">
                            Password &#42;
                          </label>
                          <input
                            name="password"
                            type="password"
                            class="form-control mb-2 <?php if (isset($_SESSION['errorData']['password'])) {
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
                            class="form-control mb-2 <?php if (isset($_SESSION['errorData']['password'])){
                              echo "is-invalid";
                            } ?>"
                            id="exampleInputPassword2"
                            placeholder="confirm password"
                            required
                          />

                          <?php if (isset($_SESSION['errorData']['password'])){ ?>
                            <p class="error"><?php echo $_SESSION['errorData']['password']; ?></p>
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

                            <?php if (isset($_SESSION['errorData']['birthDate'])){ ?>
                              <p class="error"><?php echo $_SESSION['errorData']['birthDate']; ?></p>
                            <?php } ?>
                        </div>
                      </div>

                      <div class="form-2">

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
                                  <?php if ($_SESSION['dataInput']['sex'] == "M"){
                                echo "Male";
                                }else{
                                echo "Female";
                                }?>
                              </option>
                              <?php if ($_SESSION['dataInput']['sex'] == "F"){ ?>
                                <option class="option-value" value="M">Male</option>
                              <?php }else{ ?>
                                <option class="option-value" value="F">Female</option>
                              <?php } ?>
                            <?php }else{ ?>
                              <option selected disabled value="">choose...</option>
                              <option class="option-value" value="M">Male</option>
                              <option class="option-value" value="F">Female</option>
                            <?php } ?>
                          </select>
                        </div>

                        <div class="mb-3">
                          <label
                            for="exampleJobInput"
                            class="form-label">Job</label>
                          <select
                            name="job"
                            id="exampleJobInput"
                            class="form-select"
                            aria-label="Default select example"
                            required
                          >
                            <?php if ($_SESSION['dataInput']){?>
                              <option selected value="<?php echo $_SESSION['dataInput']['jobId'];?>">
                              <?php echo getJobById($_SESSION['dataInput']['jobId'])['job_name'];?></option>

                              <?php
                              $jobs = getJobs($_SESSION['dataInput']['jobId']);
                              for ($i = 0; $i < count($jobs); $i++){ ?>
                                <option value="<?php echo $jobs[$i]['ID'] ?>"><?php echo $jobs[$i]['job_name'] ?></option>
                              <?php } ?>
                            <?php } else { ?>
                              <option selected value="1">choose...</option>
                              <?php $jobs = getJobs();
                              for ($i = 1; $i < count($jobs); $i++){ ?>
                                <option value="<?php echo $jobs[$i]['ID'];?>"><?php echo $jobs[$i]['job_name'];?></option>
                              <?php } ?>
                            <?php }?>
                          </select>
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

<!--                        <div class="mb-3">-->
<!--                          <label-->
<!--                            for="exampleHobbyInput"-->
<!--                            class="form-label"-->
<!--                          >Hobby</label>-->
<!--                          <input-->
<!--                            name="hobby"-->
<!--                            id="exampleHobbyInput"-->
<!--                            class="form-control"-->
<!--                            type="text"-->
<!--                            placeholder="Hobby"-->
<!--                            value="--><?php //if (isset($_SESSION['dataInput'])) {
//                                echo $_SESSION['dataInput']['hobby'];
//                            }else{
//                              echo "";
//                            }?><!--"-->
<!--                          >-->
<!--                        </div>-->

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
                                <option selected value="<?php echo $_SESSION['dataInput']['role']?>"><?php if ($_SESSION['dataInput']['role'] == 'A'){
                                  echo "ADMIN";
                                }else{
                                  echo 'MEMBER';
                                }?>
                                </option>

                                <?php if ($_SESSION['dataInput']['role'] == "A") {?>
                                  <option class="option-value" value="M">MEMBER</option>
                                <?php }else { ?>
                                  <option class="option-value" value="A">ADMIN</option>
                                <?php } ?>
                            <?php }else{ ?>
                              <option selected disabled value="">choose...</option>
                              <option class="option-value" value="A">ADMIN</option>
                              <option class="option-value" value="M">MEMBER</option>
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
unset($_SESSION['dataInput']);
unset($_SESSION['errorData']);
unset($_SESSION['error']);
require_once "includes/footer.php";
?>

