<?php
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
//use DateTimeImmutable;
use Lcobucci\JWT\Token\Plain;
use Lcobucci\JWT\Validation\Constraint\SignedWith;




function createToken()
    {
            // Membuat kunci yang cukup panjang (32 byte atau 256-bit)
        // Anda bisa menggunakan kunci rahasia lain yang panjangnya 32 byte
        $secretKey = bin2hex(random_bytes(32)); // Ini menghasilkan 32-byte acak

        // Menampilkan panjang kunci untuk memastikan
       // echo 'Panjang kunci: ' . $secretKey . ' byte'; // Harus 64 karakter atau 32-byte

        // Inisialisasi konfigurasi JWT dengan HMAC-SHA256
        $config = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText('5f21f4a9ee1c79257afe56d1ba315e7c570912611471209bea79638cce94415e') // Ganti dengan kunci yang panjang
        );

        // Data klaim yang ingin ditambahkan ke token
        $now =  new DateTimeImmutable();
        $userId = 1; // Misalnya ID pengguna dari database
        $username = 'user_example'; // Username pengguna

        // Membuat token JWT
        $token = $config->builder()
            ->issuedBy('ci4-websocket')               // Issuer claim (iss)
            ->permittedFor('http://localhost')        // Audience claim (aud)
            ->identifiedBy('4f1g23a12aa', true)       // ID unik token
            ->issuedAt($now)                          // Waktu diterbitkan (iat)
           ->expiresAt($now->modify('+1 hour'))      // Waktu kadaluwarsa (exp)
            ->withClaim('userId', $userId)            // Custom claim: userId
            ->withClaim('username', $username)        // Custom claim: username
            ->getToken($config->signer(), $config->signingKey());

        // Mengembalikan token JWT sebagai respons JSON
   

        return  $token->toString();
    
    }

    function verifyTokenx($jwt)
    {
        try {
            // Inisialisasi konfigurasi JWT dengan HMAC-SHA256
            $config = Configuration::forSymmetricSigner(
                new Sha256(),
                InMemory::plainText('5f21f4a9ee1c79257afe56d1ba315e7c570912611471209bea79638cce94415e') // Ganti dengan kunci yang panjang
            );
    
            // Parse token
            $token = $config->parser()->parse($jwt);
    
            // Verifikasi token
            // Cek apakah token ditandatangani dengan kunci yang benar
            $signer = new Sha256();
            $key = InMemory::plainText('5f21f4a9ee1c79257afe56d1ba315e7c570912611471209bea79638cce94415e');
            
            if (!$config->validator()->validate($token, new SignedWith($signer, $key))) {
                return false; // Token tidak valid atau tanda tangan salah
            }
    
            // Jika token valid, kembalikan token
            return $token;
        } catch (Exception $e) {
            // Token tidak dapat diparse atau verifikasi gagal
            return false;
        }
    }

    function verifyToken($jwt)
{
    try {
        // Inisialisasi konfigurasi JWT dengan HMAC-SHA256
        $config = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText('5f21f4a9ee1c79257afe56d1ba315e7c570912611471209bea79638cce94415e')
        );

        // Parse token
        $token = $config->parser()->parse($jwt);

        // Validasi token
        $constraints = [
            new SignedWith($config->signer(), $config->signingKey()), // Validasi tanda tangan
        ];

        if (!$config->validator()->validate($token, ...$constraints)) {
            return false; // Token tidak valid
        }

        return $token; // Token valid, kembalikan token untuk digunakan lebih lanjut
    } catch (\Throwable $e) {
        // Token tidak dapat diparse atau verifikasi gagal
        return false;
    }
}
