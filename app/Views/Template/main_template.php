<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?=getEnv('app_title')?></title>

    <link
      rel="shortcut icon"
      href="./assets/compiled/svg/favicon.svg"
      type="image/x-icon"
    />
    <link
      rel="shortcut icon"
      href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
      type="image/png"
    />
    <!-- <link
      rel="stylesheet"
      href="<?=base_url('public/assets/extensions/@fortawesome/fontawesome-free/css/all.min.css') ?>"
    /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"/>

    <link rel="stylesheet" href="<?=base_url('public/assets/compiled/css/app.css')?>" />
    <link rel="stylesheet" href="<?=base_url('public/assets/compiled/css/app-dark.css')?>" />
    <link rel="stylesheet" href="<?=base_url('public/assets/compiled/css/iconly.css')?> ">
    <link rel="stylesheet" href="<?=base_url('public/assets/extensions/Checkbox-Tree/css/styles.css')?>" />
    <link rel="stylesheet" href="<?=base_url('public/assets/extensions/sweetalert2/sweetalert2.css')?>" /> 
    <link rel="stylesheet" href="<?=base_url('public/assets/extensions/toastify-js/src/toastify.css')?>" /> 
    <link rel="stylesheet" href="<?=base_url('public/assets/extensions/bootstrap-icons-1110/bootstrap-icons.css')?>" /> 
    <link rel="stylesheet" crossorigin href="<?=base_url('public/assets/compiled/css/table-datatable.css')?>">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> -->


    <!-- <link rel="stylesheet" href="<?=base_url('public/assets/extensions/quill/quill.snow.css')?>"> -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
  
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet" /> -->
    <link href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
   
    <link rel="stylesheet" href="<?=base_url('public/assets/extensions/virtualselect/virtual-select.min.css')?>" /> 
   

    <?= $this->renderSection('css') ?>



  </head>

  <body>
    <script src="<?=base_url('public/assets/static/js/initTheme.js')?>"></script>
    <div id="app">
          <!-- sidebar -->
    <?= $this->include('Template/sidebar') ?>
      <!-- /.sidebar -->

      <div id="main" class="layout-navbar navbar-fixed">
     <!-- Navbar -->
     <?= $this->include('Template/navbar') ?>
    <!-- /.navbar -->

    

        <div id="main-content">
          <div class="page-heading">
          <div class="page-title">
            <div class="row">
              <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?= $this->renderSection('title-content') ?></h3>
                <p class="text-subtitle text-muted">
                 
                </p>
              </div>
              <div class="col-12 col-md-6 order-md-2 order-first">
                <!-- <nav
                  aria-label="breadcrumb"
                  class="breadcrumb-header float-start float-lg-end"
                >
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                    <?= $this->renderSection('breadcrumb') ?>
                    </li>
                  </ol>
                </nav> -->
              </div>
            </div>
          </div>

           
                <?= $this->renderSection('content') ?>
               
              
               
          </div>
        </div>
        <footer>
          <div class="footer clearfix mb-0 text-muted">
            <div class="float-start">
              <p><?=date('Y')?> &copy;<?= getEnv('app_footer') ?></p>
            </div>
            <div class="float-end">
              <!-- <p>
                Crafted with
                <span class="text-danger"
                  ><i class="bi bi-heart-fill icon-mid"></i
                ></span>
                by <a href="https://saugi.me">Saugi</a>
              </p> -->
            </div>
          </div>
        </footer>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-md  modal-dialog-centered" role="document">
        <div class="modal-content rounded-0">
          <div class="modal-body py-0">

            
            <div class="d-block main-content">
              <!-- <img src="<?=base_url('public/assets/static/images/bg/Asset 10.png')?>" height="50" width="450" alt="Image" class="img-fluid" style="background-color: #b2fcff;"> -->
              <div class="content-text p-4">
                
                <h3 class="mb-3">Kontak</h3>
                <span class="fw-bold">Alamat</span>
                <p class="mb-4"> RSUD Abdoel Wahab Sjahranie <br>
                <strong>(Ruangxxxxxx)</strong> <br>
                Jl. Palang Merah Indonesia No. 1 Samarinda, Kaltim 75123</p>

                <span class="fw-bold">Kontak Person</span>
                <div class="mb-3">
                  <ul>
                    <li><span class="bi bi-person-badge-fill"></span> xxxx</li>
                    <li><span class="bi bi-whatsapp"></span> 0838678xxxx</li>
                    <li><span class="bi bi-envelope-fill"></span>xxxx@gmail.com</li>
                  </ul>
                  <ul class="mt-3">
                    <li><span class="bi bi-person-badge-fill"></span> xxxx</li>
                    <li><span class="bi bi-whatsapp"></span> 0857xxxxxx</li>
                    <li><span class="bi bi-envelope-fill"></span> xxxxx@gmail.com</li>
                  </ul>
                </div>
                
                <div class="">
                  <div class="mb-5">
                  <button type="button" class="btn btn-secondary float-end mb-3" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

  

    <script src="<?=base_url('public/assets/extensions/jquery/jquery.min.js')?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="<?=base_url('public/assets/static/js/components/dark.js')?> "></script>
  
    <script src="<?=base_url('public/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js')?> "></script>
    <script src="<?=base_url('public/assets/compiled/js/app.js')?> "></script>
   

    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>

    <script src="<?=base_url('public/assets/extensions/Checkbox-Tree/js/jquery-checktree.js')?>"></script>
    <script src="<?=base_url('public/assets/extensions/sweetalert2/sweetalert2.all.min.js')?>"></script>
    <script src="<?=base_url('public/assets/extensions/toastify-js/src/toastify.js')?>"></script>
    <script src="<?= base_url('public/assets/extensions/loading/loadingoverlay.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/extensions/jquery-mask/jquery.mask.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/extensions/virtualselect/virtual-select.js') ?>"></script>
    
    <!-- Quill.js core -->
