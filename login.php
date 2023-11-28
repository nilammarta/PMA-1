<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script
      type="module"
      src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule=""
      src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"
    ></script>

    <link
      rel="apple-touch-icon"
      sizes="57x57"
      href="assets/favicon/apple-icon-57x57.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="60x60"
      href="assets/favicon/apple-icon-60x60.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="72x72"
      href="assets/favicon/apple-icon-72x72.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="assets/favicon/apple-icon-76x76.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="114x114"
      href="assets/favicon/apple-icon-114x114.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="120x120"
      href="assets/favicon/apple-icon-120x120.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="144x144"
      href="assets/favicon/apple-icon-144x144.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="152x152"
      href="assets/favicon/apple-icon-152x152.png"
    />
    <link
      rel="apple-touch-icon"
      sizes="180x180"
      href="assets/favicon/apple-icon-180x180.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="192x192"
      href="assets/favicon/android-icon-192x192.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="assets/favicon/favicon-32x32.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="96x96"
      href="assets/favicon/favicon-96x96.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="assets/favicon/favicon-16x16.png"
    />
    <link rel="manifest" href="assets/favicon/manifest.json" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png" />
    <meta name="theme-color" content="#ffffff" />

    <link href="assets/css/general.css" rel="stylesheet" />
    <link href="assets/css/login.css" rel="stylesheet" />

    <title><?php echo "LOGIN - Person Management app"; ?></title>
  </head>
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
                    <!-- <img class="logo" src="Img/Permap-logo.png" alt="logo" /> -->
                    <h2 class="heading-2">
                      <!-- <span>PERMAP</span> <br /> -->
                      Person Management App
                    </h2>
                  </div>
                  <h6 class="heading-6 logo-description">
                    Masuk Ke Halaman Administrasi
                  </h6>

                  <form name="login-form" class="login-form" action="action/login-action.php" method="post">
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label"
                        >Email
                        <ion-icon
                          class="form-icon"
                          name="mail-outline"
                        ></ion-icon
                      ></label>

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
                      ></label>
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

                    <?php if(isset($_GET["error"]) && $_GET["error"] == 1){?>
                      <div class="alert alert-danger" role="alert">
                        Sorry, your email address or password is not correct, Please try again!
                      </div>
                      <?php } ?>
                    <button
                      class="btn btn-outline-light login-btn"
                      type="submit"
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
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
