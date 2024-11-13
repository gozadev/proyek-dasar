<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->cli('websocket', 'WebSocketController::index');
$routes->get('pass', 'Home::hashPassword'); // hash password
//$routes->get('test', 'Home::test');
// $routes->post('test', 'Generator\Generator::test'); // halaman login admin
//$routes->post('test', 'PgPnsInfo\PgPnsInfoController::uploadFile'); // halaman login admin


$routes->get('/', 'Home::index');
$routes->get('daftar', 'Home::daftar');
//$routes->get('test', 'Home::test');
$routes->get('test', 'Home::test');

// $routes->get('verfikasi', 'Home::verfikasi');


// Route untuk Auth 
$routes->get('logout', 'Auth\AuthController::logout');
$routes->post('proseslogin', 'Auth\AuthController::prosesLogin');
$routes->post('proses-daftar', 'Auth\AuthController::prosesDaftar');
$routes->get('captcha/(:any)', 'Auth\AuthController::generateCaptcha/$1'); // generate kode captcha
$routes->post('akses-tombol', 'Auth\AuthController::aksesTombol',['filter' => 'authfilter']);
$routes->get('akun-akses', 'Auth\AuthController::tidakAdaAkses',['filter' => 'authfilter']);


// Route untuk dashboard 
$routes->group('dashboard', ['filter' => 'authfilter'],  function ($routes) {
   $routes->get('/', 'Dashboard\DashboardController::index'); // halaman login admin
   $routes->get('maintenance', 'Maintenance\MaintenanceController::index'); // halaman maintenance
   $routes->get('usermanagement', 'User\UserManagementController::index'); // halaman user management
   $routes->get('menumanagement', 'Menu\MenuManagementController::index'); // halaman menu management
   $routes->get('crudgenerator', 'Generator\Generator::index'); // halaman crud generator
   $routes->get('profile', 'UserProfile\UserProfileController::index'); // halaman profile User
   
});

// Route untuk Maintenance
$routes->group('maintenance', static function ($routes) {
   $routes->post('setmode', 'Maintenance\MaintenanceController::setModeMaintenance',['filter' => 'authfilter']); // halaman login admin
   $routes->get('durasimaintenance', 'Maintenance\MaintenanceController::cekMaintenance');
   $routes->get('onWorkerman', 'Maintenance\MaintenanceController::startServer'); 
});

$routes->group('generator', ['filter' => 'authfilter'],  function ($routes) {
   $routes->post('gettable', 'Generator\Generator::GetTableName'); // 
   $routes->post('getkeytable', 'Generator\Generator::GetTableKey'); // 
   $routes->post('getfieldtable', 'Generator\Generator::GetTableField'); // 
   $routes->post('generate', 'Generator\Generator::generate'); // 

});

$routes->group('user', ['filter' => 'authfilter'], function ($routes) {
   $routes->post('datauser', 'User\UserManagementController::dataUser'); // halaman login admin
   $routes->post('getdatauser', 'User\UserManagementController::getDataUser'); 
   $routes->post('cekusername', 'User\UserManagementController::cekUser');
   $routes->post('storepassuser', 'User\UserManagementController::gantiPasssword'); 
   $routes->post('storeuser', 'User\UserManagementController::storeUser'); 
   $routes->post('cekmenuakses', 'User\UserManagementController::cekAksesMenuUser'); 
   $routes->post('storeaksesuser', 'User\UserManagementController::storeAksesMenuUser');
   $routes->post('updateprofile', 'UserProfile\UserProfileController::updateProfile');
   
});

$routes->group('menu', ['filter' => 'authfilter'], function ($routes) {
   $routes->post('datasubmenu', 'Menu\MenuManagementController::dataSubMenu'); 
   $routes->post('getdatasubmenu', 'Menu\MenuManagementController::getDataSubMenu'); 
   $routes->post('datamastermenu', 'Menu\MenuManagementController::dataMasterMenu'); 
   $routes->post('getdatamastermenu', 'Menu\MenuManagementController::getDataMasterMenu'); 
   $routes->post('storsubmenu', 'Menu\MenuManagementController::storeSubMenu'); 
   $routes->post('delete-menu', 'Menu\MenuManagementController::deleteMenu');

 
});

$routes->group('testa', static function ($routes) {
    $routes->get('/', 'test\testController::index',['filter' => 'authfilter']);
    $routes->post('all-data', 'test\testController::allData',['filter' => 'authfilter']); 
    $routes->post('get-data-one', 'test\testController::getDataOne',['filter' => 'authfilter']);  
    $routes->post('store',  'test\testController::storeData',['filter' => 'authfilter']); 
    $routes->post('delete-data','test\testController::remove',['filter' => 'authfilter']);
});



$routes->group('penilaian', ['filter' => 'authfilter'] ,function ($routes) {
    $routes->get('/', 'Penilaian\PenilaianController::index');
    $routes->get('quesioner/(:num)', 'Penilaian\PenilaianController::quesioner/$1');
    $routes->post('all-data', 'Penilaian\PenilaianController::allData'); 
    $routes->post('get-data-one', 'Penilaian\PenilaianController::getDataOne');  
    $routes->post('store',  'Penilaian\PenilaianController::storeData'); 
    $routes->post('delete-data','Penilaian \PenilaianController::remove');
});



