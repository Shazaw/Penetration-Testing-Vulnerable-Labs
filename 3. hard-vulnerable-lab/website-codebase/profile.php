<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: index.php"); exit(); }
$message = "";
if (isset($_FILES['avatar'])) {
    // VULNERABLE FILE UPLOAD (Content-Type check)
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (in_array($_FILES['avatar']['type'], $allowed_types)) {
        move_uploaded_file($_FILES['avatar']['tmp_name'], 'uploads/avatars/' . $_FILES['avatar']['name']);
        $message = "File uploaded!";
    } else { $message = "Invalid file type! Only JPG, PNG, and GIF are allowed."; }
}
?>
<!DOCTYPE html><html><head><title>Your Profile - SocialGram</title><link rel="stylesheet" href="css/style.css"><link href="https://fonts.googleapis.com/css?family=Grand+Hotel" rel="stylesheet"></head><body>
<div class="navbar"><a href="feed.php" class="logo">SocialGram</a><div class="navbar-links"><a href="profile.php">My Profile</a><a href="logout.php">Logout</a></div></div>
<main class="container main-layout">
    <aside class="sidebar">
        <div class="sidebar-box">
        <nav class="sidebar-nav">
            <a href="feed.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" /></svg> News Feed</a>
            <a href="messages.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" /><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" /></svg> Messages</a>
            <a href="friends.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0012 11z" clip-rule="evenodd" /></svg> Friends</a>
            <a href="/tools/"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M15.5 2a.5.5 0 01.5.5v15a.5.5 0 01-.5-.5h-11a.5.5 0 01-.5-.5v-15a.5.5 0 01.5-.5h11zm-1 1h-9v13h9V3zM6 5a1 1 0 100 2h8a1 1 0 100-2H6z" clip-rule="evenodd" /></svg> Network Tool</a>
            <a href="profile.php" class="active"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.982.033 2.285-.947 2.285-1.566 0-1.566 2.6 0 2.98.98.54 2.285.033 2.285.947-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.286-.948c.38 1.56 2.6 1.56 2.98 0a1.532 1.532 0 012.286.948c1.372.836 2.942-.734 2.106-2.106a1.532 1.532 0 01-.947-2.285c1.566-.38 1.566-2.6 0-2.98a1.532 1.532 0 01.947-2.285c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.286.948zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" /></svg> Settings</a>
        </nav>
        </div>
    </aside>
    <div class="col-span-2">
        <div class="sidebar-box">
            <h2 style="font-size: 24px; font-weight: 600; margin-bottom: 20px;">Account Settings</h2>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Update Profile Picture:</label>
                    <input type="file" name="avatar">
                </div>
                <input type="submit" value="Upload Picture">
            </form>
            <hr style="margin: 20px 0; border-color: #363636;">
            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" value="Dev Team" disabled>
            </div>
            <div class="form-group">
                <label>Bio:</label>
                <textarea disabled>Building the future of SocialGram.</textarea>
            </div>
            <div class="form-group">
                <label>Change Password:</label>
                <input type="password" placeholder="New Password" disabled>
            </div>
             <input type="submit" value="Save Changes" disabled style="background-color: #555; cursor: not-allowed;">
            <?php if ($message): ?><p style="color:lightgreen; margin-top: 15px;"><?php echo $message; ?></p><?php endif; ?>
        </div>
    </div>
</main>
</body></html>
