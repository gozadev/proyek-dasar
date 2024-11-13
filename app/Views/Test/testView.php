
<?= $this->extend("Template/main_template"); ?>





<?= $this->section("content"); ?>

<section class="section">

                    
<?= $this->endSection(); ?>
<?= $this->section("js"); ?>
<script>

const ws = new WebSocket('ws://localhost:8080');

ws.onopen = () => {
    console.log('Connected to WebSocket server');
    ws.send('Hello server');
};

ws.onmessage = (event) => {
    console.log('Message:', event.data);
};

ws.onclose = () => {
    console.log('Disconnected from WebSocket server');
};

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


