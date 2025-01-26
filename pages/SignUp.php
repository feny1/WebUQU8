<?php
include '../data/db.php';
// add user check if email exists
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = $_POST['role'];
  $name = $_POST['name'];
  $user = getUserByEmail($email);
  if ($user) {
    echo 'البريد الإلكتروني موجود بالفعل';
  } else {
    $db->exec("INSERT INTO users (name,email, password, role) VALUES ('$name','$email', '$password', '$role')");
    header('Location: SignIn.php');
  }
}
?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>صفحة التسجيل</title>
  <link rel="stylesheet" href="../styles/SignUp.css" />
</head>

<body>
  <?php include "../components/backButton.php" ?>
  <div class="signup-container">
    <h2>التسجيل</h2>
    <form action="#" method="POST">
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
        <label for="name">الاسم</label>
        <input
          type="text"
          id="name"
          name="name"
          placeholder="أدخل اسمك"
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
        <label>الهوية</label>
        <div class="radio-group">
          <label>
            <input type="radio" name="role" value="student" required />
            طالب
          </label>
          <label>
            <input type="radio" name="role" value="teacher" required />
            موجه
          </label>
        </div>
      </div>
      <div class="form-group">
        <button type="submit">سجل</button>
      </div>
    </form>
    <div class="signin-button">
      <a href="SignIn.php">تسجيل الدخول</a>
    </div>
  </div>
</body>

</html>