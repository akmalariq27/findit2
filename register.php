<?php include("db.php"); ?>
<!DOCTYPE html>
<html>
<head><title>Register</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h2>Register</h2>
<form method="POST" action="">
    Name: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" name="register" value="Register">
</form>
</div>

<?php
if (isset($_POST['register'])) {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$pass', 'user')";
    if ($conn->query($sql)) {
        echo "Registered successfully. <a href='login.php'>Login</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
</body>
</html>
