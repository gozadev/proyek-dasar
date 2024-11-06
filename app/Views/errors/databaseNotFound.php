<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Database CI4</title>
    <!-- Tautan ke Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Pengaturan Database CodeIgniter 4</h2>
        <div class="alert alert-info" role="alert">
            Untuk mengonfigurasi database Anda, silakan lakukan langkah-langkah berikut:
        </div>
        <p>1. Buka file <code>.env</code> yang terletak di direktori root proyek CodeIgniter 4 Anda.</p>
        <p>2. Temukan bagian konfigurasi database, biasanya ditandai dengan <code># Database</code>.</p>
        <p>3. Edit konfigurasi database Anda seperti berikut:</p>
        <pre><code>
      # Database
      database.default.hostname = hostname_yang_anda_gunakan
      database.default.database = nama_database_anda
      database.default.username = nama_pengguna_anda
      database.default.password = password_anda
      database.default.DBDriver = MySQLi
      database.default.port = port_yang_anda_gunakan
        </code></pre>
        <p>4. Simpan file <code>.env</code> setelah Anda selesai mengedit.</p>
        <p>5. Jalankan migrate buka terminal di dalam folder projek kemudian jalankan perintah berikut:</p> <code>php spark migrate</code> </p>
        <p>6. Jalankan seed Buka terminal di dalam folder projek kemudian jalankan perintah berikut:</p> <code>php spark db:seed DataSeeder</code> </p>
        <div class="alert alert-success" role="alert">
            Setelah melakukan perubahan, Anda dapat memeriksa apakah konfigurasi berhasil dengan menjalankan aplikasi CodeIgniter 4 Anda.
        </div>
        <a href="<?=base_url()?>" class="btn btn-primary">Kembali ke Halaman Utama</a>
    </div>

    <!-- Tautan ke jQuery, Bootstrap JS dan dependensinya (Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
