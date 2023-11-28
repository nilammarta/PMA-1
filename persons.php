<?php 
  $appName = 'Hi, Title';
?>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />

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
      type="image/png"html?search=nilam&page=2fff" />

    <link href="assets/css/general.css" rel="stylesheet" />
    <link href="assets/css/persons.css" rel="stylesheet" />
    <link href="assets/query/query.css" rel="stylesheet" />

    <title><?php 
      echo $appName;
    ?>
    </title>
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
                data-bs-target="#offcanvasScrolling"
                aria-controls="offcanvasScrolling"
              >
                <ion-icon class="icon-menu" name="menu-outline"></ion-icon>
              </button>

              <!-- Side Bar -->
              <div
                class="offcanvas offcanvas-start"
                data-bs-scroll="true"
                data-bs-backdrop="false"
                tabindex="-1"
                id="offcanvasScrolling"
                aria-labelledby="offcanvasScrollingLabel"
              >
                <div class="offcanvas-header">
                  <img
                    class="logo-img"
                    src="assets/img/Permap-logo-2.png"
                    alt="permap logo"
                  />
                  <h5
                    class="offcanvas-title heading-2 m-0"
                    id="offcanvasScrollingLabel"
                  >
                    PERMAP
                  </h5>
                  <button
                    class="btn--close"
                    type="button"
                    data-bs-dismiss="offcanvas"
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
      <section class="main-section d-flex flex-row">
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

        <div class="main-content">
          <div class="persons m-3 m-md-4">
            <nav class="navbar bg-body-tertiary p-0">
              <div class="container-fluid nav p-0">
                <h2 class="heading-2 m-0 p-3">PERSONS</h2>
                <form class="d-sm-flex p-3" role="search">
                  <div class="d-flex mb-2">
                    <label for="search-input"></label>
                    <input
                      id="search-input"
                      class="form-control me-1"
                      type="search"
                      placeholder="Search"
                      aria-label="Search"
                    />
                    <button class="btn btn-search me-2" type="submit">
                      <ion-icon name="search-outline"></ion-icon>
                    </button>
                  </div>

                  <!-- dropdown filter person -->
                  <div class="dropdown me-4">
                    <button
                      class="btn btn-secondary dropdown-toggle btn-dropdown"
                      type="button"
                      data-bs-toggle="dropdown"
                      aria-expanded="false"
                    >
                      Filter Person
                      <ion-icon name="filter"></ion-icon>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Olderly</a></li>
                      <li>
                        <a class="dropdown-item" href="#">Children</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="#">Male</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="#">Female</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="#">Pased Away</a>
                      </li>
                    </ul>
                  </div>
                </form>
              </div>
            </nav>

            <!-- add -->
            <div class="d-flex">
              <button
                class="table-btn btn-primary btn-lg btn-add p-3 mt-5"
                type="button"
              >
                <a
                  href="create.html"
                  class="btn-link d-flex align-items-center"
                  role="button"
                >
                  <ion-icon class="add-icon me-2" name="person-add"></ion-icon>
                  Add
                </a>
              </button>
            </div>

            <!-- table -->
            <div class="table-data mt-4">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Email</th>
                      <th scope="col">Name</th>
                      <th scope="col" colspan="2">Role</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td scope="row">1</td>
                      <td>lalalulu@gmail.com</td>
                      <td>Lala Lulu</td>
                      <td>ADMIN</td>
                      <td>
                        <div class="d-grid gap-2 d-flex justify-content-md-end">
                          <a
                            class="btn btn-outline-light me-md-2 btn-table"
                            type="button"
                            href="view.html"
                            role="button"
                          >
                            <ion-icon
                              class="btn-icon"
                              name="eye-sharp"
                            ></ion-icon>
                          </a>
                          <a
                            class="btn btn-outline-light btn-table"
                            type="button"
                            href="edit.html"
                          >
                            <ion-icon
                              class="btn-icon"
                              name="create-sharp"
                            ></ion-icon>
                          </a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td scope="row">2</td>
                      <td>jacob@gmail.com</td>
                      <td>Thornton Jcob</td>
                      <td>MEMBER</td>
                      <td>
                        <div class="d-grid gap-2 d-flex justify-content-md-end">
                          <a
                            class="btn btn-outline-light me-md-2 btn-table"
                            type="button"
                            href="view.html"
                            role="button"
                          >
                            <ion-icon
                              class="btn-icon"
                              name="eye-sharp"
                            ></ion-icon>
                          </a>
                          <a
                            class="btn btn-outline-light btn-table"
                            type="button"
                            href="edit.html"
                          >
                            <ion-icon
                              class="btn-icon"
                              name="create-sharp"
                            ></ion-icon>
                          </a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td scope="row">3</td>
                      <td>larry@gmail.com</td>
                      <td>Larry Laura</td>
                      <td>MEMBER</td>
                      <td>
                        <div class="d-grid gap-2 d-flex justify-content-md-end">
                          <a
                            class="btn btn-outline-light me-md-2 btn-table"
                            type="button"
                            href="view.html"
                            role="button"
                          >
                            <ion-icon
                              class="btn-icon"
                              name="eye-sharp"
                            ></ion-icon>
                          </a>
                          <a
                            class="btn btn-outline-light btn-table"
                            type="button"
                            href="edit.html"
                          >
                            <ion-icon
                              class="btn-icon"
                              name="create-sharp"
                            ></ion-icon>
                          </a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td scope="row">4</td>
                      <td>yura@gmail.com</td>
                      <td>Yura Lala</td>
                      <td>MEMBER</td>
                      <td>
                        <div class="d-grid gap-2 d-flex justify-content-md-end">
                          <a
                            class="btn btn-outline-light me-md-2 btn-table"
                            type="button"
                            href="view.html"
                            role="button"
                          >
                            <ion-icon
                              class="btn-icon"
                              name="eye-sharp"
                            ></ion-icon>
                          </a>
                          <a
                            class="btn btn-outline-light btn-table"
                            type="button"
                            href="edit.html"
                          >
                            <ion-icon
                              class="btn-icon"
                              name="create-sharp"
                            ></ion-icon>
                          </a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td scope="row">5</td>
                      <td>kuki@gmail.com</td>
                      <td>Kuka Kuki</td>
                      <td>MEMBER</td>
                      <td>
                        <div class="d-grid gap-2 d-flex justify-content-md-end">
                          <a
                            class="btn btn-light me-md-2 btn-table"
                            type="button"
                            href="view.html"
                            role="button"
                          >
                            <ion-icon
                              class="btn-icon"
                              name="eye-sharp"
                            ></ion-icon>
                          </a>
                          <a
                            class="btn btn-light btn-table"
                            type="button"
                            href="edit.html"
                          >
                            <ion-icon
                              class="btn-icon"
                              name="create-sharp"
                            ></ion-icon>
                          </a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td scope="row">6</td>
                      <td>kuki@gmail.com</td>
                      <td>Kuka Kuki</td>
                      <td>MEMBER</td>
                      <td>
                        <div class="d-grid gap-2 d-flex justify-content-md-end">
                          <a
                            class="btn btn-light me-md-2 btn-table"
                            type="button"
                            href="view.html"
                            role="button"
                          >
                            <ion-icon
                              class="btn-icon"
                              name="eye-sharp"
                            ></ion-icon>
                          </a>
                          <a
                            class="btn btn-light btn-table"
                            type="button"
                            href="edit.html"
                          >
                            <ion-icon
                              class="btn-icon"
                              name="create-sharp"
                            ></ion-icon>
                          </a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td scope="row">7</td>
                      <td>kuki@gmail.com</td>
                      <td>Kuka Kuki</td>
                      <td>MEMBER</td>
                      <td>
                        <div class="d-grid gap-2 d-flex justify-content-md-end">
                          <a
                            class="btn btn-light me-md-2 btn-table"
                            type="button"
                            href="view.html"
                            role="button"
                          >
                            <ion-icon
                              class="btn-icon"
                              name="eye-sharp"
                            ></ion-icon>
                          </a>
                          <a
                            class="btn btn-light btn-table"
                            type="button"
                            href="edit.html"
                          >
                            <ion-icon
                              class="btn-icon"
                              name="create-sharp"
                            ></ion-icon>
                          </a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td scope="row">8</td>
                      <td>kuki@gmail.com</td>
                      <td>Kuka Kuki</td>
                      <td>MEMBER</td>
                      <td>
                        <div class="d-grid gap-2 d-flex justify-content-md-end">
                          <a
                            class="btn btn-light me-md-2 btn-table"
                            type="button"
                            href="view.html"
                            role="button"
                          >
                            <ion-icon
                              class="btn-icon"
                              name="eye-sharp"
                            ></ion-icon>
                          </a>
                          <a
                            class="btn btn-light btn-table"
                            type="button"
                            href="edit.html"
                          >
                            <ion-icon
                              class="btn-icon"
                              name="create-sharp"
                            ></ion-icon>
                          </a>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Pagination -->
            <div class="page">
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                  <li class="page-item">
                    <a class="page-link" href="#"
                      ><ion-icon
                        class="page-icon"
                        name="caret-back-outline"
                      ></ion-icon
                    ></a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item" aria-current="page">
                    <a class="page-link" href="#">2</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#"
                      ><ion-icon
                        class="page-icon"
                        name="caret-forward-outline"
                      ></ion-icon
                    ></a>
                  </li>
                </ul>
              </nav>
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
