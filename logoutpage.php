<?php
session_start();
session_destroy(); // Session terminate karte
header("Location: admin_login.php"); // Login page la redirect
exit;
?>