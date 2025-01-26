<?php
include "../data/test_data.php";
$group = $_GET['id'];
$members = [];
foreach ($group_students as $group_student) {
    if ($group_student['group_id'] == $group) {
        $members[] = $group_student;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>