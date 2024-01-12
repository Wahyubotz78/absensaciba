<?php
   // Code for Add New Sub Admi
  //  if(isset($_POST['submit'])){
  //  $username=$_POST['sadminusername'];
  //  $email=$_POST['emailid'];
  //  $password=md5($_POST['pwd']);
  //  $usertype='0';
  //  $query=mysqli_query($con,"insert into tbladmin(AdminUserName,AdminEmailId,AdminPassword,userType ) values('$username','$email','$password','$usertype')");
  //  if($query){
  //  echo "<script>alert('Sub-admin details added successfully.');</script>";
  //  echo "<script type='text/javascript'> document.location = 'admindata'; </script>";
  //  } else {
  //  echo "<script>alert('Something went wrong. Please try again.');</script>";
  //  }
  //  }
  session_start();
  // Tempatkan baris-baris lainnya yang ingin dijalankan di sini
  // Aktifkan semua jenis kesalahan
error_reporting(E_ALL);
// Tampilkan pesan kesalahan ke layar
ini_set('display_errors', 1);

// Periksa apakah sesi pengguna ada atau tidak
if (!isset($_SESSION['nis'])) {
// Jika tidak ada sesi pengguna, alihkan ke halaman login
header("Location: login");
exit(); // Pastikan untuk menghentikan eksekusi skrip setelah pengalihan header
}

   ?>

<style>
    /* Tambahkan class br-mobile hanya untuk tampilan mobile */
    @media only screen and (max-width: 600px) {
      .br-mobile {
        display: block; /* Munculkan <br> pada tampilan mobile */
      }
    }

    /* Sembunyikan <br> pada tampilan selain mobile */
    @media only screen and (min-width: 601px) {
      .br-mobile {
        display: none;
      }
    }
  </style>

<?php
include '../koneksi.php';
if(isset($_POST['submit']))
   {
   
   $imgfile=$_FILES["fotomurid"]["name"];
   // get the image extension
   $extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
   // allowed extensions
   $allowed_extensions = array(".jpg",".jpeg",".png",".gif");
   // Validation for allowed extensions .in_array() function searches an array for a specific value.
   if(!in_array($extension,$allowed_extensions))
   {
   echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
   }
   else
   {
   //rename the image file
   $imgnewfile=md5($imgfile).$extension;
   // Code for move image into directory
   move_uploaded_file($_FILES["fotomurid"]["tmp_name"],"../fotomurid/".$imgnewfile);
   
   $query=mysqli_query($koneksi,"update datamurid set fotomurid='$imgnewfile' where nis='$_SESSION[nis]'");
   if($query)
   {
    echo '<meta http-equiv="refresh" content="0;url=profile.php">';
   }
   else{
   $error="Something went wrong . Please try again.";
   echo '
        <script>
            alert("Maaf Foto anda terlalu berat");
            window.location.href=profile.php
        </script>';  
   } 
   }
   }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>
    Soft UI Dashboard by Creative Tim
  </title>
  <?php include('link.php');?>
</head>
<?php
        							$tampilPeg    =mysqli_query($koneksi, "SELECT * FROM datamurid WHERE nis='$_SESSION[nis]'");
        							$peg    =mysqli_fetch_array($tampilPeg);
    							?>
