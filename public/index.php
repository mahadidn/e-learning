<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Klp1\ELearning\App\Router;
use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Controller\AdminController;
use Klp1\ELearning\Controller\DosenController;
use Klp1\ELearning\Controller\HomeController;
use Klp1\ELearning\Controller\MahasiswaController;
use Klp1\ELearning\Middleware\MustLoginAdminMiddleware;
use Klp1\ELearning\Middleware\MustLoginDosenMiddleware;
use Klp1\ELearning\Middleware\MustLoginMahasiswaMiddleware;
use Klp1\ELearning\Middleware\MustLoginMiddleware;

Database::getConnection("prod");

// Home Controller
Router::add('GET', '/', HomeController::class, 'index', []);
Router::add('POST', '/', HomeController::class, 'postLogin', []);

// Mahasiswa Controller
Router::add('GET', '/register/mahasiswa', MahasiswaController::class, 'registerMahasiswa', []);
Router::add('POST', '/register/mahasiswa', MahasiswaController::class, 'postRegisterMahasiswa', []);
Router::add('GET', '/dashboard/mahasiswa', MahasiswaController::class, 'dashboard', [MustLoginMahasiswaMiddleware::class]); 
Router::add('POST', '/mahasiswa/logout', MahasiswaController::class, 'logout', [MustLoginMahasiswaMiddleware::class]);

// Dosen Controller
Router::add('GET', '/register/dosen', DosenController::class, 'registerDosen', []);
Router::add('POST', '/register/dosen', DosenController::class, 'postRegisterDosen', []);
Router::add('GET', '/dashboard/dosen', DosenController::class, 'dashboard', [MustLoginDosenMiddleware::class]);
Router::add('POST', '/dosen/logout', DosenController::class, 'logout', [MustLoginDosenMiddleware::class]);

// Admin Controller
Router::add('GET', '/register/admin', AdminController::class, 'registerAdmin', []);
Router::add('POST', '/register/admin', AdminController::class, 'postRegisterAdmin', []);
Router::add('GET', '/dashboard/admin', AdminController::class, 'dashboard', [MustLoginAdminMiddleware::class]);
Router::add('POST', '/admin/logout', AdminController::class, 'logout', [MustLoginAdminMiddleware::class]);

Router::run();
