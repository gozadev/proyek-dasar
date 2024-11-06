<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Terkunci</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="card shadow p-4 text-center" style="max-width: 400px;">
        <div class="card-body">
            <h1 class="display-4 text-danger mb-4"><i class="bi bi-lock-fill"></i></h1>
            <h2 class="h4">Akun Anda Terkunci</h2>
            <p class="mb-4">Akun Anda telah terkunci karena beberapa alasan keamanan. Sampai dengan </p>
            <p class="mb-4 fw-bold"><?=$waktu;?></p>
            <p class="mb-4">Silahkan Coba lagi sampai waktu yang telah ditentukan </p>
            <a href="#" class="btn btn-primary">Hubungi Administrator</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
