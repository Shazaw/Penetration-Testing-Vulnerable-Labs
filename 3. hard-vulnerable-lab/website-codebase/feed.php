<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: index.php"); exit(); }
$conn = new mysqli('localhost', 'socialgram_user', 'StrongDBPassword456!', 'socialgram');
$posts_result = $conn->query("SELECT u.username, u.avatar_path, p.image_path, p.caption, p.likes FROM posts p JOIN users u ON p.user_id = u.id ORDER BY p.id DESC");
$posts = $posts_result->fetch_all(MYSQLI_ASSOC);
$current_user_result = $conn->query("SELECT * FROM users WHERE username = '".$_SESSION['user']."'");
$current_user = $current_user_result->fetch_assoc();
$suggestions_result = $conn->query("SELECT username, avatar_path, full_name FROM users WHERE username != '".$_SESSION['user']."' ORDER BY RAND() LIMIT 5");
$suggestions = $suggestions_result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html><html><head><title>Home - SocialGram</title><link rel="stylesheet" href="css/style.css"><link href="https://fonts.googleapis.com/css?family=Grand+Hotel" rel="stylesheet"></head><body>
<div class="navbar"><a href="feed.php" class="logo">SocialGram</a><div class="navbar-links"><a href="profile.php">My Profile</a><a href="logout.php">Logout</a></div></div>
<main class="container main-layout">
    <aside class="sidebar">
        <div class="sidebar-box">
            <div class="sidebar-header">
                <img src="<?php echo htmlspecialchars($current_user['avatar_path']); ?>" alt="My Avatar">
                <div>
                    <p class="username"><?php echo htmlspecialchars($current_user['username']); ?></p>
                    <p style="color:#8e8e8e; font-size: 14px;"><?php echo htmlspecialchars($current_user['full_name']); ?></p>
                </div>
            </div>
            <nav class="sidebar-nav">
                <a href="feed.php" class="active"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" /></svg> News Feed</a>
                <a href="messages.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" /><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" /></svg> Messages</a>
                <a href="friends.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0012 11z" clip-rule="evenodd" /></svg> Friends</a>
                <a href="/tools/"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M15.5 2a.5.5 0 01.5.5v15a.5.5 0 01-.5-.5h-11a.5.5 0 01-.5-.5v-15a.5.5 0 01.5-.5h11zm-1 1h-9v13h9V3zM6 5a1 1 0 100 2h8a1 1 0 100-2H6z" clip-rule="evenodd" /></svg> Network Tool</a>
                <a href="profile.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.982.033 2.285-.947 2.285-1.566 0-1.566 2.6 0 2.98.98.54 2.285.033 2.285.947-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.286-.948c.38 1.56 2.6 1.56 2.98 0a1.532 1.532 0 012.286.948c1.372.836 2.942-.734 2.106-2.106a1.532 1.532 0 01-.947-2.285c1.566-.38 1.566-2.6 0-2.98a1.532 1.532 0 01.947-2.285c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.286.948zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" /></svg> Settings</a>
            </nav>
        </div>
    </aside>
    <div class="feed-column">
        <?php foreach ($posts as $post): ?>
        <div class="post">
            <div class="post-header"><img src="<?php echo htmlspecialchars($post['avatar_path']); ?>" alt="Avatar"><span class="username"><?php echo htmlspecialchars($post['username']); ?></span></div>
            <div class="post-image"><img src="<?php echo htmlspecialchars($post['image_path']); ?>" alt="Post Image"></div>
            <div class="post-caption"><p><strong><?php echo htmlspecialchars($post['username']); ?></strong> <?php echo htmlspecialchars($post['caption']); ?></p></div>
        </div>
        <?php endforeach; ?>
    </div>
    <aside class="sidebar">
        <div class="suggestions">
            <h3 style="font-weight: 600; color: #8e8e8e; margin-bottom: 15px;">Suggestions For You</h3>
            <?php foreach ($suggestions as $suggestion): ?>
            <div class="suggestion-item">
                <img src="<?php echo htmlspecialchars($suggestion['avatar_path']); ?>" alt="Avatar">
                <div>
                    <p class="username"><?php echo htmlspecialchars($suggestion['username']); ?></p>
                    <p style="color:#8e8e8e; font-size: 12px;"><?php echo htmlspecialchars($suggestion['full_name']); ?></p>
                </div>
                <a href="#" class="follow-btn">Follow</a>
            </div>
            <?php endforeach; ?>
        </div>
    </aside>
</main>
</body></html>
