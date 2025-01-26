<?php
include '../data/db.php';
$group_id = $_POST['group_id'];
$student_id = $_POST['student_id'];
// exception handling
if (empty($group_id) || empty($student_id)) {
    // return to the group details page with an error message (viewGroupDetails.php)
    header('Location: ../pages/viewGroupDetails.php?id=' . $group_id);
    return;
}
// Check if student is already in group
$group_students = getGroupStudents();
foreach ($group_students as $group_student) {
    if ($group_student['group_id'] == $group_id && $group_student['student_id'] == $student_id) {
        header('Location: ../pages/viewGroupDetails.php?id=' . $group_id);
    return;
    }
}

// Add student to group
$stmt = $db->prepare('INSERT INTO group_students (group_id, student_id) VALUES (:group_id, :student_id)');
$stmt->bindValue(':group_id', $group_id, SQLITE3_INTEGER);
$stmt->bindValue(':student_id', $student_id, SQLITE3_INTEGER);
$stmt->execute();
header('Location: ../pages/viewGroupDetails.php?id=' . $group_id);

?>