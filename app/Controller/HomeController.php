<?php

namespace Klp1\ELearning\Controller;

use Klp1\ELearning\App\View;

class HomeController {
    
    public function index(): void {
        $cssFont = __DIR__ . '/../View/assets/vendor/fontawesome-free/css/all.min.css';
        $css = __DIR__ . '/../View/assets/vendor/datatables/dataTables.bootstrap4.min.css';
        $cssCustom = __DIR__ . '/../View/assets/css/custom.css';
        $cssTemplate = __DIR__ . '/../View/assets/css/sb-admin-2.min.css';
        
        View::render('index', [
            "title" => "Beranda",
            "cssFont" => $cssFont,
            "css" => $css,
            "cssCustom" => $cssCustom,
            "cssTemplate" => $cssTemplate
        ]);
    }
    
}

