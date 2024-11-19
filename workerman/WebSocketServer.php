<?php
use Workerman\Worker;
use App\Helpers\jwt_helper;
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/Helpers/jwt_helper.php';

// Membuat server WebSocket pada port 8080
$ws_worker = new Worker("websocket://0.0.0.0:8080");

// Array untuk menyimpan koneksi client yang terhubung
$clients = [];


// Ketika client terhubung ke server
$ws_worker->onConnect = function($connection) use (&$clients) {
   

    // // Berikan ID unik untuk setiap koneksi (bisa juga menggunakan autentikasi atau ID lain dari client)
    // $connection->id = uniqid();
    // // Simpan koneksi dalam array dengan ID unik
    // $clients[$connection->id] = $connection;
    // echo "Client terhubung dengan ID: {$connection->id}\n";
};

// Ketika menerima pesan dari client
$ws_worker->onMessage = function($connection, $data) use (&$clients) {
    // // Decode data JSON dari client
     $messageData = json_decode($data, true);

     //print_r($messageData);

    // // Cek apakah client mengirim data yang benar (harus ada 'to' dan 'message')
    // if (isset($messageData['to']) && isset($messageData['message'])) {
    //     $targetId = $messageData['to'];       // ID tujuan pesan
    //     $message = $messageData['message'];   // Pesan yang ingin dikirimkan

    //     // Cek apakah client tujuan ada
    //     if (isset($clients[$targetId])) {
    //         // Kirim pesan ke client tujuan
    //         $clients[$targetId]->send("Pesan dari {$connection->id}: $message");
    //         echo "Pesan dari {$connection->id} ke {$targetId}: $message\n";
    //     } else {
    //         // Client tujuan tidak ditemukan
    //         $connection->send("Client dengan ID $targetId tidak ditemukan.");
    //     }
    // } else {
    //     // Jika data tidak valid, kirim pesan error kembali ke client
    //     // $connection->send("Format pesan tidak valid. Harus ada 'to' dan 'message'.");
    //     // $ws_worker->send($data);
    //     echo "Received: $data\n";

    //       // Broadcast ke semua client
    //         foreach ($clients as $client) {
    //             if ($client !== $connection) {  // Tidak mengirimkan pesan ke client yang mengirim
    //                 $client->send($data);  // Kirim pesan ke client lain
    //             }
    //         }
    // }


 // Periksa apakah pesan pertama adalah token
 if (isset($messageData['token'])) {
    $token = $messageData['token'];
//echo $token;
    // Verifikasi token JWT
   // $jwtHelper = new jwt_helper();



    $isValid = verifyToken($token);

    // Debugging dengan var_dump untuk melihat hasilnya
var_dump($isValid);

    if ($isValid) {
        // Token valid, simpan koneksi
        $connection->id = uniqid();
        $clients[$connection->id] = $connection;
        $connection->send("Token valid. Anda telah terhubung!");
        echo "Client terhubung dengan ID: {$connection->id}\n";
    } else {
        // Token tidak valid, tutup koneksi
        $connection->send("Token tidak valid.");
        $connection->close();
    }
} else {
    // Token belum dikirim, tutup koneksi
    $connection->send("Harap kirimkan token untuk autentikasi.");
    $connection->close();
}


};

// Menjalankan server Workerman
Worker::runAll();
