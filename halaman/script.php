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
   } 
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
                      <input type="file" placeholder="Foto Profil" name="fotomurid" class="form-control" onchange="previewImage()" accept="image/*">
                      <span id="user-availability-status" style="font-size:14px;"></span>
                    </div>
                  </div>
                </div>

                <div id="image-preview"></div>
                <br>

              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
                <!-- Button to trigger the file input dialog -->
                <button class="btn btn-primary" type="submit" name="submit">Ganti</button>
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

<!-- Wajib ada inih kalo nga ga ke refresh -->

<style>
    #current-time {
      display: none;
    }
  </style>

<h1 id="current-time"></h1>

<!-- Tambahkan di bagian bawah halaman HTML -->
<script>
    function updateCurrentTime() {
      var currentTime = new Date();
      var hours = currentTime.getHours();
      var minutes = currentTime.getMinutes();
      var seconds = currentTime.getSeconds();

      var formattedTime = padZero(hours) + ":" + padZero(minutes) + ":" + padZero(seconds);

      document.getElementById("current-time").innerText = "Waktu sekarang: " + formattedTime;

      // Auto-refresh pada waktu tertentu
      var refreshTimes = [
        { hour: 5, minute: 0, second: 0 },
        { hour: 12, minute: 0, second: 0 },
        { hour: 16, minute: 0, second: 0 },
        { hour: 20, minute: 41, second: 30 }
      ];

      for (var i = 0; i < refreshTimes.length; i++) {
        var refreshHour = refreshTimes[i].hour;
        var refreshMinute = refreshTimes[i].minute;
        var refreshSecond = refreshTimes[i].second;

        if (hours === refreshHour && minutes === refreshMinute && seconds === refreshSecond) {
          location.reload(true);
          break;
        }
      }
    }

    function padZero(number) {
      return (number < 10 ? '0' : '') + number;
    }

    setInterval(updateCurrentTime, 1000); // Panggil fungsi updateCurrentTime setiap detik
  </script>









    