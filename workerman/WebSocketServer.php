<?php
use Workerman\Worker;

require_once __DIR__ . '/../vendor/autoload.php';


// Membuat server WebSocket pada port 8080
$ws_worker = new Worker("websocket://0.0.0.0:8080");

// Array untuk menyimpan koneksi client yang terhubung
$clients = [];

// Ketika client terhubung ke server
$ws_worker->onConnect = function($connection) use (&$clients) {
    // Berikan ID unik untuk setiap koneksi (bisa juga menggunakan autentikasi atau ID lain dari client)
    $connection->id = uniqid();
    
    // Simpan koneksi dalam array dengan ID unik
    $clients[$connection->id] = $connection;

    echo "Client terhubung dengan ID: {$connection->id}\n";
};

// Menangani koneksi
// $ws_worker->onMessage = function($connection, $data) {
//     // Mengirim pesan kembali kepada client
//     $connection->send('Hello from Workerman: ' . $data);
// };

// Ketika menerima pesan dari client
$ws_worker->onMessage = function($connection, $data) use (&$clients) {
    // Decode data JSON dari client
    $messageData = json_decode($data, true);

    // Cek apakah client mengirim data yang benar (harus ada 'to' dan 'message')
    if (isset($messageData['to']) && isset($messageData['message'])) {
        $targetId = $messageData['to'];       // ID tujuan pesan
        $message = $messageData['message'];   // Pesan yang ingin dikirimkan

        // Cek apakah client tujuan ada
        if (isset($clients[$targetId])) {
            // Kirim pesan ke client tujuan
            $clients[$targetId]->send("Pesan dari {$connection->id}: $message");
            echo "Pesan dari {$connection->id} ke {$targetId}: $message\n";
        } else {
            // Client tujuan tidak ditemukan
            $connection->send("Client dengan ID $targetId tidak ditemukan.");
        }
    } else {
        // Jika data tidak valid, kirim pesan error kembali ke client
        $connection->send("Format pesan tidak valid. Harus ada 'to' dan 'message'.");
    }
};

// Menjalankan server Workerman
Worker::runAll();
