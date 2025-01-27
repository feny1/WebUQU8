<?php
session_start();
$user = $_SESSION['user'] ?? null;
// Use SQLite database and create if not exists
$db = new SQLite3('../data/database.db');

// Create tables if not exist
$db->exec('CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY, 
    name TEXT, 
    email TEXT UNIQUE, 
    password TEXT UNIQUE, 
    role TEXT
)');

$db->exec('CREATE TABLE IF NOT EXISTS classes (
    id INTEGER PRIMARY KEY, 
    title TEXT, 
    description TEXT, 
    "limit" INTEGER,
    teacher_id INTEGER
)');
$db->exec('CREATE TABLE IF NOT EXISTS groups (
    id INTEGER PRIMARY KEY, 
    title TEXT, 
    description TEXT, 
    "limit" INTEGER, 
    members INTEGER, 
    class_id INTEGER,    
    teacher_id INTEGER
)');
$db->exec('CREATE TABLE IF NOT EXISTS group_students (
    group_id INTEGER, 
    student_id INTEGER
)');

// get all groups from the database
function getGroups()
{
    global $db;

    $result = $db->query('SELECT * FROM groups');

    $groups = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $groups[] = $row;
    }

    return $groups;
}

// get all group students from the database
function getGroupStudents()
{
    global $db;

    $result = $db->query('SELECT * FROM group_students');

    $group_students = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $group_students[] = $row;
    }

    return $group_students;
}

// get group by id
function getGroup($id)
{
    global $db;

    $stmt = $db->prepare('SELECT * FROM groups WHERE id = :id');
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

    $result = $stmt->execute();

    if ($result) {
        return $result->fetchArray(SQLITE3_ASSOC);
    }

    return null;
}

// get all classes from the database
function getClasses()
{
    global $db;

    $result = $db->query('SELECT * FROM classes');

    $classes = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $classes[] = $row;
    }

    return $classes;
}


// get all teacher groups from the database
function getTeacherGroups($teacher_id)
{
    global $db;

    $stmt = $db->prepare('SELECT * FROM groups WHERE teacher_id = :teacher_id');
    $stmt->bindValue(':teacher_id', $teacher_id, SQLITE3_INTEGER);

    $result = $stmt->execute();

    $groups = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $groups[] = $row;
    }

    return $groups;
}

// get all teacher classes from the database
function getTeacherClasses($teacher_id)
{
    global $db;

    $stmt = $db->prepare('SELECT * FROM classes WHERE teacher_id = :teacher_id');
    $stmt->bindValue(':teacher_id', $teacher_id, SQLITE3_INTEGER);

    $result = $stmt->execute();

    $classes = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $classes[] = $row;
    }

    return $classes;
}

// get teacher by id
function getTeacher($id)
{
    global $db;

    $stmt = $db->prepare('SELECT * FROM users WHERE id = :id');
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

    $result = $stmt->execute();

    if ($result) {
        return $result->fetchArray(SQLITE3_ASSOC);
    }

    return null;
}

// get all students from the database
function getStudents()
{
    global $db;

    $result = $db->query('SELECT * FROM users WHERE role = "student"');

    $students = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $students[] = $row;
    }

    return $students;
}

// get student by id
function getStudent($id)
{
    global $db;

    $stmt = $db->prepare('SELECT * FROM users WHERE id = :id AND role = "student"');
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

    $result = $stmt->execute();

    if ($result) {
        return $result->fetchArray(SQLITE3_ASSOC);
    }

    return null;
}

// get all students in a group
function getGroupStudentsByGroupId($group_id)
{
    global $db;

    $stmt = $db->prepare('SELECT * FROM group_students WHERE group_id = :group_id');
    $stmt->bindValue(':group_id', $group_id, SQLITE3_INTEGER);

    $result = $stmt->execute();

    $students = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $students[] = getStudent($row['student_id']);
    }

    return $students;
}

// get all students in a class
function getStudentsByClassId($class_id)
{
    global $db;

    $stmt = $db->prepare('SELECT * FROM classes WHERE id = :id');
    $stmt->bindValue(':id', $class_id, SQLITE3_INTEGER);

    $result = $stmt->execute();

    $class = $result->fetchArray(SQLITE3_ASSOC);

    $stmt = $db->prepare('SELECT * FROM groups WHERE class_id = :class
    ');
    $stmt->bindValue(':class', $class_id, SQLITE3_INTEGER);

    $result = $stmt->execute();

    $groups = [];

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $groups[] = $row;
    }

    $students = [];

    foreach ($groups as $group) {
        $students = array_merge($students, getGroupStudentsByGroupId($group['id']));
    }

    return $students;
}
// get class by group id
function getClassByGroupId($group_id)
{
    global $db;

    $group = getGroup($group_id);

    $stmt = $db->prepare('SELECT * FROM classes WHERE id = :id');
    $stmt->bindValue(':id', $group['class_id'], SQLITE3_INTEGER);

    $result = $stmt->execute();

    if ($result) {
        return $result->fetchArray(SQLITE3_ASSOC);
    }

    return null;
}

// Function to get user by email
function getUserByEmail($email)
{
    global $db;

    // Prepare the statement to prevent SQL injection
    $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);

    $result = $stmt->execute();

    if ($result) {
        return $result->fetchArray(SQLITE3_ASSOC);
    }

    return null; // Return null if no user found
}
