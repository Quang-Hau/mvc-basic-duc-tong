<?php

/// model commons dùng chung trong tát cả các model dự án 

//CRUD  -> Create / Read / Update / Delete

if(!function_exists('get_str_keys')) {
    function get_str_keys($data) {
       return  implode(",", array_keys($data)); //Chuyển đổi mảng các khóa thành chuỗi với các khóa ngăn cách bởi dấu phẩy.
    }
}

if(!function_exists('get_virtual_param')) {
    function get_virtual_param($data) {
        $keys = array_keys($data); //trả về một mảng chứa các khóa của mảng $data.

        $tmp = []; //Tại 1 mảng rỗng

        foreach($keys as $key) {
            $tmp[] = ":$key"; //Duyệt qua các khóa và thêm : trước mỗi khóa rồi lưu vào mảng $tmp.
        }

       return implode(",",  $tmp);//Duyệt qua các khóa và thêm : trước mỗi khóa rồi lưu vào mảng $tmp. VD :A,:B
    }
}

if(!function_exists('get_set_params')) {
    function get_set_params($data) {
        $keys = array_keys($data); //trả về một mảng chứa các khóa của mảng $data.

        $tmp = []; //Tại 1 mảng rỗng

        foreach($keys as $key) {
            $tmp[] = "$key = :$key"; //Duyệt qua các khóa và thêm : trước mỗi khóa rồi lưu vào mảng $tmp.
        }

       return implode(",",  $tmp);//Duyệt qua các khóa và thêm : trước mỗi khóa rồi lưu vào mảng $tmp. VD :A,:B
    }
}

if (!function_exists('insert')) { //Mục đích: Tạo câu lệnh SQL để chèn dữ liệu vào bảng.
    function insert($tableName, $data = [])
    {
        try {

            $strKey = get_str_keys($data); //vd :name,email,password,type

            $virtualParams = get_virtual_param($data);// sau khi ta bindParam :    :name,:email,:password,:type


            $sql = "INSERT INTO $tableName($strKey) VALUES($virtualParams) "; //INSERT INTO users(name,email,password,type) VALUES(:name,:email,:password,:type) 

            $stmt = $GLOBALS["conn"]->prepare($sql);
                                    //Phương thức prepare của PDO chuẩn bị một câu lệnh SQL để thực thi. 
                                    //Việc chuẩn bị câu lệnh SQL này cho phép bạn sử dụng các tham số ảo (placeholder) 
                                    //như :param để liên kết với các giá trị thực tế sau này.
            foreach ( $data as $fieldName => &$value) { //bindParamPDO
                // debug([":$fieldName",$value]);
                $stmt->bindParam(":$fieldName", $value);
                    //Phương thức bindParam trong PDO là một công cụ mạnh mẽ để thực hiện các thao tác với cơ sở dữ liệu một cách an toàn và hiệu quả.
                    // Nó giúp bảo vệ ứng dụng của bạn khỏi các cuộc tấn công SQL injection
            }          
            $stmt->execute(); // thực thi câu truy vấn
            //Dòng mã $stmt->execute(); trong PHP có tác dụng thực thi câu lệnh SQL đã được chuẩn bị trước đó bằng phương thức prepare().
            // Đây là một phần quan trọng trong quy trình sử dụng PDO để tương tác với cơ sở dữ liệu, đặc biệt khi bạn muốn bảo vệ ứng dụng khỏi các cuộc tấn công SQL injection và tối ưu hóa hiệu suất.
    

        } catch (\Exception $e) {
            debug($e);
        }
    }
}

