<?php

function HomeIndex()
{
    $users = getAllUser();


    require_once(PATH_VIEW . 'home.php'); // require file view để trả dữ liệu
}

//Luông MVC 1 : vào index 
//     -> được điều hướng đến hàm sử lý logic trong controller tương ứng
//          -> hàm sẽ trả về view luôn nếu không có tương tác với model


//Luông MVC 2 : vào index 
//     -> được điều hướng đến hàm sử lý logic trong controller tương ứng
//          -> hàm sẽ  tương tác với hàm xử lý dữ liệu trong model
//              -> dữ liệu trong model sẽ được trả về view