<!-- <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script> -->
 <!-- Include the Quill library -->
<!-- <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script> -->

    <!-- <script src="https://unpkg.com/html5-qrcode" type="text/javascript"> </script>
    <script src="https://cdn.jsdelivr.net/npm/quagga/dist/quagga.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
    <script>
      $(document).ready(function () {
        

        $(document).on("click", ".video-tutor", function () {
            $('#frame-video').attr('src','https://www.youtube.com/embed/a_4AhZm_3Js')
            $('#myModalView').modal('show');
          });

          $(function(){
            $('.modal').on('hidden.bs.modal', function (e) {
              $iframe = $(this).find("iframe");
              $iframe.attr("src", $iframe.attr("src"));
            });
          });
      });
        
</script>
  <script >
   

    $.LoadingOverlaySetup({
          background      : "rgba(0, 0, 0, 0.5)",
          image       :"<?= base_url('public/assets/compiled/gif/loading.gif') ?>", 
          imageAnimation  : false
      });
      
      function isValidPassword(password) {
            // Lakukan validasi password di sini
            return password.length >= 6;
        }

        async function isReadyUser(username,iduser) {
            try {
                const response = await $.ajax({
                    type: "post",
                    url: "<?=base_url('user/cekusername')?>",
                    data: {
                      username:username,
                      iduser:iduser
                    },
                    dataType: "json"
                });
                return response;
            } catch (error) {
                console.error("Terjadi kesalahan dalam permintaan AJAX:", error);
                return false;
            }
        }

        function getMonthName(dateString) {
            // Parsing tanggal dari string
            var date = new Date(dateString + "-01");

            // Daftar nama bulan
            var monthNames = [
                "Januari", "Februari", "Maret",
                "April", "Mei", "Juni", "Juli",
                "Agustus", "September", "Oktober",
                "November", "Desember"
            ];

            // Mendapatkan indeks bulan dari tanggal
            var monthIndex = date.getMonth();

            // Mengembalikan nama bulan
            return monthNames[monthIndex];
        }

        /* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}

function ubahFormatTanggal(tanggalJavaScript) {
    // Parse tanggal
    var tanggal = new Date(tanggalJavaScript);

    // Ambil komponen tanggal, bulan, dan tahun
    var dd = tanggal.getDate();
    var mm = tanggal.getMonth() + 1; // JavaScript months are zero-based
    var yyyy = tanggal.getFullYear();

    // Pastikan dd dan mm selalu dua digit
    if (dd < 10) {
        dd = '0' + dd;
    }

    if (mm < 10) {
        mm = '0' + mm;
    }

    // Format ulang ke DD-MM-YYYY
    var tanggalFormatBaru = dd + '-' + mm + '-' + yyyy;

    // Mengembalikan tanggal dalam format yang diinginkan
    return tanggalFormatBaru;
}

    </script>
    <!-- <script>
        var conn = new WebSocket('ws://localhost:8080');
          conn.onopen = function(e) {
             // console.log("Connection established!");
          };

          conn.onmessage = function(e) {
             // console.log(e.data);
          };
    </script> -->

    <?= $this->renderSection('js') ?>
    <script>
      <?= session()->get('info') ?>
      <?= session()->get('log') ?>
    </script>
  </body>
</html>
