<?php
session_start();
require_once 'connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['users'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password); 
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role'];
        if ($row['role'] == 'admin') {
            header("Location: admin.php");
            exit;
        } else {
            header("Location: index.php");
            exit;
        }
    } else {
        $error = "Tên đăng nhập hoặc mật khẩu không đúng.";
    }

    $stmt->close();
}
$conn->close();
?>
<h2>Đăng Nhập</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Tên Đăng Nhập:</label><input type="text" name="username" required><br>
        <label>Mật Khẩu:</label><input type="password" name="password" required><br>
        <input type="submit" name="users" value="Đăng Nhập">
    </form>
