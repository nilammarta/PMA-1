<?php
include("action/common-action.php");
require_once "includes/html-head.php";
require_once "includes/header.php";
require_once "includes/sidebar.php";
require_once "includes/pma-db.php";
global $PDO;

session_start();
checkUserLogin($_SESSION['userEmail']);
if ($_GET['person'] == null){
  redirect("dashboard.php", "");
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
//                          $thePerson = getUserById($_GET['person'], $PDO);
                          $query = 'SELECT * FROM Persons WHERE ID = :personId';
                          $statement = $PDO->prepare($query);
                          $statement ->execute(array('personId' => $_GET['person']));
                          $thePerson = $statement->fetch(PDO::FETCH_ASSOC);
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
                      New Person has been saved!
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
                      <div class="table-responsive">
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
                              <td><?php echo date('d F Y', $thePerson['birth_date']); ?></td>
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
                          </tbody>
                        </table>

                        <?php if ($_SESSION['userRole'] == "ADMIN"){ ?>
                          <div class="card-body card-body-2">
                            <h6 class="card-title">Internal notes :</h6>
                            <div class="card-text"><?php echo $thePerson['internal_notes'] ?></div>
                          </div>
                        <?php } ?>

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
                                      <a type="submit" role="button" class="btn-modal" href="action/delete-action.php">YES</a>
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
?>