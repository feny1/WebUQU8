const grading = document.querySelector("#grading");

let lastValidGrading = 0;

grading.addEventListener("input", (e) => {
  if (lastValidGrading === 0) {
    e.currentTarget.value = e.data;
  }

  if (e.inputType === "deleteContentBackward" && e.currentTarget.value === "") {
    e.currentTarget.value = 0;
    lastValidGrading = 0;
    return;
  }

  if (e.currentTarget.value === "") {
    e.currentTarget.value = lastValidGrading ?? null;
    return;
  }

  if (
    e.currentTarget.valueAsNumber < 1 ||
    e.currentTarget.valueAsNumber > 100
  ) {
    e.currentTarget.value = Number.parseInt(lastValidGrading) ?? null;
    return;
  }

  lastValidGrading = e.currentTarget.value;
});
