<?php
include '../koneksi.php';

// buat proses tambah
   if(isset($_POST['submit'])){
   $nis=$_POST['nis'];
   $namalengkap=$_POST['namalengkap'];
   $kelas=$_POST['kelas'];
   $jurusan=$_POST['jurusan'];
   $query=mysqli_query($koneksi,"insert into datamurid(nis,namalengkap,kelas,jurusan) values('$nis','$namalengkap','$kelas','$jurusan')");
   if($query){
   echo "<script>alert('Data Murid telah berhasil di tambahkan.');</script>";
   echo "<script type='text/javascript'> document.location = 'datamurid'; </script>";
   } else {
   echo "<script>alert('Something went wrong. Please try again.');</script>";
   }
   }

// buat proses hapus
// Code for Forever deletionparmdel
if(isset($_POST['hapus'])) {
      $id = $_POST['id'];
      $query = mysqli_query($koneksi, "delete from datamurid where id='$id'");
      echo "<script>alert('Data Murid telah berhasil dihapus.');</script>";
      echo "<script type='text/javascript'> document.location = 'datamurid'; </script>";
  
}

//buat proses edit datajamabsen nya
if(isset($_POST['editdata'])){
  $id = $_POST['id'];
  $nis=$_POST['nis'];
  $namalengkap=$_POST['namalengkap'];
  $kelas=$_POST['kelas'];
  $jurusan=$_POST['jurusan'];
  $query = mysqli_query($koneksi, "UPDATE murid SET nis='$nis', namalengkap='$namalengkap', kelas='$kelas', jurusan='$jurusan' WHERE id='$id'");
  if($query){
  echo "<script>alert('Data Murid telah berhasil di update.');</script>";
  echo "<script type='text/javascript'> document.location = 'datamurid'; </script>";
  } else {
  echo "<script>alert('Something went wrong. Please try again.');</script>";
  }
  }

// ampasnya
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
      display: block;
      /* Munculkan <br> pada tampilan mobile */
    }
  }

  /* Sembunyikan <br> pada tampilan selain mobile */
  @media only screen and (min-width: 601px) {
    .br-mobile {
      display: none;
    }
  }
</style>

<style>
  .zoomable {
    width: 80px
  }

  .zoomable:hover {
    transform: scale(1.5);
    transition: 0.3s ease;
  }

  .propille {
    width: 100%;
    height: 200px;
    /* Atur tinggi sesuai kebutuhan Anda */
    overflow: hidden;
  }

  .propille img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
    /* Menambah sudut melengkung pada gambar */
  }



  .profile-detaille h3 {
    margin: 0;
    font-size: 30px;
  }

  .profile-detaille span {
    font-size: 20px;
    color: #fff;
  }

  .profile-detaille ul {
    margin: 0;
    padding: 0;
    list-style: none;
    font-size: 18px;
    color: #fff;
    margin-top: 10px;
  }

  .profile-detaille li {
    display: inline-block;
    margin-right: 20px;
  }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>
    Data Murid
  </title>
  <?php include('link.php');?>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
