<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pendaftaran</title>
    <!-- Link ke Bootstrap CSS -->
    <link rel="stylesheet" href="<?=base_url('public/assets/extensions/bootstrap-5.2.3/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('public/assets/extensions/sweetalert2/sweetalert2.min.css')?>"  />
    <link rel="stylesheet" href="<?=base_url('public/assets/extensions/@fortawesome/fontawesome-free/css/all.min.css')?>"  />
    <!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> -->
    <style>
 
 /* .navbar a {
     color: yellow !important;
 } */
 .jumbotron {
     background: url('<?= base_url("public/assets/compiled/jpg/DSC_0490.jpg")?>') no-repeat center center;
     background-size: cover;
     height: 500px;
     color: white;
     text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
     display: flex;
     flex-direction: column;
     justify-content: center;
     align-items: center;
     text-align: center;
     margin-bottom: -120px; /* Remove margin-bottom to avoid extra space */


 }
 .icon{
     font-size: 48px;
     line-height: 1;
     color: #3fbbc0;
 }
 .title{
     font-size: 32px;
     font-weight: bold;
     text-transform: uppercase;
 }
 .facility {
     display: flex;
     align-items: center;
     margin-bottom: 20px;
 }
 .facility-description {
     flex: 1;
 }
 .facility-image {
     flex: 1;
 }
    .small-facility-image {
     max-width: 250px;
     height: auto;
 }
 
    .footer {
     background-color: #f8f9fa;
     padding: 20px 0;
     text-align: center;
 }
</style>
    <?= $this->renderSection('css') ?>
</head>
<body>

<nav class="navbar navbar-expand-lg ">
    <div class="container">
        <a class="navbar-brand" href="#">Hotel Reservation</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="#">Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="#">Reservations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?= $this->renderSection('jombotron') ?>
<div class="jumbotron">
    <h1 class="display-4 fw-bold">Selamat Datang Di Rumah Singgah RSUD AWS Samarinda</h1>
    <p class="lead fw-bold">Reserve your dream room today</p>
</div>

<div class="container wrapper">
    <?= $this->renderSection('content') ?>
</div>
<?= $this->renderSection('content-detail') ?>

<footer class="footer " >
    <div class="container">
        <p>&copy; 2023 Rumah Singgah Alamanda RSUD Abdoel Wahab Sjahranie Samarinda.</p>
    </div>
</footer>

<script src="<?=base_url('public/assets/extensions/jquery/jquery.js')?>  "></script>
<script src="<?=base_url('public/assets/extensions/bootstrap-5.2.3/js/bootstrap.bundle.min.js')?>  "></script>
<script src="<?=base_url('public/assets/extensions/sweetalert2/sweetalert2.min.js')?>"></script>
<script src="<?=base_url('public/assets/extensions/@fortawesome/fontawesome-free/js/all.min.js')?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

<!-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> -->
<script>
        function isValidNIK(nik) {
            // Lakukan validasi NIK di sini
            return nik.length === 16 && !isNaN(nik);
        }

        function isValidEmail(email) {
            // Lakukan validasi email di sini
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailPattern.test(email);
        }

        function isValidPhone(phone) {
            // Lakukan validasi nomor HP dengan kode negara +62
            var phonePattern = /^(?:\+62|0)[0-9]{9,11}$/;
            return phonePattern.test(phone);
        }

        function isValidPassword(password) {
            // Lakukan validasi password di sini
            return password.length >= 6;
        }


        async function isReadyNIK(nik) {
            try {
                const response = await $.ajax({
                    type: "post",
                    url: "<?=base_url('validasinik')?>",
                    data: {
                        nik: nik
                    },
                    dataType: "json"
                });

                return response;
            } catch (error) {
                console.error("Terjadi kesalahan dalam permintaan AJAX:", error);
                return false;
            }
        }

        async function isReadyNohp(nohp) {
            try {
                const response = await $.ajax({
                    type: "post",
                    url: "<?=base_url('validasinohp')?>",
                    data: {
                        nohp:nohp
                    },
                    dataType: "json"
                });

                return response;
            } catch (error) {
                console.error("Terjadi kesalahan dalam permintaan AJAX:", error);
                return false;
            }
        }

        async function isReadyEmail(email) {
            try {
                const response = await $.ajax({
                    type: "post",
                    url: "<?=base_url('validasiemail')?>",
                    data: {
                        email:email
                    },
                    dataType: "json"
                });
                return response;
            } catch (error) {
                console.error("Terjadi kesalahan dalam permintaan AJAX:", error);
                return false;
            }
        }

       

</script>

<?= $this->renderSection('js') ?>
</body>
</html>
