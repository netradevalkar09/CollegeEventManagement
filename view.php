<?php
$conn = new mysqli("localhost", "root", "", "eventDB");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM registration");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>All Registrations</title>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #74ebd5, #ACB6E5);
        margin: 0; padding: 0;
        display: flex; flex-direction: column; align-items: center;
    }
    header, footer {
        text-align: center;
        padding: 20px;
        color: white;
        background: rgba(0,0,0,0.3);
        width: 100%;
        backdrop-filter: blur(8px);
    }
    .container {
        width: 90%;
        max-width: 800px;
        margin: 30px auto;
        background: rgba(255,255,255,0.2);
        padding: 20px;
        border-radius: 15px;
        backdrop-filter: blur(10px);
        color: white;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        color: white;
    }
    th, td {
        padding: 12px;
        border-bottom: 1px solid white;
        text-align: left;
    }
    th {
        background: rgba(255,255,255,0.3);
        border-radius: 8px;
    }
    a.btn {
        display: inline-block;
        margin-top: 15px;
        padding: 10px 20px;
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

<header>
    <h1>📋 All Registrations</h1>
</header>

<div class="container">
    <table>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Event</th><th>Registration Date</th></tr>
        <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['event']; ?></td>
                <td><?php echo $row['reg_date']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <p>
        <a href="index.html" class="btn">Back to Home</a>
        <a href="registration.html" class="btn">Register Another</a>
    </p>
</div>

<footer>
    &copy; 2025 College Event Management
</footer>

</body>
</html>

<?php $conn->close(); ?>