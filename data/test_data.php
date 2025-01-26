<?php
// Example 4 students data and 3 teachers data in the same array with id, name, and role

session_start();


$user = $_SESSION['user'] ?? null;

$users = [
    ['id' => 1, 'name' => 'John Doe', 'role' => 'Student'],
    ['id' => 2, 'name' => 'Jane Doe', 'role' => 'Student'],
    ['id' => 3, 'name' => 'Jim Doe', 'role' => 'Student'],
    ['id' => 4, 'name' => 'Jill Doe', 'role' => 'Student'],
    ['id' => 5, 'name' => 'Jack Doe', 'role' => 'Teacher'],
    ['id' => 6, 'name' => 'Jenny Doe', 'role' => 'Teacher'],
    ['id' => 7, 'name' => 'Jared Doe', 'role' => 'Teacher']
];
// Example 2 classes data with id, title, description, and limit
$classes = [
    ['id' => 1, 'title' => 'Networks', 'description' => 'Networks class', 'limit' => 40],
    ['id' => 2, 'title' => 'Databases', 'description' => 'Databases class', 'limit' => 30]
];
// (Example 3 groups data with id, title, description, limit, members, class_id, and teacher_id) for each class
$_groups = [
    ['id' => 1, 'title' => 'Group 1', 'description' => 'Group 1 description', 'limit' => 10, 'members' => 5, 'class_id' => 1, 'teacher_id' => 5],
    ['id' => 2, 'title' => 'Group 2', 'description' => 'Group 2 description', 'limit' => 10, 'members' => 5, 'class_id' => 1, 'teacher_id' => 6],
    ['id' => 3, 'title' => 'Group 3', 'description' => 'Group 3 description', 'limit' => 10, 'members' => 5, 'class_id' => 1, 'teacher_id' => 7],
    ['id' => 4, 'title' => 'Group 1', 'description' => 'Group 1 description', 'limit' => 10, 'members' => 5, 'class_id' => 2, 'teacher_id' => 5],
    ['id' => 5, 'title' => 'Group 2', 'description' => 'Group 2 description', 'limit' => 10, 'members' => 5, 'class_id' => 2, 'teacher_id' => 6],
    ['id' => 6, 'title' => 'Group 3', 'description' => 'Group 3 description', 'limit' => 10, 'members' => 5, 'class_id' => 2, 'teacher_id' => 7]
];

function getGroup($id)
{
    global $_groups;
    foreach ($_groups as $group) {
        if ($group['id'] == $id) return $group;
    }
}

// Example join group/student data with group_id and student_id
$group_students = [
    ['group_id' => 1, 'student_id' => 1],
    ['group_id' => 1, 'student_id' => 2],
    ['group_id' => 1, 'student_id' => 3],
    ['group_id' => 1, 'student_id' => 4],
    ['group_id' => 1, 'student_id' => 5],
    ['group_id' => 2, 'student_id' => 1],
    ['group_id' => 2, 'student_id' => 2],
    ['group_id' => 2, 'student_id' => 3],
    ['group_id' => 2, 'student_id' => 4],
    ['group_id' => 2, 'student_id' => 5],
    ['group_id' => 3, 'student_id' => 1],
    ['group_id' => 3, 'student_id' => 2],
    ['group_id' => 3, 'student_id' => 3],
    ['group_id' => 3, 'student_id' => 4],
    ['group_id' => 3, 'student_id' => 5],
    ['group_id' => 4, 'student_id' => 1],
    ['group_id' => 4, 'student_id' => 2],
    ['group_id' => 4, 'student_id' => 3],
    ['group_id' => 4, 'student_id' => 4],
    ['group_id' => 4, 'student_id' => 5],
    ['group_id' => 5, 'student_id' => 1],
    ['group_id' => 5, 'student_id' => 2],
    ['group_id' => 5, 'student_id' => 3],
    ['group_id' => 5, 'student_id' => 4],
    ['group_id' => 5, 'student_id' => 5],
    ['group_id' => 6, 'student_id' => 1],
    ['group_id' => 6, 'student_id' => 2],
    ['group_id' => 6, 'student_id' => 3],
    ['group_id' => 6, 'student_id' => 4],
    ['group_id' => 6, 'student_id' => 5]
];
