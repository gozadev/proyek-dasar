<?php
namespace App\Libraries;

use CodeIgniter\Session\Session;

class Captcha {
  private $session;
  private $length = 6; // Jumlah karakter
  private $capW = 150; // Lebar captcha
  private $capH = 80; // Tinggi captcha
  private $capB = 'public/assets/compiled/jpg/CapBack.jpg'; // Gambar latar belakang

  public function __construct(Session $session) {
    $this->session = $session;
  }

//   public function prime(): void {
//     $char = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
//     $max = strlen($char) - 1;
//     $captchaString = "";
//     for ($i = 0; $i < $this->length; $i++) { 
//       $captchaString .= substr($char, rand(0, $max), 1); 
//     }
//     $this->session->set('captcha', $captchaString);
//   }

  public function draw($mode = 1): void {
    // Jika captcha belum diset, keluar
    // if (!$this->session->has('captcha')) { 
    //   exit("Captcha not primed"); 
    // }

    // Menghancurkan session captcha jika sudah ada
    if ($this->session->has('captcha')) {
        $this->session->remove('captcha');
    }

    $char = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $max = strlen($char) - 1;
    $captchaString = "";
    for ($i = 0; $i < $this->length; $i++) { 
      $captchaString .= substr($char, rand(0, $max), 1); 
    }

    $captcha = imagecreatetruecolor($this->capW, $this->capH);

    // Cek apakah file gambar background ada
    $backgroundPath = FCPATH . $this->capB;
    if (!file_exists($backgroundPath)) {
        exit("Background image not found.");
    }

    list($bx, $by) = getimagesize($backgroundPath);
    $bx = ($bx - $this->capW) < 0 ? 0 : rand(0, ($bx - $this->capW));
    $by = ($by - $this->capH) < 0 ? 0 : rand(0, ($by - $this->capH));
    imagecopy($captcha, imagecreatefromjpeg($backgroundPath), 0, 0, $bx, $by, $this->capW, $this->capH);

    // Menentukan warna teks
    $textColor = imagecolorallocate($captcha, 255, 255, 255); // Warna putih agar kontras dengan background

    // Menentukan posisi acak untuk teks
    $x = rand(10, $this->capW - 80); // Pastikan teks berada di dalam lebar gambar
    $y = rand(10, $this->capH - 30); // Pastikan teks berada di dalam tinggi gambar

    // Menambah teks dengan ukuran font 5 (terbesar untuk imagestring())
    // imagestring($captcha, 5, $x, $y, $captchaString, $textColor);

    // Menentukan ukuran font
    $fontSize = 20; // Sesuaikan ukuran font sesuai keinginan

    // Menentukan path ke font TrueType yang ada di folder public
    $fontPath = FCPATH . 'public/assets/compiled/fonts/captcha.ttf'; // Ganti dengan path ke font TTF Anda
    $this->session->set('captcha', $captchaString);
    // Menambah teks menggunakan imagettftext
    imagettftext($captcha, $fontSize, rand(-10, 10), 20, 50, $textColor, $fontPath, $captchaString);
    // header("Content-type: image/png");
    // imagepng($captcha); 
    // imagedestroy($captcha);

    // // Jika mode=0, output gambar captcha dengan base64
    if ($mode == 0) {
        ob_start();
        imagepng($captcha);
        $ob = base64_encode(ob_get_clean());
        echo "<img src='data:image/png;base64,$ob'>";
    } else {
        header("Content-type: image/png");
        imagepng($captcha); 
        imagedestroy($captcha);
    }
  }

  public function verify($check) {
    $captchaText = $this->session->get('captcha');
    if (!$captchaText) { 
      exit("Captcha not primed"); 
    }
    if ($check === $captchaText) {
      $this->session->remove('captcha');
      return true;
    } else {
      return false;
    }
  }
}

