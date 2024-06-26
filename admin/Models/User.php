<?php

// hamf tương tác csdl check có trùng email k trùng trả về true và ngược lại
if (!function_exists('checkUniqueEmail')) { //Mục đích: Tạo câu lệnh SQL để chèn dữ liệu vào bảng.
    function checkUniqueEmail($tableName, $email)
    {
        try {

            $sql = "SELECT * FROM $tableName WHERE email = :email LIMIT 1";
            $stmt = $GLOBALS["conn"]->prepare($sql);
            //Phương thức prepare của PDO chuẩn bị một câu lệnh SQL để thực thi. 
            //Việc chuẩn bị câu lệnh SQL này cho phép bạn sử dụng các tham số ảo (placeholder) 
            //như :param để liên kết với các giá trị thực tế sau này.

            $stmt->bindParam(":email", $email);

            $stmt->execute(); // thực thi câu truy vấn
            //Dòng mã $stmt->execute(); trong PHP có tác dụng thực thi câu lệnh SQL đã được chuẩn bị trước đó bằng phương thức prepare().
            // Đây là một phần quan trọng trong quy trình sử dụng PDO để tương tác với cơ sở dữ liệu, đặc biệt khi bạn muốn bảo vệ ứng dụng khỏi các cuộc tấn công SQL injection và tối ưu hóa hiệu suất.

            $data = $stmt->fetch();

            return empty($data) ? true : false;
        } catch (\Exception $e) {
            debug($e);
        }
    }
}


if (!function_exists('checkUniqueEmailForUpdate')) { //Mục đích: Tạo câu lệnh SQL để chèn dữ liệu vào bảng.
    function checkUniqueEmailForUpdate($tableName,$id, $email)
    {
        try {

            $sql = "SELECT * FROM $tableName WHERE email = :email AND id <> :id LIMIT 1";
            $stmt = $GLOBALS["conn"]->prepare($sql);
            //Phương thức prepare của PDO chuẩn bị một câu lệnh SQL để thực thi. 
            //Việc chuẩn bị câu lệnh SQL này cho phép bạn sử dụng các tham số ảo (placeholder) 
            //như :param để liên kết với các giá trị thực tế sau này.

            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":id", $id);

            $stmt->execute(); // thực thi câu truy vấn
            //Dòng mã $stmt->execute(); trong PHP có tác dụng thực thi câu lệnh SQL đã được chuẩn bị trước đó bằng phương thức prepare().
            // Đây là một phần quan trọng trong quy trình sử dụng PDO để tương tác với cơ sở dữ liệu, đặc biệt khi bạn muốn bảo vệ ứng dụng khỏi các cuộc tấn công SQL injection và tối ưu hóa hiệu suất.

            $data = $stmt->fetch();

            return empty($data) ? true : false;
        } catch (\Exception $e) {
            debug($e);
        }
    }
}
