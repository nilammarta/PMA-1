<?php
include("action/common-action.php");
require_once "includes/html-head.php";
require_once "includes/header.php";
require_once "includes/sidebar.php";
require_once __DIR__ . "/includes/pma-db.php";

global $PDO;
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
//                  $user = getUserByEmail($_SESSION['userEmail']);
                  $query = 'SELECT * FROM Persons WHERE email = :email';
                  $statement = $PDO->prepare($query);
                  $statement->execute(array(
                      "email" => $_SESSION['userEmail']
                  ));
                  $user = $statement->fetch(PDO::FETCH_ASSOC);

                  $_SESSION['personId'] = $user['ID'];
                  if (isset($_GET['page']) == null){
                    $page = "1";
                  }else{
                    $page = $_GET['page'];
                  }
                  $_SESSION['page'] = $page;
                  $_SESSION['filter'] = $_GET['filter'];
                  $_SESSION['search'] = $_GET['search'];


                  if (isset($_SESSION['errorData']) || isset($_SESSION['errorPassword'])){
                    $error = [];
                    if (isset($_SESSION['errorData']['firstName'])){
                        $error[] = $_SESSION['errorData']['firstName'];
                    }
                    if (isset($_SESSION['errorData']['lastName'])){
                        $error[] = $_SESSION['errorData']['lastName'];
                    }
                    if (isset($_SESSION['errorData']['nik'])){
                      $error[] = $_SESSION['errorData']['nik'];
                    }
                    if (isset($_SESSION['errorData']['email'])){
                      $error[] = $_SESSION['errorData']['email'];
                    }
                    if (isset($_SESSION['errorData']['birthDate'])){
                      $error[] = $_SESSION['errorData']['birthDate'];
                    }
                    if (isset($_SESSION['errorPassword']['currentPass'])){
                      $error[] = $_SESSION['errorPassword']['currentPass'];
                    }
                    if (isset($_SESSION['errorPassword']['passError']) && isset($_SESSION['errorPassword']['newPass']) == null && isset($_SESSION['errorPassword']['confirmPass']) == null){
                      $error[] = $_SESSION['errorPassword']['passError'];
                    }
                    if (isset($_SESSION['errorPassword']['newPass'])){
                      $error[] = $_SESSION['errorPassword']['newPass'];
                    }
                    if (isset($_SESSION['errorPassword']['confirmPass'])){
                      $error[] = $_SESSION['errorPassword']['confirmPass'];
                    }
                    ?>

                    <div class="alert alert-danger error-banner">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                           class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889
                        0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0
                        0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                      </svg>
                      Error while submit the form: <br>
                      <?php
                        for ($i = 0; $i<count($error); $i++){
                          echo "- " . $error[$i] . "<br>";
                        }
                      ?>
                    </div>
                  <?php }else if (isset($_SESSION['error']) || isset($_GET['error'])){ ?>
                    <div class="alert alert-danger error-banner">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                           class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889
                        0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0
                        0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                      </svg>
                      <?php echo $_SESSION['error']; ?>
                    </div>

                  <?php }?>
                  <?php if (isset($_SESSION['info'])){?>
                    <div class="alert alert-success saved mb-4" role="alert">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square-fill" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75
                        0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093
                        3.473-4.425a.75.75 0 0 1 1.08-.022z"/>
                      </svg>
                       <?php echo $_SESSION['info']; ?>
                    </div>
                  <?php } ?>


                <form name="editProfile" class="create-form needs-validation p-4 mb-5" method="post" action="action/my-profile-action.php">
                  <input
                    name="userJob"
                    type="hidden"
                    value="<?php
                    $queryJob = 'SELECT job_id FROM Persons_Jobs WHERE person_id = :personId';
                    $statement = $PDO->prepare($queryJob);
                    $statement->execute(array(
                        'personId' => $user['ID']
                    ));
                    echo $statement->fetch(PDO::FETCH_ASSOC)['job_id'];?>"
                  >
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
                        class="form-control <?php if (isset($_SESSION['errorData']['firstName'])) { ?>
                              is-invalid
                            <?php } ?>"
                        id="inputFirstname"
                        value="<?php if (isset($_SESSION['inputData'])){
                          echo $_SESSION['inputData']['firstName'];
                        }else {
                          echo $user["first_name"];
                        }?>"
                      />
                      <?php if (isset($_SESSION['errorData']['firstName'])) {?>
                        <p class="error"> <?php echo $_SESSION['errorData']['firstName']; ?></p>
                      <?php } ?>
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
                        class="form-control <?php if (isset($_SESSION['errorData']['lastName'])) { ?>
                              is-invalid
                            <?php } ?>"
                        id="inputLastname"
                        value="<?php if (isset($_SESSION['inputData'])){
                          echo $_SESSION['inputData']['lastName'];
                        }else {
                          echo $user['last_name'];
                        } ?>"
                      />
                      <?php if (isset($_SESSION['errorData']['lastName'])) {?>
                        <p class="error"> <?php echo $_SESSION['errorData']['lastName']; ?></p>
                      <?php } ?>
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
                          echo $user['birth_date'];
                        }?>"
                      />

                      <?php if (isset($_SESSION['errorData']['birthDate'])){ ?>
                        <p class="error"><?php echo $_SESSION['errorData']['birthDate']; ?></p>
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
                            echo getGender($_SESSION['inputData']['sex']);
                          }else{
                            echo getGender($user['sex']);
                          } ?>
                        </option>
                        <?php if (isset($_SESSION['inputData']) == true && $_SESSION['inputData']['sex'] == "F"){ ?>
                          <option class="option-value" value="M">Male</option>
                        <?php }else if ($user['sex'] == "F") {?>
                          <option class="option-value" value="M">Male</option>
                        <?php }else { ?>
                          <option class="option-value" value="F">Female</option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label
                      for="exampleJobInput"
                      class="col-sm-2 col-form-label form-label">Job</label>
                    <div class="col-sm-10">
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
                          <?php } else {
                              $queryJob = 'SELECT job_id FROM Persons_Jobs WHERE person_id = :personId';
                              $statement = $PDO->prepare($queryJob);
                              $statement->execute(array(
                                  'personId' => $user['ID']
                              ));
                              $jobID = $statement->fetch(PDO::FETCH_ASSOC)['job_id'];
                            ?>
                            <option selected value="<?php
                              if ($jobID == null){
                                echo "1";
                              }else{
                                echo $jobID;
                              }
                            ?>"><?php $personJob = getPersonJob($user['ID'])['job'];
                                echo $personJob;
                            ?></option>
                            <?php $jobs = getJobs($jobID);
                            for ($i = 0; $i < count($jobs); $i++){ ?>
                              <option value="<?php echo $jobs[$i]['ID'];?>"><?php echo $jobs[$i]['job_name'];?></option>
                            <?php } ?>
                          <?php }?>
                      </select>
                    </div>
                  </div>

                  <?php if ($_SESSION['userRole'] == "A"){?>
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
                        maxlength="310"
                      ><?php if (isset($_SESSION['inputData'])) {
                            echo $_SESSION['inputData']['internalNotes'];
                        } else {
                            echo $user['internal_notes'];
                        } ?></textarea>
                    </div>
                  <?php } ?>

                  <div class="hobby-title mb-2">Hobbies</div>
                  <?php $personHobbies = getPersonHobby($user['ID']);
                    if ($personHobbies != null){?>
                    <div class="mb-4 ">
                      <div class="table-responsive">
                        <table class="table table-hover table-bordered mb-0">
                          <thead class="thead-hobby">
                          <tr>
                            <th class="text-center p-3" scope="col">No</th>
                            <th class="text-center p-3" scope="col">Hobbies</th>
                                <th scope="col"></th>
                          </tr>
                          </thead>
                          <?php for ($i = 0; $i < count($personHobbies); $i++){?>
                            <tbody class="tbody-hobby">
                              <tr>
                                <td class="text-center"><?php echo $i + 1; ?></td>
                                <td class="text-center"><?php echo $personHobbies[$i]['hobby_name'];?></td>
                                  <td>
                                    <div class="d-grid gap-3 d-flex justify-content-md-center">
                                      <a
                                        class="btn btn-outline-light btn-table p-2"
                                        type="button"
                                        href="hobbies/edit-hobby.php?person=<?php echo $user['ID']; ?>&hobbyId=<?php echo $personHobbies[$i]['ID']?>"
                                      >
                                        <ion-icon
                                          class="btn-icon"
                                          name="create-sharp"
                                        ></ion-icon>
                                        EDIT
                                      </a>

                                      <!-- delete jobs -->
                                      <button
                                        type="button"
                                        class="btn btn-danger p-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#exampleModal<?= $personHobbies[$i]['ID'] ?>"
                                      >
                                        <ion-icon name="trash"></ion-icon>
                                        DELETE
                                      </button>

                                      <!-- Delete Modal -->
                                      <div
                                        class="modal fade"
                                        id="exampleModal<?= $personHobbies[$i]['ID'] ?>"
                                        tabindex="-1"
                                        aria-labelledby="exampleModalLabel"
                                        aria-hidden="true"
                                      >
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h4 class="modal-title" id="exampleModalLabel">
                                                Delete Job
                                              </h4>
                                              <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"
                                              ></button>
                                            </div>
                                            <div class="modal-body">Are you sure want to delete this job?</div>
                                            <div class="modal-footer">
                                              <button
                                                type="button"
                                                class="btn btn-secondary"
                                                data-bs-dismiss="modal"
                                              >
                                                NO
                                              </button>
                                              <button
                                                type="button"
                                                class="btn btn-primary"
                                              >
                                                <a type="submit" role="button" class="btn-modal"
                                                   href="/action/delete-hobby-action.php?hobbyId=<?php echo $personHobbies[$i]['ID']?>">YES</a>
                                              </button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                              </tr>
                            </tbody>
                          <?php }?>
                        </table>
                      </div>
                    </div>
                  <?php }?>
