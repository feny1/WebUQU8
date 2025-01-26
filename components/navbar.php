<?php
// session_start();
// Example user data
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
        <h2 class="username"><?php echo $_SESSION['user']['name']; ?></h2>
        <p class="role"><?php echo $_SESSION['user']['role']; ?></p>
      </div>
    </div>
    <nav>
      <a href="../index.php">الرئيسية</a>
      <a href="../pages/viewClasses.php">الفصول</a>
      <a href="../pages/Setting.php">الإعدادات</a>
      <!-- if user is a teacher show create class link -->
      <?php if ($_SESSION['user']['role'] == 'teacher') { ?>
        <a href="../pages/CreateClass.php">إنشاء فصل</a>
      <?php } ?>
    </nav>
  <?php } else { ?>
    <nav class="login">
      <div>
        <a href="../index.php">الرئيسية</a>
      </div>
      <div>
        <a href="../pages/SignIn.php">تسجيل الدخول</a>
      </div>

    </nav>
  <?php } ?>
</header>