<body class="g-sidenav-show bg-gray-100">
<?php
      // Deteksi user agent untuk menentukan apakah pengguna mengakses dari perangkat mobile
      $userAgent = $_SERVER['HTTP_USER_AGENT'];
      $isMobile = false;

      // Daftar kata kunci yang mungkin muncul dalam user agent untuk perangkat mobile
      $mobileKeywords = ['Android', 'iPhone', 'iPad', 'Windows Phone', 'BlackBerry', 'Opera Mini', 'Mobile', 'Tablet'];

      // Periksa apakah ada kata kunci perangkat mobile dalam user agent
      foreach ($mobileKeywords as $keyword) {
          if (stripos($userAgent, $keyword) !== false) {
              $isMobile = true;
              break;
          }
      }

      // Sertakan footer.php hanya jika pengguna mengakses melalui perangkat mobile
      if ($isMobile) {
      }

      else {
        include('sidebar.php');
      }
      ?>
  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
  <?php include('navbar.php');?>
    <div class="container-fluid">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
        <div class="col-auto">
        <div class="avatar avatar-xl position-relative">
            <img src="../fotomurid/<?=$peg['fotomurid']?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">

            <!-- Larger rounded button with camera icon -->
            <button href="#" data-toggle="modal" data-target="#gantippModal" data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true" class="btn btn-sm btn-primary position-absolute top-0 start-0 m-5 rounded-circle p-2">
                <i class="fas fa-camera" style="font-size: 14px;"></i>
            </button>
            </div>
        </div>


          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
              <?=$peg['namalengkap']?>
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
              <?=$peg['jurusan']?>
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-0">
              <ul class="nav nav-pills nav-fill p-1 bg-primary" role="tablist">
                <li class="nav-item">
                  <a href="#" data-toggle="modal" data-target="#logoutModal" class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                  <svg style="color: #FFF ;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
                    <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15zM11 2h.5a.5.5 0 0 1 .5.5V15h-1zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1"/>
                  </svg>
                    <span style="color: #FFF ; vertical-align: middle;" class="ms-1"><strong>Log out</strong></span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12 col-xl-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Platform Settings</h6>
            </div>
            <div class="card-body p-3">
              <h6 class="text-uppercase text-body text-xs font-weight-bolder">Account</h6>
              <ul class="list-group">
                <li class="list-group-item border-0 px-0">
                  <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault" checked>
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault">Email me when someone follows me</label>
                  </div>
                </li>
                <li class="list-group-item border-0 px-0">
                  <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault1">
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault1">Email me when someone answers on my post</label>
                  </div>
                </li>
                <li class="list-group-item border-0 px-0">
                  <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault2" checked>
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault2">Email me when someone mentions me</label>
                  </div>
                </li>
              </ul>
              <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4">Application</h6>
              <ul class="list-group">
                <li class="list-group-item border-0 px-0">
                  <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault3">
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault3">New launches and projects</label>
                  </div>
                </li>
                <li class="list-group-item border-0 px-0">
                  <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault4" checked>
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault4">Monthly product updates</label>
                  </div>
                </li>
                <li class="list-group-item border-0 px-0 pb-0">
                  <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault5">
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault5">Subscribe to newsletter</label>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-12 col-xl-4">
          <br class="br-mobile">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                  <h6 class="mb-0">Profile Information</h6>
                </div>
                <div class="col-md-4 text-end">
                  <a href="javascript:;">
                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                  </a>
                </div>
              </div>
            </div>
            <!-- <div class="card-body p-3">
              <p class="text-sm">
                Hi, I’m Alec Thompson, Decisions: If you can’t decide, the answer is no. If two equally difficult paths, choose the one more painful in the short term (pain avoidance is creating an illusion of equality).
              </p>
              <hr class="horizontal gray-light my-4">
              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; Alec M. Thompson</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; (44) 123 1234 123</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; alecthompson@mail.com</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp; USA</li>
                <li class="list-group-item border-0 ps-0 pb-0">
                  <strong class="text-dark text-sm">Social:</strong> &nbsp;
                  <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-facebook fa-lg"></i>
                  </a>
                  <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-twitter fa-lg"></i>
                  </a>
                  <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-instagram fa-lg"></i>
                  </a>
                </li>
              </ul>
            </div> -->
            <style>
    /* CSS untuk menyembunyikan <br> pada mode mobile */
    @media screen and (max-width: 768px) {
        .mobile-br {
            display: none;
        }
    }
</style>
            <br class="mobile-br">
            <br class="mobile-br">
            <div class="card-header mx-4 p-3 text-center">
                      <div class="icon icon-shape icon-xl shadow text-center border-radius-xl">
