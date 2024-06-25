<?php

//file khai báo các hàm dùng Global 

if (!function_exists('require_file')) {
    function require_file($pathFoder)
    {
        // scandir($pathFolder): Hàm này trả về một mảng chứa tên của tất cả các tập tin và thư mục trong thư mục được chỉ định bởi $pathFolder, bao gồm cả các mục đặc biệt . (thư mục hiện tại) và .. (thư mục cha).
        //{
        // 0: ".",
        // 1: "..",
        // 2: "HomeController.php"
        // },
        $files = scandir($pathFoder);
        //array_diff($files, ['.', '..']): Hàm này sẽ loại bỏ các giá trị . và .. khỏi mảng
        $files = array_diff($files, ['.', '..']);

        foreach ($files as $file) {
            require_once($pathFoder . $file);
        }
    };
}

if (!function_exists('debug')) {
    function debug($data)
    {
        echo '<pre>';
        print_r($data);
    }
}


if (!function_exists('e404')) {
    function e404()
    {
        echo '<h1> 404 - Not found </h1>';
        die;
    }
}