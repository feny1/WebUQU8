<?php
// session_start();
// Example user data
$_SESSION['user'] = [
  'username' => 'John Doe',
  'role' => 'Admin'
];
$loggedIn = isset($_SESSION['user']);
?>

<head>
  <link rel="stylesheet" href="../styles/navbar.css">
</head>
<header>
  <?php if ($loggedIn) { ?>
    <div class="user">
      <img src="../images/purple2.png" alt="user image" />
      <div class="info">
        <h2 class="username"><?php echo $_SESSION['user']['username']; ?></h2>
        <p class="role"><?php echo $_SESSION['user']['role']; ?></p>
      </div>
    </div>
    <nav>
      <a href="../pages/viewClasses.php">الفصول</a>
      <a href="../pages/Setting.html">الإعدادات</a>
    </nav>
  <?php } else { ?>
    <nav class="login">
      <div>
        <a href="../index.php">الرئيسية</a>
      </div>
      <div>
        <a href="../pages/SignUp.html">التسجيل</a>
        <a href="../pages/SignIn.html">الدخول</a>
      </div>

    </nav>
  <?php } ?>
</header>