<!-- Tambahkan elemen untuk menampilkan QR code -->
<img id="qrCode" src="https://api.qrserver.com/v1/create-qr-code/?data=<?=$peg['nis']?>&size=150x150" alt="QR Code">
                      </div>
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                      <h6 class="text-center mb-0"><?=$peg['nis']?></h6>
                      <span class="text-xs"><?=$peg['jurusan']?></span>
                      <hr class="horizontal dark my-2">
                      <h5 class="mb-0"><?=$peg['namalengkap']?></h5>
                    </div>
          </div>
        </div>
        <div class="col-12 col-xl-4">
        <br class="br-mobile">
        <br class="br-mobile">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Conversations</h6>
            </div>
            <div class="card-body p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                  <div class="avatar me-3">
                    <img src="../assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg shadow">
                  </div>
                  <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Sophie B.</h6>
                    <p class="mb-0 text-xs">Hi! I need more information..</p>
                  </div>
                  <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                  <div class="avatar me-3">
                    <img src="../assets/img/marie.jpg" alt="kal" class="border-radius-lg shadow">
                  </div>
                  <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Anne Marie</h6>
                    <p class="mb-0 text-xs">Awesome work, can you..</p>
                  </div>
                  <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                  <div class="avatar me-3">
                    <img src="../assets/img/ivana-square.jpg" alt="kal" class="border-radius-lg shadow">
                  </div>
                  <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Ivanna</h6>
                    <p class="mb-0 text-xs">About files I can..</p>
                  </div>
                  <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                  <div class="avatar me-3">
                    <img src="../assets/img/team-4.jpg" alt="kal" class="border-radius-lg shadow">
                  </div>
                  <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Peterson</h6>
                    <p class="mb-0 text-xs">Have a great afternoon..</p>
                  </div>
                  <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0">
                  <div class="avatar me-3">
                    <img src="../assets/img/team-3.jpg" alt="kal" class="border-radius-lg shadow">
                  </div>
                  <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Nick Daniel</h6>
                    <p class="mb-0 text-xs">Hi! I need more information..</p>
                  </div>
                  <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-12 mt-4">
        <br class="br-mobile">
        <br class="br-mobile">
          <div class="card mb-4">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-1">Data Diri Murid</h6>
              <p class="text-sm">Berisi data diri murid SMKN 1 Cikarang Barat</p>
            </div>
            <div class="card-body p-3">
              <div class="row">
                <!-- Mulai reservasi -->
