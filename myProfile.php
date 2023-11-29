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
    <link href="assets/query/query.css" rel="stylesheet" />
    <link href="assets/css/create.css" rel="stylesheet" />

    <title>MY PROFIL - Person Management App</title>
  </head>
  <body>
    <header class="header-section">
      <div class="header">
        <div class="d-flex justify-content-between align-items-center">
          <div class="logo-box d-flex align-items-center gap-2">
            <img
              class="logo-img"
              src="assets/img/Permap-logo-2.png"
              alt="permap logo"
            />
            <h5 class="heading-2 logo-text m-0">PERMAP</h5>
          </div>

          <div class="d-flex justify-content-end align-items-center">
            <div class="d-lg-none">
              <button
                class="btn btn-menu p-0"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#staticBackdrop"
                aria-controls="staticBackdrop"
              >
                <ion-icon class="icon-menu" name="menu-outline"></ion-icon>
              </button>

              <!-- Side Bar -->
              <div
                class="offcanvas offcanvas-start"
                data-bs-backdrop="static"
                tabindex="-1"
                id="staticBackdrop"
                aria-labelledby="staticBackdropLabel"
              >
                <div class="offcanvas-header">
                  <img
                    class="logo-img"
                    src="assets/img/Permap-logo-2.png"
                    alt="permap logo"
                  />
                  <h5
                    class="offcanvas-title heading-2 m-0"
                    id="staticBackdropLabel"
                  >
                    PERMAP
                  </h5>
                  <button
                    class="btn--close"
                    type="button"
                    data-bs-dismiss="offcanvas"
                    aria-label="Close"
                  >
                    <ion-icon class="icon-header" name="close"></ion-icon>
                  </button>
                </div>
                <div class="offcanvas-body d-flex flex-column gap-4">
                  <nav class="main-nav">
                    <ul class="main-nav-list">
                      <li class="nav-item">
                        <a class="main-nav-link" href="dashboard.html"
                          ><ion-icon
                            name="file-tray-full-outline"
                            class="nav-icon"
                          ></ion-icon>
                          Dashboard</a
                        >
                      </li>
                      <li class="nav-item nav-open">
                        <a class="main-nav-link" href="persons.html"
                          ><ion-icon
                            name="people-outline"
                            class="nav-icon"
                          ></ion-icon>
                          Persons</a
                        >
                      </li>
                    </ul>
                  </nav>

                  <div class="profile">
                    <h6 class="heading-6 sub-heading m-0">Account</h6>
                    <nav class="main-nav">
                      <ul class="main-nav-list">
                        <li class="nav-item">
                          <a class="main-nav-link" href="myProfil.html"
                            ><ion-icon
                              name="person-circle-outline"
                              class="nav-icon"
                            ></ion-icon>
                            My Profile</a
                          >
                        </li>
                        <li class="nav-item">
                          <a class="main-nav-link cta" href="#"
                            ><ion-icon
                              name="log-out-outline"
                              class="nav-icon"
                            ></ion-icon>
                            Logout</a
                          >
                        </li>
                      </ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div>

            <div class="user-box">
              <ion-icon
                class="user-icon btn-header"
                name="person-circle-outline"
              ></ion-icon>
            </div>
            <div class="d-none d-lg-block">
              <div class="user-email btn-header">lalagemoy@gmail.com</div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <main>
      <sction class="main-section d-flex flex-row">
        <div class="sidebar d-none d-lg-flex flex-column gap-5">
          <div class="sidebar-content">
            <nav class="main-nav">
              <ul class="main-nav-list">
                <li class="nav-item">
                  <a class="main-nav-link" href="dashboard.html"
                    ><ion-icon
                      name="file-tray-full-outline"
                      class="nav-icon"
                    ></ion-icon>
                    Dashboard</a
                  >
                </li>
                <li class="nav-item">
                  <a class="main-nav-link" href="persons.html"
                    ><ion-icon
                      name="people-outline"
                      class="nav-icon"
                    ></ion-icon>
                    Persons</a
                  >
                </li>
              </ul>
            </nav>

            <div class="profile">
              <h6 class="heading-6 sub-heading m-0">Account</h6>
              <nav class="main-nav">
                <ul class="main-nav-list">
                  <li class="nav-item nav-open">
                    <a class="main-nav-link" href="myProfil.html"
                      ><ion-icon
                        name="person-circle-outline"
                        class="nav-icon"
                      ></ion-icon>
                      My Profile</a
                    >
                  </li>
                  <li class="nav-item">
                    <a class="main-nav-link cta" href="#"
                      ><ion-icon
                        name="log-out-outline"
                        class="nav-icon"
                      ></ion-icon>
                      Logout</a
                    >
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        <div class="main-content">
          <div class="profile m-3 m-md-4">
            <div class="content-title">
              <h2 class="heading-2 m-0 p-3">MY PROFILE</h2>
            </div>

            <div class="row justify-content-center">
              <div class="col-12 col-md-10 col-lg-11 col-xxl-7">
                <form class="create-form needs-validation p-4 mb-5">
                  <h5 class="form-text pb-2 mb-4">EDIT PROFILE</h5>

                  <div class="mb-3 row">
                    <label
                      for="inputFistname"
                      class="col-sm-2 col-form-label form-label"
                      >Fist name</label
                    >
                    <div class="col-sm-10">
                      <input
                        type="text"
                        class="form-control"
                        id="inputFistname"
                        value="Lala"
                      />
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
                        type="text"
                        class="form-control"
                        id="inputLastname"
                        value="Lulu"
                      />
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label
                      for="inputNIK"
                      class="col-sm-2 col-form-label form-label"
                      >NIK</label
                    >
                    <div class="col-sm-10">
                      <input
                        type="number"
                        class="form-control"
                        id="inputNIK"
                        value="1001253789231003"
                      />
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label
                      for="inputEmail"
                      class="col-sm-2 col-form-label form-label"
                      >Email</label
                    >
                    <div class="col-sm-10">
                      <input
                        type="email"
                        class="form-control"
                        id="inputEmail"
                        value="lalagemoy@gmail.com"
                      />
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label
                      for="inputBirthdate"
                      class="col-sm-2 col-form-label form-label"
                      >Birth date</label
                    >
                    <div class="col-sm-10">
                      <input
                        type="date"
                        class="form-control"
                        id="inputBirthdate"
                        value="2001-01-10"
                      />
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label
                      for="inputAddress"
                      class="col-sm-2 col-form-label form-label"
                      >Address</label
                    >
                    <div class="col-sm-10">
                      <input
                        type="text"
                        class="form-control"
                        id="inputAddress"
                        value="Br.Baturiti, Kec.Baturiti, Tabanan-Bali"
                      />
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label
                      for="inputSex"
                      class="col-sm-2 col-form-label form-label"
                      >Sex
                    </label>
                    <div class="col-sm-10">
                      <select
                        id="inputSex"
                        class="form-select"
                        aria-label="Default select example"
                        aria-valuetext="Female"
                        required
                      >
                        <option class="option-value" value="1">Female</option>
                        <option class="option-value" value="2">Male</option>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label"
                      >Internal notes</label
                    >
                    <textarea
                      class="form-control"
                      id="exampleFormControlTextarea1"
                      rows="3"
                    >
coba</textarea
                    >
                  </div>

                  <div class="row justify-content-center mt-5">
                    <div class="col-12">
                      <div class="btn-create">
                        <button
                          type="submit"
                          class="btn btn-primary btn-save me-3"
                        >
                          Save
                        </button>
                        <button
                          type="reset"
                          class="btn btn-secondary btn-cancel"
                        >
                          Cancel
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </sction>
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
