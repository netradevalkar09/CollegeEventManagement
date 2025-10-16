<?php
$conn = new mysqli("localhost", "root", "", "eventDB");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if(isset($_POST['name'], $_POST['email'], $_POST['event'])){
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $event = $conn->real_escape_string($_POST['event']);

    $sql = "INSERT INTO registration (name, email, event, reg_date) VALUES ('$name', '$email', '$event', NOW())";

    if ($conn->query($sql) === TRUE) {
        $message = "✅ Registration Successful!";
    } else {
        $message = "❌ Error inserting data: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Status</title>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #74ebd5, #ACB6E5);
        margin: 0; padding: 0;
        display: flex; justify-content: center; align-items: center;
        height: 100vh;
        flex-direction: column;
        color: white;
        text-align: center;
    }
    .card {
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        padding: 30px 40px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }
    h2 {
        margin-bottom: 20px;
    }
    a.btn {
        display: inline-block;
        margin: 10px 10px 0 10px;
        padding: 12px 25px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        text-decoration: none;
        border-radius: 25px;
        font-weight: bold;
        transition: transform 0.3s;
    }
    a.btn:hover {
        transform: scale(1.05);
    }
</style>
</head>
<body>

<div class="card">
    <h2><?php echo $message; ?></h2>
    <p>
        <a href="index.html" class="btn">Back to Home</a>
        <a href="registration.html" class="btn">Register Another</a>
        <a href="view.php" class="btn">View All Registrations</a>
    </p>
</div>

</body>
</html>