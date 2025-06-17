const inputFile = document.getElementById("image-uploaded");


const changeImage = (e) => {
  const file = inputFile.files[0];

  if (file) {
    const reader = new FileReader();

    reader.onload = function(event) {
      const img = document.getElementById("image");
      const imageReview = document.getElementById("image-review");
      img.src = event.target.result;
      imageReview.src = event.target.result;
    };

    reader.readAsDataURL(file); // Konwertuje plik do base64
  }
};

const titleInput = document.getElementById("title-annoucment");

const changeTitleDynamic = (e) => {
  const titleInputValue = titleInput.value;
  const titleReview = document.querySelector(".title-review h1");
  titleReview.innerHTML = titleInputValue;
}

const contentsInput = document.getElementById("contents-annoucment");

const changeContentsDynamic = (e) => {
  const contentsInputValue = contentsInput.value;
  const contentsReview = document.querySelector(".contents-review p");
  contentsReview.innerHTML =  contentsInputValue;
}

contentsInput.addEventListener("input", changeContentsDynamic);
titleInput.addEventListener("input", changeTitleDynamic);
inputFile.addEventListener("change", changeImage);







