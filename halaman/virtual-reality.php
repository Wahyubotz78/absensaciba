<!DOCTYPE html>
<html lang="en">

<head>
  <title>
    Soft UI Dashboard by Creative Tim
  </title>
  <?php include('link.php');?>
</head>

<body class="g-sidenav-show  bg-gray-100 virtual-reality">
  <div>
  <?php include('navbar.php');?>
  </div>
  <div class="border-radius-xl mt-3 mx-3 position-relative" style="background-image: url('../assets/img/vr-bg.jpg') ; background-size: cover;">
  <?php include('sidebar.php');?>
    <main class="main-content mt-1 border-radius-lg">
      <div class="section min-vh-85 position-relative transform-scale-0 transform-scale-md-7">
        <div class="container">
          <div class="row pt-10">
            <div class="col-lg-1 col-md-1 pt-5 pt-lg-0 ms-lg-5 text-center">
              <a href="javascript:;" class="avatar avatar-md border-0" data-bs-toggle="tooltip" data-bs-placement="left" title="My Profile">
                <img class="border-radius-lg" alt="Image placeholder" src="../assets/img/team-1.jpg">
              </a>
              <button class="btn btn-white border-radius-lg p-2 mt-2" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Home">
                <i class="fas fa-home p-2"></i>
              </button>
              <button class="btn btn-white border-radius-lg p-2" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Search">
                <i class="fas fa-search p-2"></i>
              </button>
              <button class="btn btn-white border-radius-lg p-2" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Minimize">
                <i class="fas fa-ellipsis-h p-2"></i>
              </button>
            </div>
            <div class="col-lg-8 col-md-11">
              <div class="d-flex">
                <div class="me-auto">
                  <h1 class="display-1 font-weight-bold mt-n4 mb-0">28°C</h1>
                  <h6 class="text-uppercase mb-0 ms-1">Cloudy</h6>
                </div>
                <div class="ms-auto">
                  <img class="w-50 float-end mt-lg-n4" src="../assets/img/small-logos/icon-sun-cloud.png" alt="image sun">
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-lg-4 col-md-4">
                  <div class="card move-on-hover overflow-hidden">
                    <div class="card-body">
                      <div class="d-flex">
                        <h6 class="mb-0 me-3">08:00</h6>
                        <h6 class="mb-0">Synk up with Mark
                          <small class="text-secondary font-weight-normal">Hangouts</small>
                        </h6>
                      </div>
                      <hr class="horizontal dark">
                      <div class="d-flex">
                        <h6 class="mb-0 me-3">09:30</h6>
                        <h6 class="mb-0">Gym <br />
                          <small class="text-secondary font-weight-normal">World Class</small>
                        </h6>
                      </div>
                      <hr class="horizontal dark">
                      <div class="d-flex">
                        <h6 class="mb-0 me-3">11:00</h6>
                        <h6 class="mb-0">Design Review<br />
                          <small class="text-secondary font-weight-normal">Zoom</small>
                        </h6>
                      </div>
                    </div>
                    <a href="javascript:;" class="bg-gray-100 w-100 text-center py-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Show More">
                      <i class="fas fa-chevron-down text-primary"></i>
                    </a>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 mt-4 mt-sm-0">
                  <div class="card bg-gradient-dark move-on-hover">
                    <div class="card-body">
                      <div class="d-flex">
                        <h5 class="mb-0 text-white">To Do</h5>
                        <div class="ms-auto">
                          <h1 class="text-white text-end mb-0 mt-n2">7</h1>
                          <p class="text-sm mb-0 text-white">items</p>
                        </div>
                      </div>
                      <p class="text-white mb-0">Shopping</p>
                      <p class="mb-0 text-white">Meeting</p>
                    </div>
                    <a href="javascript:;" class="w-100 text-center py-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Show More">
                      <i class="fas fa-chevron-down text-white"></i>
                    </a>
                  </div>
                  <div class="card move-on-hover mt-4">
                    <div class="card-body">
                      <div class="d-flex">
                        <p class="mb-0">Emails (21)</p>
                        <a href="javascript:;" class="ms-auto" data-bs-toggle="tooltip" data-bs-placement="top" title="Check your emails">
                          Check
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 mt-4 mt-sm-0">
                  <div class="card card-background card-background-mask-primary move-on-hover align-items-start">
                    <div class="cursor-pointer">
                      <div class="full-background" style="background-image: url('../assets/img/curved-images/curved1.jpg')"></div>
                      <div class="card-body">
                        <h5 class="text-white mb-0">Some Kind Of Blues</h5>
                        <p class="text-white text-sm">Deftones</p>
                        <div class="d-flex mt-5">
                          <button class="btn btn-outline-white rounded-circle p-2 mb-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Prev">
                            <i class="fas fa-backward p-2"></i>
                          </button>
                          <button class="btn btn-outline-white rounded-circle p-2 mx-2 mb-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Pause">
                            <i class="fas fa-play p-2"></i>
                          </button>
                          <button class="btn btn-outline-white rounded-circle p-2 mb-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Next">
                            <i class="fas fa-forward p-2"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card move-on-hover mt-4">
                    <div class="card-body">
                      <div class="d-flex">
                        <p class="my-auto">Messages</p>
                        <div class="ms-auto">
                          <div class="avatar-group">
                            <a href="javascript:;" class="avatar avatar-sm border-0 rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="2 New Messages">
                              <img alt="Image placeholder" src="../assets/img/team-1.jpg">
                            </a>
                            <a href="javascript:;" class="avatar avatar-sm border-0 rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="1 New Message">
                              <img alt="Image placeholder" src="../assets/img/team-2.jpg">
                            </a>
                            <a href="javascript:;" class="avatar avatar-sm border-0 rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="13 New Messages">
                              <img alt="Image placeholder" src="../assets/img/team-3.jpg">
                            </a>
                            <a href="javascript:;" class="avatar avatar-sm border-0 rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="7 New Messages">
                              <img alt="Image placeholder" src="../assets/img/team-4.jpg">
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
  <?php include('footer.php');?>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg ">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Soft UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3">
          <h6 class="mb-0">Navbar Fixed</h6>
        </div>
        <div class="form-check form-switch ps-0">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
        </div>
        <hr class="horizontal dark my-sm-4">
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/soft-ui-dashboard">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/soft-ui-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/soft-ui-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/soft-ui-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Soft%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
  <?php include('script.php');?>
</body>

</html>