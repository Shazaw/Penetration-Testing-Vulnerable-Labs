<?php
session_start();
if (!isset($_SESSION['user'])) { die("Please login first."); }
$message = "";
if (isset($_FILES['avatar'])) {
    // VULNERABLE FILE UPLOAD
    move_uploaded_file($_FILES['avatar']['tmp_name'], 'uploads/' . $_FILES['avatar']['name']);
    $message = "File uploaded!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="profile-container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?></h1>
        <div class="flag">
            <p><b>Flag 2:</b> OmahTIAcademy{SQL_L0g1n_Byp@ss}</p>
        </div>
        <hr>
        <h3>Update Profile Picture</h3>
        <form method="post" enctype="multipart/form-data">
          <input type="file" name="avatar">
          <input type="submit" value="Upload">
        </form>
        <p style="color:green;"><?php echo $message; ?></p>
    </div>
</body>
</html>
