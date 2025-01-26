<?php
include_once('./data/test_data.php');
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/index.css">
</head>

<body>
    <?php include_once './components/navbar.php'; ?>

    <main>
        <div>
            <h1>حافظ على تنظيم <br /> طلابك</h1>
            <div class="direct-link">
                <?php if (!isset($_SESSION["user"])): ?>
                    <a href="#">تسجيل الدخول</a>
                    <a href="#">تسجيل جديد</a>
                <?php else: ?>
                    <a href="./pages/viewGroups.php">مجموعاتي</a>
                <?php endif ?>
            </div>
        </div>
    </main>
</body>

</html>