</head>

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
    <br>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12 mt-4">
          <br class="br-mobile">
          <br class="br-mobile">
          <!-- Button trigger modal -->


          <!-- Modal -->
          <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Data Murid</h5>

                </div>
                <div class="modal-body">
                  <form name="tambahdatamurid" method="post">
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">NIS</label>
                      <input name="nis" type="text" placeholder="Contoh: 211800756232" class="form-control"
                        id="recipient-name" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Nama Lengkap</label>
                      <input name="namalengkap" type="text" placeholder="Contoh: Rahmat Meguru" class="form-control"
                        id="recipient-name" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Kelas</label>
                      <input name="kelas" type="text" placeholder="Contoh: XII" class="form-control"
                        id="recipient-name" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Jurusan</label>
                      <input name="jurusan" type="text"
                        placeholder="Contoh: Teknik Jaringan Komputer dan Telekomunikasi" class="form-control"
                        id="recipient-name" autocomplete="off">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <button name="submit" type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- CARD BOOTSTRAP -->
          <!-- <div class="card mb-4">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-1">Data Jam Absen Saciba</h6>
              <p class="text-sm">Berisi data jam absen SMKN 1 Cikarang Barat</p>
            </div>
            <div class="card-body p-3"> -->
          <div class="row">
            <!-- Mulai reservasi -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header pb-0 p-4">
                <h5 class="m-0 font-weight-bold text-primary"><b>Data Murid  <i class="fas fa-user-graduate"></i></b></h5>
                <br>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#tambah"><b>Tambah
                    +</b></button>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered text-center" id="mauexport" width="100%"
                    cellspacing="0">
                    <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center"> NIS</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Kelas</th>
                        <th class="text-center">Jurusan</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                          $query = mysqli_query($koneksi, "SELECT * FROM datamurid");
                          $cnt = 1;
                          while ($row = mysqli_fetch_array($query)) {
                          ?>
                      <tr>
                        <th scope="row"><?php echo htmlentities($cnt); ?></th>
                        <td class><?php echo htmlentities($row['nis']); ?></td>
                        <td>
                          <?php
            $fotoPath = htmlentities($row['fotomurid']); // Path foto disimpan di database
            if ($fotoPath) {
                echo '
                <div class="avatar avatar-xl position-relative">
                <img src="../fotomurid/' . $fotoPath . '" alt="profile_image" class="w-100 border-radius-lg shadow-sm zoomable">
                </div>
                ';
            } else {
                echo 'Tidak ada foto';
            }
            ?>
                          <br>
                          <b><?php echo htmlentities($row['namalengkap']); ?></b></td>
                        <td><?php echo htmlentities($row['kelas']); ?></td>
                        <td><?php echo htmlentities($row['jurusan']); ?></td>
                        <td>
                          <a href="#" data-toggle="modal" data-target="#edit_<?php echo htmlentities($row['id']); ?>"
                            class="btn btn-primary"><i class="fas fa-edit"></i></a>
                          &nbsp;<a href="#" data-toggle="modal"
                            data-target="#hapus_<?php echo htmlentities($row['id']); ?>" class="btn btn-danger"> <i
                              class="fas fa-trash"></i></a>
                        </td>
                      </tr>


                      <!-- Modal EDIT-->
                      <div class="modal fade" id="edit_<?php echo htmlentities($row['id']); ?>" tabindex="-1"
                        role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Data Murid</h5>

                            </div>
                            <div class="modal-body">
                              <form name="tambahdatamurid" method="post">
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">NIS</label>
                                  <input name="nis" type="text" placeholder="Contoh: 211800756232"
                                    value="<?php echo htmlentities($row['nis']); ?>" class="form-control"
                                    id="recipient-name" autocomplete="off">
                                </div>
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Nama Lengkap</label>
                                  <input name="namalengkap" type="text" placeholder="Contoh: Rahmat Meguru"
                                    value="<?php echo htmlentities($row['namalengkap']); ?>" class="form-control"
                                    id="recipient-name" autocomplete="off">
                                </div>
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Kelas</label>
                                  <input name="kelas" type="text" placeholder="Contoh: XII"
                                    value="<?php echo htmlentities($row['kelas']); ?>" class="form-control"
                                    id="recipient-name" autocomplete="off">
                                </div>
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Jurusan</label>
                                  <input name="jurusan" type="text"
                                    placeholder="Contoh: Teknik Jaringan Komputer dan Telekomunikasi"
                                    value="<?php echo htmlentities($row['jurusan']); ?>" class="form-control"
                                    id="recipient-name" autocomplete="off">
                                </div>
                                <div class="modal-footer">
                                  <input type="hidden" name="id" value="<?php echo htmlentities($row['id']); ?>">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                  <button name="submit" type="submit" class="btn btn-primary">Edit</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Modal Hapuzzzz-->
                      <div class="modal fade" id="hapus_<?php echo htmlentities($row['id']); ?>" tabindex="-1"
                        role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalScrollableTitle">Hapus Data Ini🧐</h5>

                            </div>
                            <!-- Modal body -->
                            <form method="post">
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-6">
                                    <center>
                                      <div class="propille">
                                        <?php
            $fotoPath = htmlentities($row['fotomurid']); // Path foto disimpan di database
            if ($fotoPath) {
                echo '<img src="../fotomurid/' . $fotoPath . '" alt="Foto Murid">';
            } else {
                echo 'Tidak ada foto';
            }
            ?>
                                        <!-- <img src="../fotomurid/<?php echo htmlentities($row['fotomurid']); ?>" alt="Profile Image"> -->
                                      </div>
                                    </center>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="profile-detaile">
                                      <h5 class="m-0 font-weight-bold text-dark">NIS :</h5>
                                      <h6><b><?php echo htmlentities($row['nis']); ?></b></h6>
                                      <h5 class="m-0 font-weight-bold text-dark">Nama:</h5>
                                      <h6><b><?php echo htmlentities($row['namalengkap']); ?></b></h6>
                                      <h5 class="m-0 font-weight-bold text-dark">Kelas dan Jurusan:</h5>
                                      <h6><b><?php echo htmlentities($row['kelas']); ?>
                                          <?php echo htmlentities($row['jurusan']); ?></b></h6>
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo htmlentities($row['id']); ?>">
                                  </div>
                                </div>
                                <!-- Modal footer -->
                                <br>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                                  <button type="submit" class="btn btn-success btn-user btn-block"
                                    name="hapus">Ya!!!</button>
                                </div>
                              </div>
                            </form>

                          </div>
                        </div>
                      </div>
                </div>

                <?php
                                       $cnt++;
                                        } ?>
                </tbody>
                </table>
              </div>
            </div>
          </div>



        </div>
        <!-- DIV TUTUP CARD BOOTSTRAP -->
        <!-- </div>
          </div> -->
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

  <script>
    $(document).ready(function () {
      $('#mauexport').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'csv', 'excel', 'pdf', 'copy',
        ]
      });
    });
  </script>

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

</body>

</html>