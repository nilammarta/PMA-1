<?php

require_once __DIR__ . "/../includes/html-head.php";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/sidebar.php";
require_once __DIR__ . "/../action/common-action.php";

session_start();
checkUserLogin($_SESSION['userEmail']);

addHeadCode("create.css", "CREATE HOBBY - Person Management App");
showHeader("persons");
?>
<main>
  <section class="main-section d-flex flex-row">
      <?php showSidebar("persons"); ?>

    <div class="main-content">
      <div class="create-job m-3 m-md-4">
        <div class="content-title">
          <h2 class="heading-2 m-0 p-3">CREATE HOBBY</h2>
        </div>

        <div class="row justify-content-center">
          <div class="col-12 col-md-10 col-lg-11 col-xxl-7">
            <form name="addHobby" class="create-form needs-validation p-4 mb-5" method="post"
                  action="../action/create-edit-hobby-action.php?page=<?php echo $_GET['page']; ?>&person=<?php echo $_GET['person'];?>">
              <h5 class="form-text pb-2 mb-4">Add new hobby data in the form bellow:</h5>
              <div class="mb-3 row">
                <label
                  for="inputHobbyName"
                  class="col-sm-2 col-form-label form-label"
                >Hobby name &#42;</label>
                <div class="col-sm-10">
                  <input
                    name="hobbyName"
                    type="text"
                    class="form-control"
                    id="inputHobbyName"
                    placeholder="Hobby name"
                    value="<?php if (isset($_SESSION['hobbyInput'])){
                        echo $_SESSION['hobbyInput'];
                    }?>"
                  />
                    <?php if (isset($_SESSION['errorHobby'])){?>
                      <p class="error"><?php echo $_SESSION['errorHobby'];?> </p>
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
                      href="/view.php?page=<?php echo $_GET['page']; ?>&person=<?php echo $_GET['person']; ?>"
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
unset($_SESSION['errorHobby']);
unset($_SESSION['hobbyInput']);
unset($_SESSION['error']);
require_once __DIR__ . "/../includes/footer.php";
?>
