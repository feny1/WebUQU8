<?php
include('../data/test_data.php');
$_SESSION['user'] = [
  'id' => 1,
  'name' => 'John Doe',
  'role' => 'Admin'
];
$user = $_SESSION['user'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>صحفة تسجيل الدخول</title>
  <link rel="stylesheet" href="../styles/SignIn.css" />
</head>

<body>
  <?php include "../components/backButton.php" ?>
  <div class="signin-container">
    <h2>تسجيل الدخول</h2>
    <form action="/submit" method="POST">
      <div class="form-group">
        <label for="email">البريد الإلكتروني</label>
        <input
          type="email"
          id="email"
          name="email"
          placeholder="أدخل بريدك الإلكتروني"
          required />
      </div>
      <div class="form-group">
        <label for="password">كلمة المرور</label>
        <input
          type="password"
          id="password"
          name="password"
          placeholder="أدخل كلمة المرور"
          required />
      </div>

      <div class="form-group">
        <button type="submit">سجل الدخول</button>
      </div>
    </form>
    <div class="signup-button">
      <a href="SignUp.php">ليس لديك حساب؟ سارع في التسجيل</a>
    </div>
  </div>
</body>

</html>