<?php
session_start();
if (isset($_SESSION['user'])) { header("Location: feed.php"); exit(); }
$message = "";
if (isset($_POST['login'])) {
    $conn = new mysqli('localhost', 'socialgram_user', 'StrongDBPassword456!', 'socialgram');
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $_POST['username'], $_POST['password']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['user'] = $_POST['username'];
        header("Location: feed.php");
        exit();
    } else { $message = "Invalid login!"; }
}
?>
<!DOCTYPE html><html><head><title>Login - SocialGram</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<div class="login-container">
    <div class="login-image"></div>
    <div class="login-form-container">
        <div class="login-box">
            <h2>Welcome to SocialGram</h2>
            <p>Log in to get the moment updates on the things that interest you.</p>
            <form method="post" class="space-y-4">
                <div class="form-group"><input type="text" name="username" placeholder="Username" required></div>
                <div class="form-group"><input type="password" name="password" placeholder="Password" required></div>
                <input type="submit" name="login" value="Sign In">
            </form>
            <?php if ($message): ?><p style="color:red; margin-top: 15px;"><?php echo $message; ?></p><?php endif; ?>
        </div>
    </div>
</div>
</body></html>
