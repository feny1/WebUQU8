<?php
include('../data/db.php');

$group_id = $_GET['id'] ?? null;
// Validate group ID
if (!$group_id || !is_numeric($group_id)) {
    die("Invalid group ID");
}

// Fetch group details
$group = getGroup($group_id);
if (!$group) {
    die("Group not found");
}

// Fetch class details
$class = getClassByGroupId($group['id'] ?? null);
if (!$class) {
    die("Class not found");
}

// Fetch teacher details
$teacher = getTeacher($class['teacher_id'] ?? null);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize input values
    $interaction = intval($_POST['interaction'] ?? 0);
    $quality = intval($_POST['quality'] ?? 0);
    $grading = intval($_POST['grading'] ?? 0);
    $feedback = htmlspecialchars($_POST['feedback'] ?? '', ENT_QUOTES, 'UTF-8');

    // Use a prepared statement to prevent SQL injection
    $stmt = $db->prepare("
        UPDATE groups
        SET interaction = :interaction,
            quality = :quality,
            grading = :grading,
            feedback = :feedback
        WHERE id = :group_id
    ");

    // Bind parameters
    $stmt->bindValue(':interaction', $interaction, SQLITE3_INTEGER);
    $stmt->bindValue(':quality', $quality, SQLITE3_INTEGER);
    $stmt->bindValue(':grading', $grading, SQLITE3_INTEGER);
    $stmt->bindValue(':feedback', $feedback, SQLITE3_TEXT);
    $stmt->bindValue(':group_id', $group_id, SQLITE3_INTEGER);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to group details page
        header("Location: ../pages/viewGroupDetails.php?id=" . urlencode($group_id));
        exit();
    } else {
        echo "Error updating group details.";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>تقييم المجموعة: <?php echo $teacher['name']; ?></title>
  <link rel="stylesheet" href="../styles/teacherRate.css" />
  <script src="../index.js" defer></script>
</head>

<body>
  <form action="?id=<?php echo $group['id'];?>" method="post">
    <h1>تقييم المجموعة: <?php echo $class['title'] . ' ' . $group['title']?></h1>
    <div class="rate">
      <label class="rate-title" for="interaction">
        التواصل بين أعضاء المجموعة :
      </label>
      <div class="content">
        <input
          type="radio"
          name="interaction"
          id="interactionLow"
          value="1"
          required />
        <label for="interactionLow">منخفض</label>
        <input
          type="radio"
          name="interaction"
          id="interactionMedium"
          value="2" />
        <label for="interactionMedium">متوسط</label>
        <input
          type="radio"
          name="interaction"
          id="interactionHigh"
          value="3" />
        <label for="interactionHigh">مرتفع</label>
      </div>
    </div>

    <div class="rate">
      <label class="rate-title" for="quality">جودة المتطلب النهائي:</label>
      <div class="content">
        <input type="radio" name="quality" id="qualityLow" value="1" />
        <label for="qualityLow">منخفض</label>
        <input
          type="radio"
          name="quality"
          id="qualityMedium"
          value="2"
          required />
        <label for="qualityMedium">متوسط</label>
        <input type="radio" name="quality" id="qualityHigh" value="3" />
        <label for="qualityHigh">مرتفع</label>
      </div>
    </div>

    <!-- TODO: Group Grade -->
    <div class="grading">
      <label class="rate-title" for="grading">تقييم المجموعة :</label>
      <input type="number" name="grading" id="grading" min="0" max="100" />
    </div>
    <label for="feedback">اكتب تقييمك :</label>
    <textarea
      name="feedback"
      id="feedback"
      placeholder="إكتب تقييمك لأداء المجموعة"></textarea>

    <button type="submit">أرسل</button>
  </form>
</body>

</html>

<!-- Education and experience 
Whether classroom environments are uniquely conducive
to learning and achievement at high levels Capacity to create positive
relationships with students Effective use of assessment to drive instructional
planning Ability to differentiate instructional techniques to reach and teach
linguistically and culturally diverse students and students with learning and
behavioral challenges Communication of high expectations of achievement for all
students Collaboration with colleagues and communication with families
Participation in high quality professional learning -->