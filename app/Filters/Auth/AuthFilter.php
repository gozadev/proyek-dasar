<?php

namespace App\Filters\Auth;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Periksa apakah pengguna sudah login
        if (!session()->has('isLoggedIn')) {

            return redirect()->to(base_url());
            
        }

        // $db = Database::connect();
        // $dbName = getEnv("database_name");

        // // Menjalankan query untuk memeriksa keberadaan database
        // $result = $db->query("SHOW DATABASES LIKE '$dbName'")->getResult();

        // if (count($result) > 0) {
        //     // Hubungkan ulang ke database baru jika ada
        //     $config = config('Database');
        //     $config->default['database'] = $dbName;
        //     Database::connect($config->defaultGroup, false);
        // } else {
        //     // Buat database baru jika belum ada
        //     $db->query("CREATE DATABASE $dbName");
        //     $config = config('Database');
        //     $config->default['database'] = $dbName;
        //     Database::connect($config->defaultGroup, false);
        // }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
