<?php

require_once __DIR__ . "/../includes/html-head.php";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/sidebar.php";
require_once __DIR__ . "/../includes/pma-db.php";
require_once __DIR__ . "/../action/common-action.php";
require_once __DIR__ . "/../action/jobs-action.php";

global $PDO;
session_start();
unset($_SESSION['jobId']);

checkUserLogin($_SESSION['userEmail'], true);

if (isset($_GET["search"]) != null ) {
    $url = "search=" . $_GET['search'] . "&";
} else {
    $url = "";
}

addHeadCode("jobs.css", "JOBS - Person Management App");
showHeader("jobs");
?>
  <main>
    <section class="main-section d-flex flex-row">
        <?php showSidebar("jobs"); ?>

      <div class="main-content">
        <div class="jobs m-3 m-md-4">
          <div class="content-title">
            <h2 class="heading-2 m-0 p-3">LIST OF JOBS</h2>
          </div>

          <?php if (isset($_SESSION['info'])){ ?>
            <div class="alert alert-success saved" role="alert">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square-fill" viewBox="0 0 16 16">
                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75
                                  0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093
                                  3.473-4.425a.75.75 0 0 1 1.08-.022z"/>
              </svg>
                <?php echo $_SESSION['info']; ?>
            </div>
          <?php }else if (isset($_SESSION['deleteInfo'])){ ?>
            <div class="alert alert-success saved" role="alert">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square-fill" viewBox="0 0 16 16">
                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75
                                  0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093
                                  3.473-4.425a.75.75 0 0 1 1.08-.022z"/>
              </svg>
                <?php echo $_SESSION['deleteInfo']; ?>
            </div>
          <?php } else if (isset($_SESSION['editInfo'])){?>
            <div class="alert alert-success saved" role="alert">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square-fill" viewBox="0 0 16 16">
                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75
                                            0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093
                                            3.473-4.425a.75.75 0 0 1 1.08-.022z"/>
              </svg>
                <?php echo $_SESSION['editInfo']; ?>
            </div>
          <?php } else if (isset($_SESSION['error'])){?>
            <div class="alert alert-danger mx-5" role="alert">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                   class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889
                          0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0
                          0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
              </svg>
              <?php echo $_SESSION['error']; ?>
            </div>
          <?php }?>

          <div class="search-add d-sm-flex justify-content-between">
            <div class="d-flex">
                <?php if ($_SESSION['userRole'] == "A") { ?>
                  <a
                    href="../jobs/create-job.php"
                    class="table-btn btn-primary btn-lg btn-add p-3 mb-sm-4 btn-link"
                    type="button"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-person-workspace add-icon me-2" viewBox="0 0 16 16">
                      <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                      <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.4 5.4 0 0 1 1.066-2H1V3a1 1 0 0 1
                      1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2z"/>
                    </svg>
                    Add Jobs
                  </a>
                <?php } ?>
            </div>
            <div class="mb-4">
              <nav class="navbar search-job">
                <div class="container-sm-fluid">
                  <form class="d-flex justify-content-" role="search" method="get" action="jobs.php">
                    <input name="search" id="search-input" class="form-control me-2 input-search" type="search"
                       placeholder="Search job"
                       aria-label="Search"
                        <?php if (isset($_GET['search'])){?>
                          value="<?php echo $_GET['search'];?>"
                        <?php }?>
                    >
                    <button class="btn btn-search d-flex me-2" type="submit">
                      <ion-icon class="me-1" name="search-outline"></ion-icon>
                      Search
                    </button>

                    <?php if (isset($_GET['search'])){?>
                      <a role="button" class="btn btn-search pb-2 d-flex" type="reset" href="jobs.php">
                        <ion-icon class="reset-icon me-1" name="reload-outline"></ion-icon> Reset
                      </a>
                    <?php } ?>
                  </form>
                </div>
              </nav>
            </div>
          </div>

          <div class="table-data" id="table">
            <div class="table-responsive ms-xxl-5 me-xxl-5">
                <?php

                if (isset($_GET['page']) == null) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }
                $limit = 7;

                $previous = $page - 1;
                $next = $page + 1;

                if (isset($_GET['search'])){
                    $jobs = getPaginatedJobs($limit, $page, $_GET['search']);
                }else {
                    $jobs = getPaginatedJobs($limit, $page);
                }
                $jobsPaging = $jobs['pagingData'];

                $number = ($page - 1) * $limit + 1;

                if (isset($_GET['search']) != null && $jobsPaging == null){?>
              <div class="alert alert-danger mx-5" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889
                        0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0
                        0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                </svg>
                Search result is not found!
              </div>
                <?php }else if ($jobsPaging == null){?>
              <div class="alert alert-danger mx-5" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889
                        0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0
                        0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                </svg>
                Search result is not found!
              </div>
              <?php } else {?>
                <table class="table table-hover table-bordered">
                  <thead>
                  <tr>
                    <th class="text-center p-3" scope="col">No</th>
                    <th class="text-center p-3" scope="col">Jobs</th>
                    <th class="text-center p-3" scope="col">Workers</th>
                    <?php if ($_SESSION['userRole'] == 'A'){?>
                      <th scope="col"></th>
                    <?php }?>
                  </tr>
                  </thead>

                  <tbody>
                    <?php for ($i = 0; $i < count($jobsPaging); $i++) { ?>
                      <tr>
                        <td class="text-center"><?php echo $number++ ?></td>
                        <td class=""><?php echo $jobsPaging[$i]['job_name']; ?></td>
                        <td class="text-center"><?php
                            $query = 'SELECT count FROM Jobs WHERE ID = :jobId';
                            $statement = $PDO->prepare($query);
                            $statement->execute(array(
                                    'jobId' => $jobsPaging[$i]['ID']
                            ));
                            echo $statement->fetch(PDO::FETCH_ASSOC)['count'];
//                            echo getCountJobByJobId($jobsPaging[$i]['ID'])
                            ?></td>
                        <?php if ($_SESSION['userRole'] == "A") { ?>
                          <td>
                            <div class="d-grid gap-3 d-flex justify-content-md-center">

                              <a
                                class="btn btn-outline-light btn-table"
                                type="button"
                                href="edit-job.php?page=<?php echo $_GET['page']; ?>&jobId=<?php echo $jobsPaging[$i]['ID']?>"
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
                                class="btn btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#exampleModal<?= $jobsPaging[$i]['ID'] ?>"
                              >
                                <ion-icon name="trash"></ion-icon>
                                DELETE
                              </button>

                              <!-- Delete Modal -->
                              <div
                                class="modal fade"
                                id="exampleModal<?= $jobsPaging[$i]['ID'] ?>"
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
    <!--                                      --><?php //$_SESSION['jobId'] = $jobsPaging[$i]['ID']; ?>
                                        <a type="submit" role="button" class="btn-modal"
                                           href="/action/delete-job-action.php?page=<?php echo $_GET['page']; ?>&jobId=<?php echo $jobsPaging[$i]['ID']?>">YES</a>
                                      </button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              <?php } ?>

<!--              pagination -->
              <div class="page">
                <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-center">
                    <li class="page-item">

                        <?php if ($jobs['totalPage'] >= $_GET['page'] && $page > 1 && is_numeric($_GET['page']) != null) { ?>
                          <a class="page-link"
                             href='?<?php echo $url;?>page=<?php echo $previous ?>'
                          >
                            <ion-icon
                                    class="page-icon"
                                    name="caret-back-outline"
                            ></ion-icon>
                          </a>
                        <?php } ?>
                    </li>

                      <?php if ($jobs['totalPage'] > 1) {
                          for ($i = 1; $i <= $jobs["totalPage"]; $i++) {
                              //                                untuk memberi warna pada halaman pertama saat membuka page
                              if (isset($_GET['page']) == null && $i == 1) { ?>
                                <li class="page-item active">
                                  <a class="page-link"
                                     href="?<?php echo $url; ?>page=<?php echo $i ?>"> <?php echo $i ?>
                                  </a>
                                </li>
                                <!-- untuk memberikan warna pada halaman saat ini        -->
                              <?php } else if ($_GET["page"] == $i) { ?>
                                <li class="page-item active">
                                  <a class="page-link"
                                     href="?<?php echo $url; ?>page=<?php echo $i ?>"> <?php echo $i ?>
                                  </a>
                                </li>
                                <!-- untuk memberikan warna pada halaman jika diinput "asdancasdw"      -->
                              <?php } else if ($_GET['page'] > $jobs['totalPage'] && $i == 1) { ?>
                                <li class="page-item active">
                                  <a class="page-link"
                                     href="?<?php echo $url;?>page=<?php echo $i ?>"> <?php echo $i ?>
                                  </a>
                                </li>
                                <!-- untuk memberikan warna pada halaman jika inputan -2              -->
                              <?php } else if (is_numeric($_GET['page']) == true && $_GET['page'] < 1 && $i == 1) { ?>
                                <li class="page-item active">
                                  <a class="page-link"
                                     href="?<?php echo $url; ?>page=<?php echo $i ?>"> <?php echo $i ?>
                                  </a>
                                </li>
                                <!-- untuk membuat banyak halaman yang di perlukan -->
                              <?php } else { ?>
                                <li class="page-item">
                                  <a class="page-link"
                                     href="?<?php echo $url;?>page=<?php echo $i ?>"> <?php echo $i ?>
                                  </a>
                                </li>
                              <?php } ?>
                          <?php }
                      } ?>

                    <li class="page-item">
                        <?php if ($page < $jobs["totalPage"] || $jobs['totalPage'] != 1 && $_GET['page'] > $jobs['totalPage']) { ?>
                          <a class="page-link"
                             href='?<?php echo $url;?>page=<?php echo $next ?>'>
                            <ion-icon
                              class="page-icon"
                              name="caret-forward-outline"
                            ></ion-icon>
                          </a>
                        <?php } ?>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
<?php
unset($_SESSION['info']);
unset($_SESSION['deleteInfo']);
unset($_SESSION['editInfo']);
unset($_SESSION['error']);
require_once __DIR__ . "/../includes/footer.php";
?>