if (!function_exists('listAll')) { //Mục đích: Tạo câu lệnh SQL để chèn dữ liệu vào bảng.
    function lisAll($tableName)
    {
        try {

            $sql = "SELECT * FROM $tableName ORDER BY id DESC";
            $stmt = $GLOBALS["conn"]->prepare($sql);
                                    //Phương thức prepare của PDO chuẩn bị một câu lệnh SQL để thực thi. 
                                    //Việc chuẩn bị câu lệnh SQL này cho phép bạn sử dụng các tham số ảo (placeholder) 
                                    //như :param để liên kết với các giá trị thực tế sau này.
             
            $stmt->execute(); // thực thi câu truy vấn
            //Dòng mã $stmt->execute(); trong PHP có tác dụng thực thi câu lệnh SQL đã được chuẩn bị trước đó bằng phương thức prepare().
            // Đây là một phần quan trọng trong quy trình sử dụng PDO để tương tác với cơ sở dữ liệu, đặc biệt khi bạn muốn bảo vệ ứng dụng khỏi các cuộc tấn công SQL injection và tối ưu hóa hiệu suất.
    
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}

if (!function_exists('showOne')) { //Mục đích: Tạo câu lệnh SQL để chèn dữ liệu vào bảng.
    function showOne($tableName,$id)
    {
        try {

            $sql = "SELECT * FROM $tableName WHERE id = :id LIMIT 1";
            $stmt = $GLOBALS["conn"]->prepare($sql);
                                    //Phương thức prepare của PDO chuẩn bị một câu lệnh SQL để thực thi. 
                                    //Việc chuẩn bị câu lệnh SQL này cho phép bạn sử dụng các tham số ảo (placeholder) 
                                    //như :param để liên kết với các giá trị thực tế sau này.
            
            $stmt->bindParam(":id", $id);

            $stmt->execute(); // thực thi câu truy vấn
            //Dòng mã $stmt->execute(); trong PHP có tác dụng thực thi câu lệnh SQL đã được chuẩn bị trước đó bằng phương thức prepare().
            // Đây là một phần quan trọng trong quy trình sử dụng PDO để tương tác với cơ sở dữ liệu, đặc biệt khi bạn muốn bảo vệ ứng dụng khỏi các cuộc tấn công SQL injection và tối ưu hóa hiệu suất.
    
            return $stmt->fetch();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}

if (!function_exists('update')) { //Mục đích: Tạo câu lệnh SQL để chèn dữ liệu vào bảng.
    function update($tableName,$id, $data = [])
    {
        try {

            $setParams = get_set_params($data);

            $sql = "
            UPDATE $tableName
            SET $setParams
            WHERE id = :id
            "; 

            $stmt = $GLOBALS["conn"]->prepare($sql);
                                    //Phương thức prepare của PDO chuẩn bị một câu lệnh SQL để thực thi. 
                                    //Việc chuẩn bị câu lệnh SQL này cho phép bạn sử dụng các tham số ảo (placeholder) 
                                    //như :param để liên kết với các giá trị thực tế sau này.
            foreach ( $data as $fieldName => &$value) { //bindParamPDO

                $stmt->bindParam(":$fieldName", $value);
                    //Phương thức bindParam trong PDO là một công cụ mạnh mẽ để thực hiện các thao tác với cơ sở dữ liệu một cách an toàn và hiệu quả.
                    // Nó giúp bảo vệ ứng dụng của bạn khỏi các cuộc tấn công SQL injection
            }        
            
            $stmt->bindParam(":id", $id);

            $stmt->execute(); // thực thi câu truy vấn
            //Dòng mã $stmt->execute(); trong PHP có tác dụng thực thi câu lệnh SQL đã được chuẩn bị trước đó bằng phương thức prepare().
            // Đây là một phần quan trọng trong quy trình sử dụng PDO để tương tác với cơ sở dữ liệu, đặc biệt khi bạn muốn bảo vệ ứng dụng khỏi các cuộc tấn công SQL injection và tối ưu hóa hiệu suất.
    

        } catch (\Exception $e) {
            debug($e);
        }
    }
}

if (!function_exists('removed')) { //Mục đích: Tạo câu lệnh SQL để chèn dữ liệu vào bảng.
    function removed($tableName,$id)
    {
        try {

            $sql = "DELETE FROM $tableName WHERE id = :id"; 

            $stmt = $GLOBALS["conn"]->prepare($sql);
                                    //Phương thức prepare của PDO chuẩn bị một câu lệnh SQL để thực thi. 
                                    //Việc chuẩn bị câu lệnh SQL này cho phép bạn sử dụng các tham số ảo (placeholder) 
                                    //như :param để liên kết với các giá trị thực tế sau này.     
            
            $stmt->bindParam(":id", $id);

            $stmt->execute(); // thực thi câu truy vấn
            //Dòng mã $stmt->execute(); trong PHP có tác dụng thực thi câu lệnh SQL đã được chuẩn bị trước đó bằng phương thức prepare().
            // Đây là một phần quan trọng trong quy trình sử dụng PDO để tương tác với cơ sở dữ liệu, đặc biệt khi bạn muốn bảo vệ ứng dụng khỏi các cuộc tấn công SQL injection và tối ưu hóa hiệu suất.
    

        } catch (\Exception $e) {
            debug($e);
        }
    }
}