<?php

spl_autoload_register(function($className) {

    $mainDir = scandir(__DIR__.'\\..');
    foreach($mainDir as $dir) {
        if (is_dir(__DIR__."\\..\\$dir")) {
            $fullPath = __DIR__."\\..\\$dir";

            $file = "$fullPath\\$className.php";
                $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
                if (file_exists($file)) {
                    include $file;
                }
        }
    }
    
});