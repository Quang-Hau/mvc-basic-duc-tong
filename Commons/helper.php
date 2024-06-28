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

//xử lý upload files
if (!function_exists('upload_file')) {
    function upload_file($file,$pathFolderUpload)
    {                                                      //basename được sử dụng để trả về tên cơ sở của một đường dẫn nhất định. Hàm này loại bỏ phần đường dẫn thư mục và chỉ trả về tên tệp. Nó cũng có thể loại bỏ một phần mở rộng tệp cụ thể nếu được cung cấp.
        $imgePath = $pathFolderUpload . time() . '-' . basename($file['name']);

        if (move_uploaded_file($file['tmp_name'], PATH_UPLOAD . $imgePath)) {
            return $imgePath; //tạo ra 1 key avatar trong mảng data có giá trị là full đường dẫn
        } 
        
        return null;
    }
}
