<?php
require_once "includes/html-head.php";


//loginCheck($_SESSION['userEmail']);

if (isset($_SESSION['userEmail'])) {
    header("Location: ../dashboard.php");
    exit(); // Terminate script execution after the redirect
}

addHeadCode("login.css", "LOGIN - Persons Management App");
?>
  <body>
    <main>
      <section
        class="login-section d-flex flex-row align-items-center justify-content-center"
      >
        <div
          class="login-img-box d-none d-lg-flex flex-column justify-content-center"
        >
          <!-- logo untuk person management app -->
          <img
            class="login-img d-lg-block"
            src="assets/img/permap.svg"
            alt="Person Management App logo"
          />
        </div>

        <div class="container">
          <div class="login">
            <div class="row gy-5 gx-5 justify-content-center">
              <div class="col-12 col-md-9 col-lg-11 col-xl-9">
                <div class="login-text">
                  <div class="d-flex flex-column align-items-center">
                    <img
                      class="permap-logo d-lg-block mb-2"
                      src="assets/img/Permap-logo-2.svg"
                      alt="permap logo"
                    />
                    <h2 class="heading-2">
                      Person Management App
                    </h2>
                  </div>
                  <h6 class="heading-6 logo-description">
                    Masuk Ke Halaman Administrasi
                  </h6>

                  <!-- agar inputan form dapat di baca dan di simpan oleh server maka tambahkan name dan method -->
                  <form name="login-form" class="login-form" action="action/login-action.php" method="post">
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label"
                      >Email
                        <ion-icon
                          class="form-icon"
                          name="mail-outline"
                        ></ion-icon
                        >
                      </label>

                      <input
                        name="email"
                        type="email"
                        class="form-control"
                        id="exampleFormControlInput1"
                        placeholder="name@example.com"
                        required
                      />
                    </div>

                    <div class="mb-3">
                      <label for="inputPassword5" class="form-label"
                      >Password
                        <ion-icon
                          class="form-icon"
                          name="lock-closed-outline"
                        ></ion-icon
                        >
                      </label>
                      <input
                        name="password"
                        type="password"
                        id="inputPassword5"
                        class="form-control"
                        aria-describedby="passwordHelpBlock"
                        placeholder="Password"
                        required
                      />
                    </div>
                    <div>
                      <p class="question">Forget password?</p>
                    </div>

                    <!-- bagian code php yang digunakan untuk menampilkan validasi ketika email & password salah -->
                      <?php if (isset($_GET["error"]) && $_GET["error"] == 1) { ?>
                        <div class="alert alert-danger" role="alert">
                          Sorry, your email address or password is not correct, Please try again!
                        </div>
                      <?php } ?>
                    <button
                      class="btn btn-outline-light login-btn"
                      type="submit"
                      name="login"
                    >
                      Login
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php
  require_once "includes/footer.php";
?>
