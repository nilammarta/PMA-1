<?php
include("action/common-action.php");
require_once "includes/html-head.php";
require_once "includes/header.php";
require_once "includes/sidebar.php";
require_once "includes/pma-db.php";

session_start();
checkUserLogin($_SESSION['userEmail']);
if ($_GET['person'] == null){
  redirect("dashboard.php", "");
}else{
    if (!is_numeric($_GET['person'])){
        $thePerson = null;
    }else {
        $thePerson = getUserById($_GET['person']);
    }
}

if ($_SESSION['userEmail'] == $thePerson['email']){
  redirect("my-profile.php", "");
}

if (isset($_GET['search']) != null && isset($_GET['filter']) != null){
  $url = "search=" . $_GET['search'] . "&filter=" . $_GET['filter'] . "&";
}else{
  $url = "";
}

unset($_SESSION['page']);
unset($_SESSION['filter']);
unset($_SESSION['search']);
unset($_SESSION['personId']);

addHeadCode("view.css", "VIEW - Persons Management App");

showHeader("persons");
?>
    <main>
      <section class="main-section d-flex flex-row">
        <?php showSidebar("persons"); ?>

        <div class="main-content">
          <div class="profile m-3 m-md-4">
            <div class="content-title">
              <h2 class="heading-2 m-0 p-3">VIEW PERSON DATA</h2>
            </div>

            <div class="row justify-content-center">
              <div class="col-12 col-lg-10 col-xl-9 col-xxl-7">

                <?php if (isset($_GET["person"])) {
                      if (!is_numeric($_GET['person'])){
                          $thePerson = null;
                      }else {
                          $thePerson = getUserById($_GET['person']);
                      }

                      $_SESSION['personId'] = $_GET['person'];
                      $_SESSION['page'] = $_GET['page'];
                      $_SESSION['filter'] = $_GET['filter'];
                      $_SESSION['search'] = $_GET['search'];
                      ?>

<!--              alert untuk menampilkan validasi jika data sudah tersimpan atau sudah di perbarui    -->
<!--                  --><?php //if (isset($_GET['saved']) && $_GET['saved'] == 1 && $thePerson != null){ ?>
                  <?php if (isset($_SESSION['info'])){ ?>
                    <div class="alert alert-success saved" role="alert">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square-fill" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75
                        0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093
                        3.473-4.425a.75.75 0 0 1 1.08-.022z"/>
                      </svg>
                      <?php echo $_SESSION['info']; ?>
                    </div>
                  <?php }else if (isset($_GET['saved']) && $_GET['saved'] == 2 && $thePerson != null){ ?>
                    <div class="alert alert-success saved" role="alert">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square-fill" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75
                        0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093
                        3.473-4.425a.75.75 0 0 1 1.08-.022z"/>
                      </svg>
                      Person Data has been updated!
                    </div>
                  <?php } ?>
                  <!--        alert untuk validasi penghapusan jika data admin hanya ada satu       -->
                    <?php if (isset($_GET['error']) && $_GET['error'] == 1){ ?>
                  <div class="alert alert-danger saved mt-4" role="alert">
                    Can not delete this data, because there is only one admin in the database!
                  </div>
                  <!--        alert untuk validasi penghapusan jika data yang di hapus adalah dirinya sendiri        -->
                  <?php }else if (isset($_GET['error']) && $_GET['error'] == 2) { ?>
                  <div class="alert alert-danger saved mt-4" role="alert">
                    Can not delete your own data!
                  </div>
                  <?php } ?>

                  <div class="card" style="width: 100%">
                    <div
                      class="card-body card-body-1 d-flex justify-content-center"
                    >
                      <h3 class="card-title main-title p-4 m-2 heading-tertiary">
                        Person Data
                      </h3>
                    </div>

                    <?php if ($thePerson != null) { ?>
                      <div class="table-responsive table-background">
                        <table class="table mb-0">
                          <tbody>
                            <tr>
                              <td class="card-label">First Name</td>
                              <td>:</td>
                              <td><?php echo $thePerson["first_name"]; ?></td>
                            </tr>
                            <tr>
                              <td>Last Name</td>
                              <td>:</td>
                              <td><?php echo $thePerson['last_name']; ?></td>
                            </tr>
                            <tr>
                              <td>NIK</td>
                              <td>:</td>
                              <td><?php echo $thePerson['nik']; ?></td>
                            </tr>
                            <tr>
                              <td>Email</td>
                              <td>:</td>
                              <td><?php echo $thePerson['email']; ?></td>
                            </tr>
                            <tr>
                              <td>Age</td>
                              <td>:</td>
                              <td><?php $age = getAge($thePerson['birth_date']);
                                if ($age > 1){
                                  echo $age . " years old";
                                }else {
                                  echo $age . " year old";
                                }
                              ?></td>
                            </tr>
                            <tr>
                              <td>Birth Date</td>
                              <td>:</td>
                              <td><?php echo date("d F Y", strtotime($thePerson['birth_date'])); ?></td>
                            </tr>
                            <tr>
                              <td>Gender</td>
                              <td>:</td>
                              <td><?php echo getGender($thePerson['sex']); ?></td>
                            </tr>
                            <tr>
                              <td>Address</td>
                              <td>:</td>
                              <td><?php echo $thePerson['address']; ?></td>
                            </tr>
                            <tr>
                              <td>Role</td>
                              <td>:</td>
                              <td><?php echo getRole($thePerson['role']); ?></td>
                            </tr>
                            <tr>
                              <td>Status</td>
                              <td>:</td>
                              <td><?php echo getStatus($thePerson['alive']); ?></td>
                            </tr>
                            <tr>
                              <td>Job</td>
                              <td>:</td>
                              <td><?php echo getPersonJob($thePerson['ID'])['job']; ?></td>
                            </tr>
                          </tbody>
                        </table>

                        <?php if ($_SESSION['userRole'] == "A"){ ?>
                          <div class="card-body card-body-2">
                            <h6 class="card-title">Internal notes :</h6>
                            <div class="text-internal"><?php echo $thePerson['internal_notes'] ?></div>
                          </div>
                        <?php } ?>

                        <?php $personHobbies = getPersonHobby($thePerson['ID']); ?>
                        <?php if ($personHobbies != null){?>
                          <div class="table-responsive table-background">
                            <div class="hobby p-4">
                              <table class="table table-hover table-bordered mb-0">
                                <thead class="thead-hobby">
                                  <tr>
                                    <th class="text-center p-3" scope="col">No</th>
                                    <th class="text-center p-3" scope="col">Hobbies</th>
                                    <?php if ($thePerson['email'] == $_SESSION['userEmail'] || $_SESSION['userRole'] == "A"){ ?>
                                      <th scope="col"></th>
                                    <?php } ?>
                                  </tr>
                                </thead>
                                <?php for ($i = 0; $i < count($personHobbies); $i++){?>
                                  <tbody class="tbody-hobby">
                                    <tr>
                                      <td class="text-center p-3"><?php echo $i + 1; ?></td>
                                      <td class="text-center p-3"><?php echo $personHobbies[$i]['hobby_name'];?></td>
                                      <?php if ($thePerson['email'] == $_SESSION['userEmail'] || $_SESSION['userRole'] == "A"){ ?>
                                        <td>
                                          <div class="d-grid gap-3 d-flex justify-content-md-center">
                                            <a
                                              class="btn btn-outline-light btn-table p-2"
                                              type="button"
                                              href="hobbies/edit-hobby.php?<?php echo $url; ?>page=<?php echo $_GET['page']; ?>&person=<?php echo $_GET['person']; ?>&hobbyId=<?php echo $personHobbies[$i]['ID']?>"
                                            >
                                              <ion-icon
                                                class="btn-icon"
                                                name="create-sharp"
                                              ></ion-icon>
                                              EDIT
                                            </a>

                                            <!-- delete hobby -->
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
                                                         href="/action/delete-hobby-action.php?<?php echo $url; ?>page=<?php echo $_GET['page'];?>&person=<?php echo $_GET['person'];?>&hobbyId=<?php echo $personHobbies[$i]['ID']?>">YES</a>
                                                    </button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </td>
                                      <?php }?>
                                    </tr>
                                  </tbody>
                                <?php }?>
                              </table>
                            </div>
                          </div>
                        <?php }?>

                        <?php if ($_SESSION['userRole'] == "A"){ ?>
                          <div class="card-body card-body-2">
                              <?php if ($personHobbies == null){?>
                                <i>*No Hobby have been added yet</i>
                              <?php }?>
                            <div class="d-flex justify-content-end">
                              <a class="btn btn-primary" role="button" href="hobbies/create-hobby.php?page=<?php echo $_GET['page'];?>&person=<?php echo $_GET['person'];?>">
                                <ion-icon name="add-circle"></ion-icon>
                                Add Hobby
                              </a>
                            </div>
                          </div>
                        <?php }?>

                        <div class="card-body btn-card">
                            <?php
                            if (isset($_GET["search"]) != null && isset($_GET['filter']) != null) {
                                $url = "search=" . $_GET['search'] . "&filter=" . $_GET['filter'] . "&";
                            } else {
                                $url = "";
                            }
                            ?>

                          <a class="btn btn-secondary me-2"
                             href="persons.php?<?php echo $url?>page=<?php echo $_GET['page']?>"
                             role="button">
                            <ion-icon name="arrow-back-sharp"></ion-icon>
                              <?php if ($_SESSION['userRole'] == "M"){
                                echo "Back";
                              }?>
                          </a>

                          <?php if ($_SESSION['userRole'] == "A"){ ?>
                            <a
                              class="btn btn-primary me-2"
                              <?php if ($thePerson['email'] == $_SESSION['userEmail']){ ?>
                                href="my-profile.php?<?php echo $url?>page=<?php echo $_GET['page']?>&person=<?php echo $_GET['person'] ?>"
                              <?php } else {?>
                                href="edit.php?<?php echo $url?>page=<?php echo $_GET['page']?>&person=<?php echo $_GET['person'] ?>"
                              <?php }?>
                              role="button"
                            >
                              <ion-icon name="create"></ion-icon>
                              EDIT
                            </a>

                            <button
                              type="button"
                              class="btn btn-danger"
                              data-bs-toggle="modal"
                              data-bs-target="#exampleModal"
                            >
                              <ion-icon name="trash"></ion-icon>
                              DELETE
                            </button>

                            <!-- Modal -->
                            <div
                              class="modal fade"
                              id="exampleModal"
                              tabindex="-1"
                              aria-labelledby="exampleModalLabel"
                              aria-hidden="true"
                            >
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel">
                                      Delete Person
                                    </h4>
                                    <button
                                      type="button"
                                      class="btn-close"
                                      data-bs-dismiss="modal"
                                      aria-label="Close"
                                    ></button>
                                  </div>
                                  <div class="modal-body">Are you sure want to delete this person?</div>
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
                                      <a type="submit" role="button" class="btn-modal" href="action/delete-action.php?jobId=<?php echo getPersonJob($thePerson['ID'])['jobId']; ?>">YES</a>
                                    </button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                    <?php } else { ?>
                      <div class="alert alert-danger mb-0" role="alert">
                        Person data is not found!
                      </div>
                    <?php } ?>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
<?php
unset($_SESSION['info']);
require_once "includes/footer.php";
