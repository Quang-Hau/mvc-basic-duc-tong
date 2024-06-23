<?php

// kết nối csdl

$host = DB_HOST;
$port = DB_PORT;
$username = DB_USERNAME;
$password = DB_PASSWORD;
$dbname = DB_NAME;

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    // cài đặt chế độ báo lỗi là xử lý ngoại lệ
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //  cài đặt chế độ trả dữ liệu // trả dạng mảng key value
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    debug("Connection failed: " . $e->getMessage());
}
