<?php

require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/html-head.php";
require_once __DIR__ . "/../includes/sidebar.php";
require_once __DIR__ . "/../includes/pma-db.php";
require_once __DIR__ . "/../action/common-action.php";

global $PDO;
session_start();
checkUserLoginRole($_SESSION['userRole']);

addHeadCode('create.css', 'CREATE JOB - Person Management App');
showHeader('jobs');
?>
<main>
  <section class="main-section d-flex flex-row">
      <?php showSidebar("jobs"); ?>

    <div class="main-content">
      <div class="create-job m-3 m-md-4">
        <div class="content-title">
          <h2 class="heading-2 m-0 p-3">EDIT JOB</h2>
        </div>

        <div class="row justify-content-center">
          <div class="col-12 col-md-10 col-lg-11 col-xxl-7">
            <form name="addJob" class="create-form needs-validation p-4 mb-5" method="post"
                  action="../action/create-edit-job-action.php?jobId=<?php echo $_GET['jobId']; ?>">
              <h5 class="form-text pb-2 mb-4">Edit job data in the form bellow:</h5>
              <div class="mb-3 row">
                <label
                  for="inputJobName"
                  class="col-sm-2 col-form-label form-label"
                >Job name &#42;</label>
                <div class="col-sm-10">
                  <input
                    name="jobName"
                    type="text"
                    class="form-control"
                    id="inputJobName"
                    placeholder="Job name"
                    value="<?php if (isset($_SESSION['jobInput'])){
                      echo $_SESSION['jobInput'];
                    }else {
                      $query = 'SELECT job_name FROM Jobs WHERE ID = :jobId';
                      $statement = $PDO->prepare($query);
                      $statement->execute(array(
                              'jobId' => $_GET['jobId']
                      ));
                      echo $statement->fetch(PDO::FETCH_ASSOC)['job_name'];
                    }?>"
                  />
                  <?php if (isset($_SESSION['errorJob'])){?>
                    <p class="error"><?php echo $_SESSION['errorJob'];?> </p>
                  <?php } ?>
                </div>
              </div>

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
                      href="jobs.php"
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
unset($_SESSION['jobInput']);
unset($_SESSION['errorJob']);
require_once __DIR__ . "/../includes/footer.php";
?>
