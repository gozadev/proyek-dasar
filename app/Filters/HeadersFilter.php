<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class HeadersFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Tidak ada aksi sebelum request
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
   
        //Memastikan bahwa browser hanya berkomunikasi dengan server melalui HTTPS. Ini melindungi dari serangan man-in-the-middle (MitM).
            //max-age=31536000 berarti 1 tahun.
            //includeSubDomains memastikan bahwa semua subdomain juga dipaksa menggunakan HTTPS.    
        $response->setHeader('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
       
        //Menghindari MIME type sniffing, di mana browser mencoba menebak jenis file yang dikirim, yang bisa menyebabkan eksekusi konten yang berbahaya.     
        $response->setHeader('X-Content-Type-Options', 'nosniff');
        
        //Mencegah serangan Clickjacking dengan memblokir website untuk dibuka dalam iframe.
            //DENY: Mencegah website ditampilkan di dalam iframe.
            //SAMEORIGIN: Mengizinkan iframe hanya dari domain yang sama.
        $response->setHeader('X-Frame-Options', 'DENY');

        //Mencegah serangan XSS dengan mengatur sumber daya apa saja (seperti JavaScript, CSS, gambar, dll.) yang boleh dimuat oleh browser. Ini salah satu header yang sangat penting untuk keamanan.
            //default-src 'self': Hanya mengizinkan konten dari domain website sendiri.
             //Anda bisa menyesuaikan sesuai kebutuhan, misalnya jika mengizinkan sumber daya dari CDN.
      //  $response->setHeader('Content-Security-Policy', "default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self';");
       
        //Mengaktifkan filter XSS pada browser. Ini adalah mekanisme dasar di beberapa browser untuk mencegah serangan XSS.
        $response->setHeader('X-XSS-Protection', '1; mode=block');
        
        //Mengontrol informasi referrer yang dikirimkan ke website lain, sehingga meminimalkan kebocoran informasi.
            //no-referrer: Tidak mengirimkan referrer sama sekali.
            //strict-origin: Mengirimkan referrer hanya dari origin yang sama dan ketika protokolnya HTTPS.
        $response->setHeader('Referrer-Policy', 'no-referrer');
       
        //Mengontrol izin penggunaan fitur tertentu, seperti akses ke kamera, mikrofon, geolokasi, dll. 
        //Mengatur geolocation dan microphone agar tidak diizinkan sama sekali.      
        $response->setHeader('Permissions-Policy', 'geolocation=(), microphone=()');

      //Mengontrol caching agar informasi sensitif tidak disimpan dalam cache.
        $response->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate'); 
        $response->setHeader('Pragma', 'no-cache');
    }
}
