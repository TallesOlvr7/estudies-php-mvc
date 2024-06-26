<?php

spl_autoload_register(function ($filename) {
    $file = '..' . DIRECTORY_SEPARATOR . $filename . '.php';

    if (DIRECTORY_SEPARATOR === '\\') {
        $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
    }

    if (file_exists($file)) {
        require $file;
    } else {
        echo 'Erro ao importar o arquivo';
    }
});

