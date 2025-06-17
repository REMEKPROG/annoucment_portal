const warningButton = document.querySelector(".deleteButton")
const returnButton = document.querySelector(".return");
const warningBlock = document.querySelector(".warning-information-annoucment")

const showWarningDiv = (e) => {
    warningBlock.style.display = "block";
}

const returnToIndex = () => {
    warningBlock.style.display = "none";
}

returnButton.addEventListener("click", returnToIndex)
warningButton.addEventListener("click", showWarningDiv)