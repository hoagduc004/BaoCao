<?php
$host = "localhost";
$user = "root";
$pass = ""; // hoặc mật khẩu MySQL của bạn
$db = "weboto";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
