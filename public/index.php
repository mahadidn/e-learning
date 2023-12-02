<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Klp1\ELearning\App\Router;
use Klp1\ELearning\Config\Database;
use Klp1\ELearning\Controller\AdminController;
use Klp1\ELearning\Controller\DosenController;
use Klp1\ELearning\Controller\HomeController;
use Klp1\ELearning\Controller\MahasiswaController;

Database::getConnection("prod");

// Home Controller
Router::add('GET', '/', HomeController::class, 'index', []);
Router::add('POST', '/', HomeController::class, 'postLogin', []);

// Mahasiswa Controller
Router::add('GET', '/register/mahasiswa', MahasiswaController::class, 'registerMahasiswa', []);
Router::add('POST', '/register/mahasiswa', MahasiswaController::class, 'postRegisterMahasiswa', []);
Router::add('GET', '/dashboard/mahasiswa', MahasiswaController::class, 'dashboard', []); 
Router::add('POST', '/logout', MahasiswaController::class, 'logout', []);

// Dosen Controller
Router::add('GET', '/register/dosen', DosenController::class, 'registerDosen', []);
Router::add('POST', '/register/dosen', DosenController::class, 'postRegisterDosen', []);
Router::add('GET', '/dashboard/dosen', DosenController::class, 'dashboard', []);
Router::add('POST', '/logout', DosenController::class, 'logout', []);

// Admin Controller
Router::add('GET', '/dashboard/admin', AdminController::class, 'dashboard', []);
Router::add('POST', '/logout', AdminController::class, 'logout', []);
Router::add('GET', '/register/admin', AdminController::class, 'registerAdmin', []);

Router::run();
