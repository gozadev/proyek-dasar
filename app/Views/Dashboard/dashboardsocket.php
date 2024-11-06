<?= $this->extend('Template/main_template'); ?>
<?= $this->section('css'); ?>

<style>

.barcode{
    height: 290px;
}
#qrcode {
      /* Showed when qr code received */
      width: 100%;
}
ul.logs {
      max-height: 290px;
      padding: 15px 15px 15px 30px;
      margin-top: 5px;
      border-radius: 4px;
      overflow-y: auto;
      background: #efefef;
      color: #666;
      font-size: 14px;
}
ul.logs li:first-child {
      color: green;
}
</style>

<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<section class="section">
            
    <div class="card">
        <div class="card-header">
        <h4 class="card-title">Whatsapp</h4>
        </div>
        <div class="card-body row">
           
           <div class="col-5 row justify-content-md-center">
                <div class="col-6 border border-dark barcode justify-content-md-center">
                    <img src="<?=base_url("public/assets/static/images/whatsapp/2.png")?>" alt="QR Code" id="qrcode">
                </div>
           </div>
           <div class="col-3">
            <span>Log</span>
            <ul class="logs"></ul>
           </div>

           <div class="col-4">
            <span>Peringatan :</span>
           </div>
       
               
        </div>
    </div>
</section>

<?= $this->endSection(); ?>
<?= $this->section('js'); ?>
<script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>
<script>
 $(document).ready(function() {
 
    // Kode JavaScript untuk berinteraksi dengan server Socket.IO
    const socket = io('http://localhost:3000', { 
        transports : ['websocket'], 
         });

    if (socket.connected) {
        console.log('konek')
    } else {
        console.log('tidak')
    }

    // // Contoh: Kirim pesan saat tombol diklik
    // function sendMessage() {
    //     const message = document.getElementById('message').value;0
    //     socket.emit('chat message', message);
    // }

    // Event listener untuk menerima pesan dari server
    socket.on('message', (msg) => {
       
		$('.logs').prepend($('<li>').text(msg));
		
    });

    socket.on('qr', function(src) {
		$('#qrcode').attr('src', src);
		$('#qrcode').show();
	});

    socket.on('ready', function(data) {
        $('#qrcode').attr('src', '<?=base_url("public/assets/static/images/whatsapp/cwhatsapp.png")?>');
        $('.logs').prepend($('<li>').text(data));
		//$('#qrcode').hide();
	});

	socket.on('authenticated', function(data) {
        $('#qrcode').attr('src', '<?=base_url("public/assets/static/images/whatsapp/cwhatsapp.png")?>');
        $('.logs').prepend($('<li>').text(data));
		//$('#qrcode').hide();
	});

    socket.on('disconnect', function() {
        $('#qrcode').attr('src', '<?=base_url("public/assets/static/images/whatsapp/2.png")?>');
        console.log('Disconnected from server');
        // Update UI or notify user
       
      });

      socket.on('connect', function(error) {
        $('#qrcode').attr('src', '<?=base_url("public/assets/static/images/whatsapp/1.png")?>');
     
      });

    //   socket.on('reconnect_attempt', function() {
    //     console.log('Attempting to reconnect...');
    //     // Update UI or notify user
    
    //   });

    //   socket.on('reconnect', function(attemptNumber) {
    //     console.log('Reconnected to server on attempt', attemptNumber);
    //     // Update UI or notify user
      
    //   });

    //   socket.on('reconnect_failed', function() {
    //     console.error('Failed to reconnect');
    //     // Update UI or notify user
  
    //   });



});



</script>
<?= $this->endSection(); ?>
