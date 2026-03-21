<?php

session_start();
include 'config/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Vulnerable SQL injection, no prepared statements 
    $query = "SELECT * FROM users WHERE username = '" . $username . "' AND password = MD5('" . $password . "')";

    $result = $mysqli->query($query);

    if ($result && $result->num_rows > 0) {
        $_SESSION['user'] = $username;
        header("Location: dashboard.php");
    } else {
        $error = "Invalid credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Vulnerable</title>
    <style>
        body { font-family: Arial; margin: 50px; }
        .form { max-width: 400px; border: 1px solid #ccc; padding: 20px; }
        input { width: 100%; padding: 8px; margin: 10px 0; box-sizing: border-box; }
        button { padding: 10px; width: 100%; background: #007bff; color: white; border: none; cursor: pointer; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Login (Vulnerable)</h1>
    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <div class="form">
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" required>
            
            <label>Password:</label>
            <input type="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
    </div>
    
    <hr>
    <p><strong>Try this attack:</strong></p>
    <p>Username: <code>admin' --</code></p>
    <p>Password: (leave blank)</p>
</body>
</html>
