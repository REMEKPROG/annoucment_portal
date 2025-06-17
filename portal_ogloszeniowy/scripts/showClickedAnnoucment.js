const inputAsLabel = [...document.querySelectorAll(".select-input")]
const inputs = [...document.querySelectorAll(".input-select-annoucment")]
const deleteButton = document.querySelector(".deleteButton");

function checkButtonActivity() {
    const inputsLength = inputs.length

    for(let i = 0; i < inputsLength; i++) {
        if (inputs[i].dataset.active == "false") {
            deleteButton.disabled = true;
            deleteButton.classList.add("disabled-button")
            continue;
        } else {
            deleteButton.disabled = false;
            deleteButton.classList.remove("disabled-button")
            break;
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    checkButtonActivity();
})


const animateAnnoucmentBox = (e) => {
    const annoucmentBox = e.target.parentNode;
    const input = e.target.nextElementSibling;
    const inputStatus = input.dataset.active;
    if (inputStatus === "false") {
        annoucmentBox.classList.add("clicked-annoucment");
        input.dataset.active = "true";
    } else {
        annoucmentBox.classList.remove("clicked-annoucment");
        input.dataset.active = "false";
    }

    checkButtonActivity();

}


inputAsLabel.forEach((input) => {
    input.addEventListener("click", animateAnnoucmentBox);
})