<!--                 Add new hobby -->
                  <div class="card-body card-body-2">
                      <?php if ($personHobbies == null){?>
                        <i>*No Hobby have been added yet</i>
                      <?php }?>
                    <div class="d-flex justify-content-end">
                      <a class="btn btn-primary" role="button" href="hobbies/create-hobby.php?person=<?php echo $user['ID'];?>">
                        <ion-icon name="add-circle"></ion-icon>
                        Add Hobby
                      </a>
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
                        class="form-control mb-2 <?php if (isset($_SESSION['errorPassword']['newPass']) || isset($_SESSION['errorPassword']['currentPass']) == null && isset($_SESSION['errorPassword']['passError'])){
                          echo "is-invalid";
                        } ?>"
                        id="inputNewPassword"
                        placeholder="new password"
                      />

                      <?php if (isset($_SESSION['errorPassword']['newPass'])){?>
                        <p class="error"><?php echo $_SESSION['errorPassword']['newPass']; ?></p>
                      <?php } ?>
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
                        class="form-control mb-2 <?php if (isset($_SESSION['errorPassword']['confirmPass']) || isset($_SESSION['errorPassword']["currentPass"]) == null && isset($_SESSION['errorPassword']['newPass']) == null && isset($_SESSION['errorPassword']['passError'])) {
                          echo "is-invalid";
                        }?>"
                        id="inputConfirmPassword"
                        placeholder="confirm password"
                      />
                      <?php if (isset($_SESSION['errorPassword']['confirmPass'])){?>
                        <p class="error"><?php echo $_SESSION['errorPassword']['confirmPass']; ?></p>
                      <?php } else if(isset($_SESSION['errorPassword']['currentPass']) == null && isset($_SESSION['errorPassword']['newPass']) == null && isset($_SESSION['errorPassword']['passError'])){ ?>
                        <p class="error mt-3"><?php echo $_SESSION['errorPassword']['passError']; ?></p>
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
    unset($_SESSION['info']);
    unset($_SESSION['error']);
    require_once "includes/footer.php";
  ?>
