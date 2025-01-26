<?php
include "../data/test_data.php";
$class = $_GET['id'] ?? null;
$groups = [];
if (isset($class)) {
  $title = $classes[$class - 1]['title'];
  foreach ($_groups as $group) {
    if ($group['class_id'] == $class) {
      $groups[] = $group;
    }
  }
} else {
  $title = $user['name'];
  $user_id = $user['id'];
  foreach ($group_students as $group) {
    if ($group['student_id'] == $user_id) {
      $groups[] = getGroup($group['group_id']);
    }
  }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    <?php echo $title ?> مجموعات
  </title>
  <link rel="stylesheet" href="../styles/viewGroups.css" />
</head>

<body>
  <?php include "../components/navbar.php" ?>

  <h1 class="heading">
    مجموعات (
    <?php echo $title ?>
    )
  </h1>

  <main class="container">
    <?php foreach ($groups as $group) { ?>
      <a href="./viewGroupDetails.php?id=<?php echo $group['id']; ?>" class="group">
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