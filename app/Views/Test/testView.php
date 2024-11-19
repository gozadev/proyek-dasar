
<?= $this->extend("Template/main_template"); ?>





<?= $this->section("content"); ?>

<section class="section">

                    
<?= $this->endSection(); ?>
<?= $this->section("js"); ?>
<script>

// const ws = new WebSocket(`ws://localhost:8080`);
// const reconnectInterval = 60000; // Interval reconnect dalam milidetik (2 menit)

// //const ws = new WebSocket('ws://localhost:8080');

// ws.onopen = () => {
//     console.log('Connected to WebSocket server');
//     ws.send(JSON.stringify({ token: Math.floor(Math.random() * 10) }));
    
// };

// ws.onmessage = (event) => {
//     console.log('Message:', event.data);
// };

// // Ketika koneksi ditutup
// ws.onclose = () => {
//         console.log("WebSocket disconnected. Trying to reconnect in 2 minutes...");
//         // Tunggu 2 menit sebelum mencoba reconnect
//         setTimeout(connectWebSocket, reconnectInterval);
//     };

//     // Ketika ada error dalam koneksi
//     ws.onerror = (error) => {
//         console.error("WebSocket error:", error);
//         ws.close(); // Pastikan koneksi ditutup sebelum mencoba reconnect
//     };

let ws; // Variabel untuk menyimpan koneksi WebSocket
const reconnectInterval = 10000; // Interval reconnect dalam milidetik (2 menit)

function connectWebSocket() {
    // Buat koneksi WebSocket
    ws = new WebSocket("ws://localhost:8080");

    // Ketika koneksi berhasil
    ws.onopen = () => {
        console.log("Connected to WebSocket server");
        // Kirim pesan ke server jika perlu
        ws.send(JSON.stringify({ token: Math.floor(Math.random() * 10) }));
    };

    // Ketika pesan diterima dari server
    ws.onmessage = (event) => {
        console.log("Message from server:", event.data);
    };

    // Ketika koneksi ditutup
    ws.onclose = () => {
        console.log("WebSocket disconnected. Trying to reconnect in 2 minutes...");
        // Tunggu 2 menit sebelum mencoba reconnect
        setTimeout(connectWebSocket, reconnectInterval);
    };

    // Ketika ada error dalam koneksi
    ws.onerror = (error) => {
        console.error("WebSocket error:", error);
        ws.close(); // Pastikan koneksi ditutup sebelum mencoba reconnect
    };
}

// Mulai koneksi WebSocket pertama kali
connectWebSocket();


// Fungsi untuk mengirim pesan ke client lain
function kirimPesan(idTujuan, pesan) {
    const data = JSON.stringify({
        to: idTujuan,         // ID client tujuan
        message: pesan        // Pesan yang ingin dikirim
    });
    ws.send(data);
}


</script>
<?= $this->endSection(); ?>


