<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: index.php"); exit(); }
$output = "";
if (isset($_POST['ip'])) {
    // VULNERABLE TO COMMAND INJECTION
    $output = shell_exec('ping -c 2 ' . $_POST['ip']);
}
?>
<!DOCTYPE html><html><head><title>Network Tool - SocialGram</title><link rel="stylesheet" href="css/style.css"><link href="https://fonts.googleapis.com/css?family=Grand+Hotel" rel="stylesheet"></head><body>
<div class="navbar"><a href="feed.php" class="logo">SocialGram</a><div class="navbar-links"><a href="profile.php">My Profile</a><a href="logout.php">Logout</a></div></div>
<main class="container main-layout">
    <aside class="sidebar">
        <div class="sidebar-box">
        <nav class="sidebar-nav">
            <a href="feed.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" /></svg> News Feed</a>
            <a href="messages.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" /><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" /></svg> Messages</a>
            <a href="friends.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0012 11z" clip-rule="evenodd" /></svg> Friends</a>
            <a href="/tools/" class="active"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M15.5 2a.5.5 0 01.5.5v15a.5.5 0 01-.5-.5h-11a.5.5 0 01-.5-.5v-15a.5.5 0 01.5-.5h11zm-1 1h-9v13h9V3zM6 5a1 1 0 100 2h8a1 1 0 100-2H6z" clip-rule="evenodd" /></svg> Network Tool</a>
            <a href="profile.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.982.033 2.285-.947 2.285-1.566 0-1.566 2.6 0 2.98.98.54 2.285.033 2.285.947-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.286-.948c.38 1.56 2.6 1.56 2.98 0a1.532 1.532 0 012.286.948c1.372.836 2.942-.734 2.106-2.106a1.532 1.532 0 01-.947-2.285c1.566-.38 1.566-2.6 0-2.98a1.532 1.532 0 01.947-2.285c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.286.948zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" /></svg> Settings</a>
        </nav>
        </div>
    </aside>
    <div class="col-span-2">
        <div class="sidebar-box">
            <h2 style="font-size: 24px; font-weight: 600; margin-bottom: 20px;">Network Test Tool</h2>
            <form method="post">
                <div class="form-group">
                    <label for="ip">Enter IP to ping:</label>
                    <input type="text" id="ip" name="ip">
                </div>
                <input type="submit" value="Ping">
            </form>
            <?php if ($output): ?>
            <div style="margin-top: 20px;">
                <h3 style="font-weight: 600;">Output:</h3>
                <pre style="background-color: #1a1a1a; color: #e0e0e0; padding: 15px; border-radius: 8px; margin-top: 10px; overflow-x: auto;"><?php echo htmlspecialchars($output); ?></pre>
            </div>
            <?php endif; ?>
        </div>
    </div>
</main>
</body></html>
