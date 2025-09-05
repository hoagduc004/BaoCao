<?php
require_once 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET name=?, username=?, password=?, role=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $username, $password, $role, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: admin.php");
    exit;
}
?>

<form method="post">
    <h2>Sửa người dùng</h2>
    Họ tên: <input type="text" name="name" value="<?= $user['name'] ?>"><br>
    Tài khoản: <input type="text" name="username" value="<?= $user['username'] ?>"><br>
    Mật khẩu: <input type="text" name="password" value="<?= $user['password'] ?>"><br>
    Quyền: 
    <select name="role">
        <option value="Quản trị" <?= $user['role'] == 'Quản trị' ? 'selected' : '' ?>>Quản trị</option>
        <option value="Khách hàng" <?= $user['role'] == 'Khách hàng' ? 'selected' : '' ?>>Khách hàng</option>
    </select><br>
    <button type="submit">Cập nhật</button>
</form>
