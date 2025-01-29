<?php
include "../data/db.php";
if (!isset($_SESSION['user'])) {
  header("location:index.php");
  exit();
}
$user = $_SESSION['user'];
$userClasses = getClasses();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $user['name']; ?> صفحة</title>
  <link rel="stylesheet" href="../styles/profile.css">
</head>

<body>
  <?php include "../components/navbar.php" ?>
  <h1 class="title">أهلاً <?php echo $user['name'] ?></h1>
  <p>الإيميل: <?php echo $user['email'] ?></p>
  <?php if (count($userClasses) == 0): ?>
    <h2 class="not-in-class"><?php echo  $user["role"] == 'student' ? "أنت لست منضماً لأي فصل" : "لم تنشئ أي فصل" ?></h2>
  <?php else: ?>
    <h2 class="in-class">
      <?php echo $user["role"] == "student" ? "الفصول التي أنت منضم لها الآن" : "الفصول التي أنشأتها" ?></h2>
  <?php endif ?>
  <div class="classes">
    <?php foreach ($userClasses as $class): ?>
      <a class="group" href="../pages/viewGroups.php?id=<?php echo $class['id'] ?>">
        <h3><?php echo $class['title'] ?></h3>
        <p>عدد الأعضاء: <?php echo count(getStudentsByClassId($class['id'])) ?></p>
        <p><?php echo 'المعلم: ' . getTeacher($class["teacher_id"])["name"] ?></p>
      </a>

    <?php endforeach ?>

  </div>
</body>

</html>