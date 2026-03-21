<!DOCTYPE html>
<html>
<head>
    <title> SQL Injection Lab</title>
    <style>
        body { font family: Arial; margin: 50px; }
        .section { padding: 20px; margin: 20px 0; border-radius: 5px; }
        .vulnerable { background: #ffebee; border-left: 5px solid red; }
        .secure  { background: #e8f5e9; border-left: 5px solid green; }
        a { text-decoration: none; color: #007bff; }
        a:hover { text decoration: underline; }
    </style>

</head>
<body>
    <h1> SQL Injection Lab</h1>

    <div class="section vulnerable">
        <h2> Vulnerable (Attack these)</h2>
        <ul>
            <li><a href="vulnerable_login.php">Login page - SQLi Vulnerable</a></li>
            </ul>
    </div>

    <div class="section secure">
        <h2> Secure (Reference)</h2>
        <ul>
            <li><a href="secure_login.php">Secure Login - Protected</a></li>
            </ul>
        
    </div>

</body>
</html>


