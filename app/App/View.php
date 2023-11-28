<?php

namespace Klp1\ELearning\App;

class View {
    public static function render(string $view, $model){
        require __DIR__ . '/../View/' . $view . '.php';
    }

    public static function redirect(string $url){
        header("Location: $url");
    }
}

