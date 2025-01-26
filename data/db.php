<?php
session_start();
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
    "limit" INTEGER
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
?>
