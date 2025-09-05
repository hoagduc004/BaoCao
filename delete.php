<?php
require_once 'connect.php';
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // ép kiểu để tránh SQL injection

    // Câu lệnh SQL xóa
    $sql = "DELETE FROM users WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
        exit();

    } else {
        echo "Lỗi: " . $conn->error;
    }
} else {
    echo "Không có ID để xóa!";
}
?>

