const grading = document.querySelector("#grading");

let lastValidGrading = null;

grading.addEventListener("input", (e) => {
  if (e.currentTarget.value === "") {
    e.currentTarget.value = lastValidGrading ?? null;
    return;
  }

  if (
    e.currentTarget.valueAsNumber < 1 ||
    e.currentTarget.valueAsNumber > 100
  ) {
    e.currentTarget.value = lastValidGrading ?? null;
    return;
  }

  if (e.currentTarget) lastValidGrading = e.currentTarget.value;
});
