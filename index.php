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
    <h1>Organize your groups <br /> effeciently</h1>
    <?php if (isset($_SESSION["user"])): ?>
        <a href="#">signIn</a>
        <a href="#">signUp</a>
    <?php else: ?>
        <a href="#">My Groups</a>
    <?php endif ?>
</body>

</html>