<?php

function getAllUser()
{
    try {
        $sql = "SELECT * FROM users";

        $stmt = $GLOBALS["conn"]->prepare($sql);

        $stmt->execute();
        //Dòng mã $stmt->execute(); trong PHP có tác dụng thực thi câu lệnh SQL đã được chuẩn bị trước đó bằng phương thức prepare().
        // Đây là một phần quan trọng trong quy trình sử dụng PDO để tương tác với cơ sở dữ liệu, đặc biệt khi bạn muốn bảo vệ ứng dụng khỏi các cuộc tấn công SQL injection và tối ưu hóa hiệu suất.

        return $stmt->fetchAll();  // lấy tất cả bản ghi
    } catch (\Exception $e) {
        debug($e);
    }
}

function getUserByID($id)
{
    try {                                      // không được truyền trực tiếp biếm $id vào ngăn lỗi sql 
                                            // thay vào đó ta tạo biến giả $stnt->bindParam(':id', $id); và truyền vào  
        $sql = "SELECT * FROM users WHERE id = :id ";

        $stmt = $GLOBALS["conn"]->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute(); 

        return $stmt->fetch(); // lấy 1 bản ghi
    } catch (\Exception $e) {
        debug($e);
    }
}
