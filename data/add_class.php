<?php
include 'db.php'; 
// add class
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $limit = $_POST['limit'];
    $class_id = $_POST['class_id'];
    $teacher_id = $_POST['teacher_id'];
    $db->exec("INSERT INTO groups (title, description, limit, class_id, teacher_id) VALUES ('$title', '$description', $limit, $class_id, $teacher_id)");
    header('Location: ../index.php');
}
?>