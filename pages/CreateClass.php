<?php 
include '../data/db.php';
$user = $_SESSION['user']??null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $limit = $_POST['limit'];
  $teacher_id = $_POST['teacher_id'];
  $students = $_POST['students'];
  $stmt = $db->prepare('INSERT INTO classes (title, description, "limit", teacher_id) VALUES (:title, :description, :limit, :teacher_id)');
  $stmt->bindValue(':title', $title);
  $stmt->bindValue(':description', $description);
  $stmt->bindValue(':limit', $limit);
  $stmt->bindValue(':teacher_id', $teacher_id);
  $stmt->execute();
  //auto create groups for the class depending on the limit
  $class_id = $db->lastInsertRowID();
  for ($i = 1; $i <= $limit; $i++) {
    $stmt = $db->prepare('INSERT INTO groups (title, description, "limit", class_id) VALUES (:title, :description, :limit, :class_id)');
    $stmt->bindValue(':title', "مجموعة $i");
    $stmt->bindValue(':description', "مجموعة $i");
    $stmt->bindValue(':limit', $students);
    $stmt->bindValue(':class_id', $class_id);
    $stmt->execute();
  }

  header('Location: ./viewClasses.php');
}

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>إنشاء فصل جديد</title>
  <link rel="stylesheet" href="../styles/addClass.css" />
</head>

<body>
  <div class="container">
    <h1>إنشاء فصل جديد</h1>
    <p>قم بإدخال بيانات الفصل الدراسي الجديد</p>
    <!-- $db->exec('CREATE TABLE IF NOT EXISTS classes (
    id INTEGER PRIMARY KEY, 
    title TEXT, 
    description TEXT, 
    "limit" INTEGER,
    teacher_id INTEGER
)'); -->
    <form action="#" method="POST">
      <div class="form-group">
        <label for="title">العنوان</label>
        <input type="text" id="title" name="title" placeholder="أدخل عنوان الفصل" required />
      </div>
      <div class="form-group">
        <label for="description">الوصف</label>
        <textarea id="description" name="description" placeholder="أدخل وصف الفصل" required></textarea>
      </div>
      <div class="form-group">
        <label for="limit">الحد الأقصى للمجموعات</label>
        <input type="number" id="limit" name="limit" placeholder="أدخل الحد الأقصى للمجموعات" required />
      </div>
      <!-- max number of students in each group -->
      <div class="form-group">
        <label for="students">الحد الأقصى للطلاب في المجموعة</label>
        <input type="number" id="students" name="students" placeholder="أدخل الحد الأقصى للطلاب في المجموعة" required />
      </div>
      <!-- auto fill teacher_id -->
      <input type="hidden" name="teacher_id" value="<?php echo $user['id']; ?>" />
      <div class="form-group">
        <label for="teacher">المعلم</label>
        <input type="text" id="teacher" name="teacher" value="<?php echo $user['name']; ?>" disabled />
      </div>
      <button type="submit" class="btn">إنشاء</button>
    </form>
  </div>
</body>

</html>