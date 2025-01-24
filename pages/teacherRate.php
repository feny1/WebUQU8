<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Teacher Rating: name</title>
  <link rel="stylesheet" href="../styles/teacherRate.css" />
  <script src="./index.js" defer></script>
</head>

<body>
  <form action="#" method="post">
    <h1>تقييم المجموعة: رقم المجموعة</h1>
    <div class="rate">
      <label class="rate-title" for="interaction">
        التواصل بين أعضاء المجموعة :
      </label>
      <div class="content">
        <input
          type="radio"
          name="interaction"
          id="interactionLow"
          value="low"
          required />
        <label for="interactionLow">منخفض</label>
        <input
          type="radio"
          name="interaction"
          id="interactionMedium"
          value="medium" />
        <label for="interactionMedium">متوسط</label>
        <input
          type="radio"
          name="interaction"
          id="interactionHigh"
          value="high" />
        <label for="interactionHigh">مرتفع</label>
      </div>
    </div>

    <div class="rate">
      <label class="rate-title" for="quality">جودة المتطلب النهائي:</label>
      <div class="content">
        <input type="radio" name="quality" id="qualityLow" value="low" />
        <label for="qualityLow">منخفض</label>
        <input
          type="radio"
          name="quality"
          id="qualityMedium"
          value="medium"
          required />
        <label for="qualityMedium">متوسط</label>
        <input type="radio" name="quality" id="qualityHigh" value="high" />
        <label for="qualityHigh">مرتفع</label>
      </div>
    </div>

    <!-- TODO: Group Grade -->
    <div class="grading">
      <label class="rate-title" for="grading">تقييم المجموعة :</label>
      <input type="number" name="grading" id="grading" min="0" max="100" />
    </div>
    <label for="feedback">اكتب تقييمك :</label>
    <textarea
      name="feedback"
      id="feedback"
      placeholder="إكتب تقييمك لأداء المجموعة"></textarea>

    <button type="submit">أرسل</button>
  </form>
</body>

</html>

<!-- Education and experience 
Whether classroom environments are uniquely conducive
to learning and achievement at high levels Capacity to create positive
relationships with students Effective use of assessment to drive instructional
planning Ability to differentiate instructional techniques to reach and teach
linguistically and culturally diverse students and students with learning and
behavioral challenges Communication of high expectations of achievement for all
students Collaboration with colleagues and communication with families
Participation in high quality professional learning -->