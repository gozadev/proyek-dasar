<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Tidak Memiliki Akses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="card shadow p-4 text-center" style="max-width: 400px;">
        <div class="card-body">
            <h1 class="display-4 text-danger mb-4"><i class="bi bi-lock-fill"></i></h1>
            <h2 class="h4">Tidak ada akses</h2>
            <p class="mb-4">Akun Anda belum memiliki akses ke menu halaman yang Anda inginkan silahkan hubungi administrator </p>

            <a href="<?=base_url('logout') ?>" class="btn btn-primary">Keluar</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
