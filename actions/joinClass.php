<?php
$class_id = $_GET['id'] ?? null;
$student_id = $user['id'];
// Check if student is already in group
$class_students = getClassStudents();
$joined = false;
foreach ($class_students as $student) {
    if ($student['class_id'] == $class_id && $student['student_id'] == $student_id) {
        $joined = true;
    }
}

// Add student to group
if (!$joined && $user['role'] === 'student') {
    $stmt = $db->prepare('INSERT INTO class_students (class_id, student_id) VALUES (:class_id, :student_id)');
    $stmt->bindValue(':class_id', $class_id, SQLITE3_INTEGER);
    $stmt->bindValue(':student_id', $student_id, SQLITE3_INTEGER);
    $stmt->execute();
}
