<?php
session_start();
$conn = new mysqli("localhost", "root", "", "eventDB");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

if(isset($_POST['username'], $_POST['password'])){
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM admin WHERE username='$username'");
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['password'])){
            $_SESSION['admin'] = $row['username'];
            header("Location: admin_dashboard.php");
            exit;
        } else {
            $error = "❌ Incorrect Password";
        }
    } else {
        $error = "❌ Username not found";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>
<style>
body {
    font-family: 'Poppins', sans-serif;
    display: flex; justify-content: center; align-items: center;
    min-height: 100vh;
    background: linear-gradient(135deg, #74ebd5, #ACB6E5);
}
.login-card {
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    padding: 30px 40px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    width: 100%; max-width: 400px;
}
input {
    width: 100%; padding: 12px; margin: 10px 0; border-radius: 8px;
    border: 1px solid #ddd; outline: none;
}
button {
    width: 100%; padding: 12px; border: none; border-radius: 25px;
    background: linear-gradient(135deg, #667eea, #764ba2); color: #fff;
    font-weight: bold; cursor: pointer; margin-top: 10px;
}
button:hover { transform: scale(1.05); }
.error { color: #ff4444; text-align: center; }
</style>
</head>
<body>

<div class="login-card">
    <h2 style="text-align:center;">Admin Login</h2>
    <?php if($error != "") { echo "<p class='error'>$error</p>"; } ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>