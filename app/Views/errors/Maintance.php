<!doctype html>
<html>
  <head>
    <title>Maintenance Mode</title>
    <meta charset="utf-8"/>
    <meta name="robots" content="noindex"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      body { text-align: center; padding: 20px; font: 20px Helvetica, sans-serif; color: #efe8e8; }
      @media (min-width: 768px){
        body{ padding-top: 150px; }
      }
      h1 { font-size: 50px; }
      article { display: block; text-align: left; max-width: 650px; margin: 0 auto; }
      a { color: #dc8100; text-decoration: none; }
      a:hover { color: #efe8e8; text-decoration: none; }
	    .countdown {
            font-size: 36px;
            font-weight: bold;
        }
    </style>
  </head>
  <body bgcolor="2e2929">
	  <audio autoplay loop>
		<source src="<?=base_url('public/assets/compiled/music/music-maintenance.mp3')?>" type="audio/mpeg" />
	  </audio>
    <article>
        <h1>Kami akan segera kembali!!</h1>
        <div>
            <p>Maaf atas ketidaknyamanan ini, kami sedang melakukan beberapa pemeliharaan saat ini. Jika perlu, Anda dapat menghubungi kami dikeuangan, jika tidak, kami akan segera kembali online!!</p>
            <p>&mdash; The Team</p>
            
        </div>
        <div style="display: flex; flex-direction: row; justify-content: center;">
            <div class="countdown" id="countdown"></div>
        </div>
    </article>
	<script src="<?=base_url('public/assets/extensions/jquery/jquery.min.js')?>"></script>
     <script>
      // Waktu target maintenance (ganti dengan waktu yang sesuai)
var targetDate = new Date('<?=$durasi?>');

var countdown = setInterval(function() {
    var now = new Date().getTime();
    var distance = targetDate - now;
    
    if (distance > 0) {
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        document.getElementById("countdown").innerHTML = days + " Hari " + hours + " Jam " + minutes + " Menit " + seconds + " Detik ";
    } else {
        clearInterval(countdown);
        document.getElementById("countdown").innerHTML = "Maintenance selesai!";
		window.location.href = '<?=base_url('maintenance/durasimaintenance')?>';
    }
}, 1000);
    </script>
  </body>
</html>