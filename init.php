<?php
if (!isset($_SESSION)) {
    session_start();
}
spl_autoload_register(function ($className){
    $path = "class/{$className}.php";
    if (file_exists($path)) {
        require($path);
    }else {
        die("File {$path} tidak ditemukan ! Go To HELLO");
    }
});
?>