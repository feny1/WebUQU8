<?php 
include '../data/db.php';
// get classes if the user is a teacher
if ($user['role'] == 'teacher') {
  $classes = getTeacherClasses($user['id']);
} else {
  $classes = getClasses();
}

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>عرض الفصول</title>
  <link rel="stylesheet" href="../styles/viewClasses.css" />
</head>

<body>
  <?php include "../components/navbar.php" ?>

  <h1 class="heading">الفصول الدراسية</h1>

  <main class="container">
    <?php foreach ($classes as $class) { ?>
      <a href="./viewGroups.php?id=<?php echo $class['id']; ?>" class="classroom">
        <h2 class="title"><?php echo $class['title']; ?></h2>
        <p class="desc"><?php echo $class['description']; ?></p>
        <p class="limit">الحد الأقصى للطلاب: <?php echo $class['limit']; ?></p>
        <p class="teacher">المعلم: <?php echo getTeacher($class['teacher_id'])['name']; ?></p>
      </a>
    <?php } ?>
  </main>
</body>

</html>