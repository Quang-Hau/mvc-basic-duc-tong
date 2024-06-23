<?php
// hiển thị chi tiết người dùng

function userDetail($id)
{
    $user = getUserByID($id); // truyền id được lấy ở đường đẫn sang models
    // require file View tương ứng để trả dữ liệu ( hiển thị dữ liệu)
    require_once PATH_VIEW . 'users/detail.php'; // require file detail.php ở Foder users ở Foder Views để render dữ liệu đc nhân ở Models
}
