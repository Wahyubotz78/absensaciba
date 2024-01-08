      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda benar ingin Logout?</h5>
                </div>
                <div class="modal-body">Pilih "Logout" di bawah untuk kembali ke menu awal.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
                    <a class="btn btn-primary" href="logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

<style>
    #image-preview {
      width: 150px;
      height: 150px;
      overflow: hidden;
      border-radius: 10px; /* Corner radius to create rounded edges */
      margin: 10px 0;
      border: 1px solid #ccc; /* Optional: Add a border */
    }
    #image-preview img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  </style>

<?php
if(isset($_POST['upload-pp'])) {
    if(isset($_FILES['foto'])) {
        $foto_name = $_FILES['foto']['name'];
        $foto_size = $_FILES['foto']['size'];
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $foto_type = $_FILES['foto']['type'];

        // Mendapatkan ekstensi file
        $foto_ext = strtolower(pathinfo($foto_name, PATHINFO_EXTENSION));

        // Mengizinkan hanya format gambar tertentu (misalnya: jpg, jpeg, png)
        $allowed_extensions = array("jpg", "jpeg", "png");

        if(in_array($foto_ext, $allowed_extensions)) {
            // Tentukan lokasi penyimpanan file yang di-upload
            $upload_path = "../fotomurid/" . $foto_name;

            // Pindahkan file ke lokasi penyimpanan
            move_uploaded_file($foto_tmp, $upload_path);

            // Cek rasio gambar
            list($width, $height) = getimagesize($upload_path);
            if ($width == $height) {
                // Proses lanjutan sesuai kebutuhan, misalnya menyimpan nama file ke database
                echo "File berhasil di-upload.";
            } else {
                // Hapus file yang di-upload karena tidak memenuhi rasio 1:1
                unlink($upload_path);
                echo "File yang di-upload tidak memenuhi rasio 1:1";
            }
        } else {
            echo "Hanya file gambar dengan format JPG, JPEG, atau PNG yang diizinkan.";
        }
    } else {
      echo "Tidak ada file yang di-upload.";
    }
}
?>



      <!-- Ganti PP Modal-->
      <div class="modal fade" id="gantippModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda benar ingin Ganti Foto Profil?</h5>
                </div>
                <div class="modal-body">
                <form id="ajax-contact-form" class="form-horizontal clearfix" name="addsuadmin" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputName2"><strong>Foto Profil (1:1)</strong></label>
                      <input type="file" placeholder="Foto Profil" name="foto" class="form-control" onchange="previewImage()" accept="image/*">
                      <span id="user-availability-status" style="font-size:14px;"></span>
                    </div>
                  </div>
                </div>

                <div id="image-preview"></div>
                <br>

              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
                <!-- Button to trigger the file input dialog -->
                <button class="btn btn-primary" type="submit" name="upload-pp">Ganti</button>
              </div>
              </form>
                </div>
            </div>
        </div>
    </div>

    <script src="jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script>
    function previewImage() {
      var input = document.querySelector('input[type="file"]');
      var preview = document.getElementById('image-preview');

      // Reset the preview
      preview.innerHTML = '';

      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          var img = document.createElement('img');
          img.src = e.target.result;
          img.alt = 'Preview';
          preview.appendChild(img);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
  
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script>
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Sales",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "#fff",
          data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
          maxBarThickness: 6
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 15,
              font: {
                size: 14,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
              color: "#fff"
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false
            },
            ticks: {
              display: false
            },
          },
        },
      },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "Mobile apps",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#37517e",
            borderWidth: 3,
            backgroundColor: gradientStroke1,
            fill: true,
            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
            maxBarThickness: 6

          },
          {
            label: "Websites",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#3A416F",
            borderWidth: 3,
            backgroundColor: gradientStroke2,
            fill: true,
            data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
            maxBarThickness: 6
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#b2b9bf',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#b2b9bf',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>


    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

    <!-- Ini Script buat si navbar biar ga ancur ditampilan hpnya -->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
    $(document).ready(function () {
        var navbar = $("#navbarBlur");

        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                navbar.addClass("navbar-scrolled");
            } else {
                navbar.removeClass("navbar-scrolled");
            }
        });
    });
</script>

<!-- Script cit anti kejedot -->

<script>
        document.addEventListener('DOMContentLoaded', function () {
            // Cek apakah pengguna menggunakan perangkat mobile
            var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

            if (isMobile) {
                // Tambahkan kelas 'mobile-only' setelah scroll pertama
                window.addEventListener('scroll', function () {
                    if (!document.body.classList.contains('scrolled')) {
                        document.body.classList.add('scrolled');
                        var mobileOnlyElement = document.getElementById('mobileOnlyElement');
                        if (mobileOnlyElement) {
                            mobileOnlyElement.style.display = 'block';
                        }
                    }
                });
            }
        });
    </script>



    