<?php
require_once 'connect.php';

$result = $conn->query("SELECT * FROM users");
?>
<body>
    <h2>Danh sách người dùng</h2>
    <a href="add.php" class="add-btn">Thêm mới</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Tên người dùng</th>
            <th>Tên đăng nhập</th>
            <th>Mật khẩu</th>
            <th>Quyền</th>
            <th>Hành động</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['password']}</td>
                        <td>" . ($row['role'] == 'admin' ? 'Quản trị' : 'Khách hàng') . "</td>
                        <td class='action-buttons'>
                            <a class='edit-btn' href='edit.php?id={$row['id']}'>Sửa</a>
                            <a class='delete-btn' href='delete.php?id={$row['id']}' onclick=\"return confirm('Bạn có chắc muốn xóa không?');\">Xóa</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Không có dữ liệu.</td></tr>";
        }
?>
    </table>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Trang admin</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #999;
            padding: 8px 12px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-buttons a {
            padding: 4px 10px;
            text-decoration: none;
            border-radius: 4px;
            margin: 0 2px;
        }
        .edit-btn {
            background-color: #4CAF50;
            color: white;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
        }
        .add-btn {
            display: inline-block;
            margin-bottom: 10px;
            padding: 6px 12px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<?php
$conn->close();
?>
<a href="login.php">Quay lại</a>