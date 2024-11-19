<?php
require_once __DIR__ . '/../../../vendor/autoload.php'; // Atur path sesuai dengan struktur proyek Anda
require_once __DIR__ . '/../../../app/Helpers/jwt_helper.php';
use Workerman\Worker;
use Helpers\jwt_helper;
//use PDO;


// Fungsi untuk menghubungkan ke database
function getDatabaseConnection()
{
    try {
        // Gantilah dengan konfigurasi database Anda
        $host = '127.0.0.1';
        $db = 'db_siap';
        $user = 'root';
        $pass = 'root';
        $charset = 'utf8mb4';

        // Setup DSN (Data Source Name)
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        return new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}


// Membuat server WebSocket pada port 8080
$ws_worker = new Worker("websocket://0.0.0.0:8080");

// Interval pengiriman ping (dalam detik)
$ws_worker->pingInterval = 10;

// Jumlah ping tanpa respons sebelum koneksi diputus
$ws_worker->pingNotResponseLimit = 2;


// Array untuk menyimpan koneksi client yang terhubung
$clients = [];


// Ketika client terhubung ke server
$ws_worker->onConnect = function($connection) use (&$clients) {
   // Memanggil session service CodeIgniter 4
  
  // echo $session->get('token');

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

    
    // }




 // Periksa apakah pesan pertama adalah token
 if (isset($messageData['token'])) {
    $token = $messageData['token'];
    // // Verifikasi token di database
    // $db = getDatabaseConnection();
    // $stmt = $db->prepare("SELECT user_id FROM tb_users WHERE user_id = :token");
    // // Ganti bindParam dengan bindValue
    // $stmt->bindValue(':token', 1, PDO::PARAM_STR); // bindValue digunakan di sini
    // $stmt->execute();
    // $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // if ($user) {
        // Token valid
         // Token valid, simpan koneksi
         //$connection->id = uniqid();
         $connection->id =  $token;//  $user['user_id'];
         $clients[$connection->id] = $connection;
         $connection->send("Token valid. Anda telah terhubung!");
       //  echo "Client terhubung dengan user_id: {$user['user_id']}\n";
         echo "Client terhubung dengan user_id: {$token}\n";
    // } else {
    //     // Token tidak valid, tutup koneksi
    //     $connection->send("Token tidak valid.");
    //     $connection->close();
    // }

 } elseif(isset($messageData['to']) && isset($messageData['message'])){
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
    }elseif(isset($messageData['allMsg'])){
              // Broadcast ke semua client
            foreach ($clients as $client) {
                if ($client !== $connection) {  // Tidak mengirimkan pesan ke client yang mengirim
                    $client->send($messageData['allMsg']);  // Kirim pesan ke client lain
                }
            }
    }
    else {
        // Token belum dikirim, tutup koneksi
        $connection->send("Harap kirimkan token untuk autentikasi.");
        $connection->close();
    }

};

$ws_worker->onClose = function ($connection) use (&$lastResponseTime) {
    unset($lastResponseTime[$connection->id]);
    echo "Connection closed: {$connection->id}\n";
};




// Menjalankan server Workerman
Worker::runAll();
