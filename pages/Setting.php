<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>الإعدادات</title>
  <link rel="stylesheet" href="../styles/Setting.css" />
</head>

<body>
  <?php include "../components/backButton.php" ?>

  <div class="box">
    <h1>الإعدادات</h1>
    <p>
      في هذه الصفحة يمكنك تعديل معلوماتك
      <br />
      وأيضًا التواصل مع المعلم بسهولة
    </p>

    <div class="buttons">
      <button class="edit" onclick="showEditSection()">تعديل معلومات</button>
      <button
        class="logout"
        onclick="window.location.href= ('../data/logout.php')">
        تسجيل خروج
      </button>
    </div>

    <div class="edit-section" id="edit-section">
      <label for="username">تعديل اسم المستخدم:</label>
      <br />
      <input
        type="text"
        id="username"
        placeholder="أدخل اسم المستخدم"
        required />
      <br />
      <button onclick="saveChanges()">حفظ التعديلات</button>
    </div>

    <div class="link">
      <a href="#">تواصل مع المعلم</a>
    </div>
  </div>

  <script>
    function showEditSection() {
      const editSection = document.getElementById("edit-section");
      editSection.style.display = "block";
    }

    document.getElementById("username").addEventListener("input", (e) => {
      if (e.currentTarget.value.length > 20) {
        e.currentTarget.value = e.currentTarget.value.slice(0, 20);
        e.currentTarget.style.outline = "1px solid red";
      }

      if (e.currentTarget.value.length < 20) {
        e.currentTarget.style.outline = "1px solid gray";
      }
    });

    function saveChanges() {
      const usernameInput = document.getElementById("username");

      if (usernameInput.value === "") {
        usernameInput.style.border = "1px solid red";
        return;
      }
      alert("تم حفظ اسم المستخدم: " + usernameInput.value);
    }
  </script>
</body>

</html>