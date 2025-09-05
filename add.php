<?php
require_once 'connect.php';
$conn->set_charset("utf8");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $sql = "INSERT INTO users (name, username, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $username, $password, $role);
    if ($stmt->execute()) {
        $stmt->close();
        header("Location: admin.php");
        exit;
    } else {
        echo "Lỗi khi thêm: " . $stmt->error;
    }
}
?>
<form method="post">
    <h2>Thêm người dùng</h2>
    Họ tên: <input type="text" name="name" required><br>
    Tài khoản: <input type="text" name="username" required><br>
    Mật khẩu: <input type="text" name="password" required><br>
    Quyền: 
    <<select name="role" required>
    <option value="Quản trị">Quản trị</option>
    <option value="Khách hàng">Khách hàng</option>
    </select>
    <br>
    <button type="submit">Thêm</button>
</form>
