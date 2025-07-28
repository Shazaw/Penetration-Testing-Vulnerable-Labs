<?php
session_start();
if (isset($_SESSION['user'])) { header("Location: profile.php"); exit(); }
$message = "";
if (isset($_POST['login'])) {
    $conn = new mysqli('localhost', 'webapp', 'SuperSecureDBPass123!', 'social_media');
    $username = $_POST['username'];
    // VULNERABLE SQL QUERY
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        $_SESSION['user'] = $user_data['username'];
        header("Location: profile.php");
        exit();
    } else { $message = "Invalid login!"; }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>SocialNet Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-box">
        <h2>Welcome to SocialNet</h2>
        <form method="post">
          Username: <input type="text" name="username"><br>
          Password: <input type="password" name="password"><br>
          <input type="submit" name="login" value="Login">
        </form>
        <p style="color:red;"><?php echo $message; ?></p>
    </div>
</body>
</html>
