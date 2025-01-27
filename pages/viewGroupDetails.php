<?php
include '../data/db.php';
$group = $_GET['id'];
// Get group details
$group = getGroup($group);
// Get all group students
$members = getGroupStudentsByGroupId($group['id']);
// get class
$class = getClassByGroupId($group['id']);
// get all students in the class
$students = getStudentsByClassId($class['id']);



?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $group['title']; ?>
    </title>
    <link rel="stylesheet" href="../styles/viewGroup.css">
</head>

<body>
    <?php include "../components/navbar.php" ?>
    <!-- show group details as a card -->
    <main class="container">
        <div class="group">
            <h1 class="title">
                <?php echo $group['title']; ?>
            </h1>
            <p class="desc">
                <?php echo $group['description']; ?>
            </p>
            <p class="limit">
                الحد الأقصى للطلاب:
                <?php echo $group['limit']; ?>
            </p>
            <p class="members">
                عدد الطلاب:
                <?php echo count($members); ?>
            </p>
        </div>
        <!-- show group members as a list -->
        <div class="members group">
            <h2>الطلاب</h2>
            <ul>
                <?php foreach ($members as $member) : ?>
                    <li>
                        <?php echo $member['name']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="group">
            <h1 class="title">
                التقييم
            </h1>
            <p class="limit">
                التواصل: <?php echo $group['interaction']??'-'; ?>/3
            </p>
            <p class="limit">
                الجودة: <?php echo $group['quality']??'-'; ?>/3
            </p>
            <p class="limit">
                التقييم: <?php echo $group['grading']??'-'; ?>/100
            </p>
            <p class="desc">
                مراجعة:<br>&ThickSpace;<?php echo $group['feedback']??'-'; ?>
            </p>
            <?php if($user['role'] === 'teacher'){?>
                <a href="../pages/teacherRate.php?id=<?php echo $group['id'];?>">تقييم</a>
            <?php } ?>
        </div>

    </main>

    <!-- if the user is a student, show the join group form only if the group is not full and the user is not a member of any group in the class -->
    <?php if ($user['role'] == 'student' && count($members) < $group['limit'] && !in_array($user['id'], array_column($students, 'id'))    ) : ?>
        <form action="../actions/joinGroup.php" method="post">
            <input type="hidden" name="group_id" value="<?php echo $group['id']; ?>">
            <input type="hidden" name="student_id" value="<?php echo $user['id']; ?>">
            <button type="submit" class="join">Join Group</button>
        </form>
    <?php endif; ?>
    <!-- if the user is a student, show the leave group form only if the user is a member of the group -->
    <?php if ($user['role'] == 'student' && in_array($user['id'], array_column($members, 'id'))) : ?>
        <form action="../actions/leaveGroup.php" method="post">
            <input type="hidden" name="group_id" value="<?php echo $group['id']; ?>">
            <input type="hidden" name="student_id" value="<?php echo $user['id']; ?>">
            <button type="submit" class="leave">Leave Group</button>
        </form>
    <?php endif; ?>
    <button onclick="history.back()" class="back">Back</button>
</body>

</html>