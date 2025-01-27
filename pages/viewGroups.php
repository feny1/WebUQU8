<?php
include '../data/db.php';

if (!isset($user)) {
  header('Location: ./');
  exit;
}
include '../actions/joinClass.php';

$class = $_GET['id'] ?? null;
$_groups = getGroups();
$groups = [];
$classes = getClasses();
if (isset($class)) {
  $title = $classes[$class - 1]['title'];
  foreach ($_groups as $group) {
    if ($group['class_id'] == $class) {
      $groups[] = $group;
    }
  }
} elseif ($user['role'] == 'teacher') {
  $title = $user['name'];
  $groups = getTeacherGroups($user['id']);
} else {
  $title = $user['name'];
  $user_id = $user['id'];
  $group_students = getGroupStudents();
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
    <!-- Class details -->
    <?php if (isset($class)) { ?>
      <div class="group first">
        <h2 class="title"><?php echo $classes[$class - 1]['title']; ?></h2>
        <p class="desc">الوصف: <?php echo $classes[$class - 1]['description']; ?></p>
        <!-- Students total -->
        <p class="students">عدد الطلاب: <?php echo count(getStudentsByClassId($class)); ?></p>
        <!-- Group total -->
        <p class="groups">عدد المجموعات: <?php echo count($groups); ?></p>
        <!-- Teacher name -->
        <p class="teacher">المعلم: <?php echo getTeacher($classes[$class - 1]['teacher_id'])['name']; ?></p>
      </div>
    <?php } ?>

    <?php foreach ($groups as $group) {
      $_group_students = getGroupStudentsByGroupId($group['id']);
    ?>
      <!-- If student is a member of the group, add a class "joined" -->

      <a href="./viewGroupDetails.php?id=<?php echo $group['id']; ?>" class="group <?php echo in_array($user['id'], array_column($_group_students, 'id')) ? 'joined' : ''; ?>">
        <h2 class="title"><?php echo $group['title']; ?></h2>
        <p class="desc"><?php echo $group['description']; ?></p>
        <p class="limit">الحد الأقصى للطلاب: <?php echo $group['limit']; ?></p>
        <p class="members">عدد الطلاب: <?php echo count(getGroupStudentsByGroupId($group['id'])); ?>/<?php echo $group['limit']; ?> </p>
        <!-- is full? red Full green not Full -->
        <p class="full <?php echo count(getGroupStudentsByGroupId($group['id'])) >= $group['limit'] ? 'red' : 'green'; ?>">
          <?php echo count(getGroupStudentsByGroupId($group['id'])) >= $group['limit'] ? 'ممتلئ' : 'غير ممتلئ'; ?>
        </p>
      </a>
    <?php } ?>
  </main>
</body>

</html>