<?php
session_start();
include 'config/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // SECURE: Prepared statement (SQL injection protected)
    $query = "SELECT * FROM users WHERE username = ? AND password = MD5(?)";  // ? placehorders are filled after parsing, treats input as data, 
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $_SESSION['user'] = $username;
        header("Location: dashboard.php");
    } else {
        $error = "Invalid credentials";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Secure</title>
    <style>
        body { font-family: Arial; margin: 50px; }
        .form { max-width: 400px; border: 1px solid #ccc; padding: 20px; background: #e8f5e9; }
        input { width: 100%; padding: 8px; margin: 10px 0; box-sizing: border-box; }
        button { padding: 10px; width: 100%; background: #28a745; color: white; border: none; cursor: pointer; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Login (Secure - Protected)</h1>
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
    <p><strong>Why this is safe:</strong></p>
    <p>The `?` placeholders are filled AFTER SQL parsing. User input cannot break the query structure.</p>
</body>
</html>
