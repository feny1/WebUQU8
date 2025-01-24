<?php
include "../data/test_data.php";
$class = $_GET['id'];
$groups = [];
foreach ($_groups as $group) {
  if ($group['class_id'] == $class) {
    $groups[] = $group;
  }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    <?php echo $classes[$class-1]['title']; ?> القروبات
  </title>
  <link rel="stylesheet" href="../styles/viewGroups.css" />
</head>

<body>
  <?php include "../components/navbar.php" ?>

  <h1 class="heading">
   ( 
    <?php echo $classes[$class-1]['title']; ?>
   ) القروبات
  </h1>

  <main class="container">
    <?php foreach ($groups as $group) { ?>
        <a href="#" class="group">
          <h2 class="title"><?php echo $group['title']; ?></h2>
          <p class="desc"><?php echo $group['description']; ?></p>
          <p class="limit">الحد الأقصى للطلاب: <?php echo $group['limit']; ?></p>
          <p class="members">عدد الطلاب: <?php echo $group['members']; ?></p>
          <p class="teacher">المعلم: <?php echo $users[$group['teacher_id'] - 1]['name']; ?></p>
        </a>
    <?php } ?>
  </main>
</body>

</html>