const nameCell = document.getElementById("name");
const surnameCell = document.getElementById("surname")

const checkNameSurnameInput = (e) => {
    if(e.target.name === "name") {
        const textAlertName = document.querySelector(".inform-text-name")
        const NameCellSection = document.querySelector(".name-cell")
        if ((nameCell.value.length >= 50)) {
            textAlertName.innerHTML = "Imię jest za długie!"
            nameCell.value = ""
        } else if(nameCell.value.length < 3) {
            textAlertName.innerHTML = "Imię jest za krótkie!"
            nameCell.value = ""
        } else {
            textAlertName.innerHTML = ""
            console.log("git")
            return
        }
    } else if(e.target.name === "surname") {
        const textAlertSurname = document.querySelector(".inform-text-surname")
        const surnameCellSection = document.querySelector(".surname-cell")
        if ((surnameCell.value.length >= 50)) {
            textAlertSurname.innerHTML = "Nazwisko jest za długie!"
            surnameCell.value = ""
        } else if(surnameCell.value.length <= 2) {
            textAlertSurname.innerHTML = "Nazwisko jest za krótkie!"
            surnameCell.value = ""
        } else {
            textAlertSurname.innerHTML = ""
            console.log("git")
            return
        }
    }
}


DataInputs = [nameCell, surnameCell]
DataInputs.forEach((input) => {
    input.addEventListener("blur", checkNameSurnameInput)
})