<div id="contact-us" class="page-section">
        <div class="container">
          <div id="note"></div>
          <div id="fields">
            <form id="ajax-contact-form" class="form-horizontal clearfix" name="addsuadmin" method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputName2"><strong>NIS Murid</strong></label>
                    <input type="text" placeholder="NIS murid"  name="nis" class="form-control" value="<?=$peg['nis']?>" readonly>
                    <span id="user-availability-status" style="font-size:14px;"></span>
                  </div>
                  <div class="form-group">
                    <label for="inputName2"><strong>Jurusan</strong></label>
                    <input type="text" placeholder="Jurusan murid"  name="jurusan" id="sadminusername" class="form-control" pattern="^[a-zA-Z][a-zA-Z0-9-_.]{5,12}$" title="Username must be alphanumeric 6 to 12 chars" onBlur="checkAvailability()" value="<?=$peg['jurusan']?>" readonly>
                    <span id="user-availability-status" style="font-size:14px;"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputEmail"><strong>Nama Lengkap</strong></label>
                    <input type="text" class="form-control" id="emailid" name="namalengkap" placeholder="Nama lengkap murid" value="<?=$peg['namalengkap']?>" readonly>
                  </div>
                  <?php
        							$tampilPeg    =mysqli_query($koneksi, "SELECT * FROM datamurid WHERE nis='$_SESSION[nis]'");
        							$peg    =mysqli_fetch_array($tampilPeg);
                      $role = $peg['jurusan'];
                      if ($role === 'Admin') {
    							?>
                  <div class="form-group">
                    <label for="inputEmail"><strong>Role</strong></label>
                    <input type="email" class="form-control" id="emailid" name="emailid" placeholder="Masukkan email" value="Admin Absen" readonly>
                  </div>
                      <?php } ?>
                      <?php
        							$tampilPeg    =mysqli_query($koneksi, "SELECT * FROM datamurid WHERE nis='$_SESSION[nis]'");
        							$peg    =mysqli_fetch_array($tampilPeg);
                      $role = $peg['jurusan'];
                      if ($role === 'Guru') {
    							?>
                  <div class="form-group">
                    <label for="inputEmail"><strong>Role</strong></label>
                    <input type="email" class="form-control" id="emailid" name="emailid" placeholder="Masukkan email" value="Guru" readonly>
                  </div>
                  <?php } else { ?>
                      <div class="form-group">
                    <label for="inputEmail"><strong>Role</strong></label>
                    <input type="email" class="form-control" id="emailid" name="emailid" placeholder="Masukkan email" value="Murid" readonly>
                  </div><?php } ?>
                </div>
              </div>
              <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" id="submit" name="submit"><strong></strong>Kirim</button>
            </form>
          </div>
        </div>
      </div>
            <!-- Akhir Reservasi -->
                <!-- <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                  <div class="card card-blog card-plain">
                    <div class="position-relative">
                      <a class="d-block shadow-xl border-radius-xl">
                        <img src="../assets/img/home-decor-1.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                      </a>
                    </div>
                    <div class="card-body px-1 pb-0">
                      <p class="text-gradient text-dark mb-2 text-sm">Project #2</p>
                      <a href="javascript:;">
                        <h5>
                          Modern
                        </h5>
                      </a>
                      <p class="mb-4 text-sm">
                        As Uber works through a huge amount of internal management turmoil.
                      </p>
                      <div class="d-flex align-items-center justify-content-between">
                        <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                        <div class="avatar-group mt-2">
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                            <img alt="Image placeholder" src="../assets/img/team-1.jpg">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                            <img alt="Image placeholder" src="../assets/img/team-2.jpg">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                            <img alt="Image placeholder" src="../assets/img/team-3.jpg">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                            <img alt="Image placeholder" src="../assets/img/team-4.jpg">
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!-- <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                  <div class="card card-blog card-plain">
                    <div class="position-relative">
                      <a class="d-block shadow-xl border-radius-xl">
                        <img src="../assets/img/home-decor-2.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                      </a>
                    </div>
                    <div class="card-body px-1 pb-0">
                      <p class="text-gradient text-dark mb-2 text-sm">Project #1</p>
                      <a href="javascript:;">
                        <h5>
                          Scandinavian
                        </h5>
                      </a>
                      <p class="mb-4 text-sm">
                        Music is something that every person has his or her own specific opinion about.
                      </p>
                      <div class="d-flex align-items-center justify-content-between">
                        <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                        <div class="avatar-group mt-2">
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                            <img alt="Image placeholder" src="../assets/img/team-3.jpg">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                            <img alt="Image placeholder" src="../assets/img/team-4.jpg">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                            <img alt="Image placeholder" src="../assets/img/team-1.jpg">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                            <img alt="Image placeholder" src="../assets/img/team-2.jpg">
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!-- <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                  <div class="card card-blog card-plain">
                    <div class="position-relative">
                      <a class="d-block shadow-xl border-radius-xl">
                        <img src="../assets/img/home-decor-3.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                      </a>
                    </div>
                    <div class="card-body px-1 pb-0">
                      <p class="text-gradient text-dark mb-2 text-sm">Project #3</p>
                      <a href="javascript:;">
                        <h5>
                          Minimalist
                        </h5>
                      </a>
                      <p class="mb-4 text-sm">
                        Different people have different taste, and various types of music.
                      </p>
                      <div class="d-flex align-items-center justify-content-between">
                        <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                        <div class="avatar-group mt-2">
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                            <img alt="Image placeholder" src="../assets/img/team-4.jpg">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                            <img alt="Image placeholder" src="../assets/img/team-3.jpg">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                            <img alt="Image placeholder" src="../assets/img/team-2.jpg">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                            <img alt="Image placeholder" src="../assets/img/team-1.jpg">
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!-- <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                  <div class="card h-100 card-plain border">
                    <div class="card-body d-flex flex-column justify-content-center text-center">
                      <a href="javascript:;">
                        <i class="fa fa-plus text-secondary mb-3"></i>
                        <h5 class=" text-secondary"> New project </h5>
                      </a>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
      // Deteksi user agent untuk menentukan apakah pengguna mengakses dari perangkat mobile
      $userAgent = $_SERVER['HTTP_USER_AGENT'];
      $isMobile = false;

      // Daftar kata kunci yang mungkin muncul dalam user agent untuk perangkat mobile
      $mobileKeywords = ['Android', 'iPhone', 'iPad', 'Windows Phone', 'BlackBerry', 'Opera Mini', 'Mobile', 'Tablet'];

      // Periksa apakah ada kata kunci perangkat mobile dalam user agent
      foreach ($mobileKeywords as $keyword) {
          if (stripos($userAgent, $keyword) !== false) {
              $isMobile = true;
              break;
          }
      }

      // Sertakan footer.php hanya jika pengguna mengakses melalui perangkat mobile
      if ($isMobile) {
        include('footer.php');
      }

      ?>
    </div>
  </div>

  <?php include('script.php');?>
</body>

</html>