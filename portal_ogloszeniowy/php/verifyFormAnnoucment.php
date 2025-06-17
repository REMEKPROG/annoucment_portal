<?php


require "config.php";

session_start();

function ValidateInput($input) {
    header("refresh: 2; URL = ../template_user/addAnnoucment.php");
    exit("Pole $input zostało źle wypełnione!");
}

function scaleImage($originalPath, $newPath, $maxWidth, $maxHeight) {
    $imageData = getimagesize($originalPath);
    $originalWidth = $imageData[0];
    $originalHeight = $imageData[1];
    $imageType = $imageData["mime"];
    $newWidth = $maxWidth;
    $newHeight = $maxHeight;
    $originalProps = $originalWidth / $originalHeight;

    if($originalWidth > $originalHeight) {
        $newHeight = $newWidth / $originalProps;
    } else {
        $newWidth = $newHeight * $originalProps;
    }

    $originalImg = imagecreatefrompng($originalPath);
    $newImage = imagecreatetruecolor($newWidth, $newHeight);

    imagecopyresampled($newImage, $originalImg, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

    $img = imagepng($newImage, $newPath);

    return $img;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(!(empty($_POST["title"])) && mb_strlen($_POST["title"]) <= 30) {
        $annoucmentTitle = ucfirst(mb_strtolower(trim($_POST["title"])));
    } else {
        ValidateInput("tytuł");
    }
    if(!(empty($_POST["description"])) && mb_strlen($_POST["description"]) <= 80) {
        $description = ucfirst(trim($_POST["description"]));
    } else {
        ValidateInput("opis");
    }
    if(!(empty($_POST["contents"])) && mb_strlen($_POST["contents"]) <= 300) {
        $contents = ucfirst(trim($_POST["contents"]));
    }

    if($_FILES["image-uploaded"]["error"] === 0 && $_FILES["image-uploaded"]["size"] <= 5242880) {
        $allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];
        $imageType = mime_content_type($_FILES["image-uploaded"]["tmp_name"]);

        if (!in_array($imageType, $allowedTypes)) {
            exit("Nieobsługiwany format pliku!");
        }

        $image = pathinfo($_FILES["image-uploaded"]["name"], PATHINFO_FILENAME);
        $extension = pathinfo($_FILES["image-uploaded"]["name"], PATHINFO_EXTENSION);
        $image = preg_replace('/[^A-z0-9]/', '-', $image);
        $nameOfImg = $image . "." . $extension;

        $i = 0;
        while(file_exists("../img/img_users/" . $nameOfImg)) {
            $nameOfImg = $image . $i . "." . $extension;
            $i++;
        }
        $dir = "../img/img_users/" . $nameOfImg;

        $moveImage = move_uploaded_file($_FILES["image-uploaded"]["tmp_name"], $dir);

        if($moveImage) {
            $imgToDB = $dir;
            $scale = scaleImage($dir, $dir, 500, 600);
        } else {
            header("refresh: 3; URL = ../template_user/addAnnoucment.php");
            exit("Nie udało się przesłać zdjęcia:((");
        }

    } else {
        $imgToDB = "../img/brak_zdjecia.png";
    }

    try {

    $currentDate = date("Y-m-d H:i:s", time());

    $addAnnoucmentSQL = "INSERT INTO serwis_ogloszeniowy.annoucments(id_user, title, description, contents, img, date_added)
    VALUES(:id_user, :title, :description, :contents, :img, :date)";

    $addAnnoucment = $pdo->prepare($addAnnoucmentSQL);
    $addAnnoucment->execute([
        "id_user" => (int)$_SESSION["userId"],
        "title" => $annoucmentTitle,
        "description" => $description,
        "contents" => $contents,
        "img" => $imgToDB,
        "date" => $currentDate,
    ]);

    header("location: ../template_user/annoucments.php");
    } catch(PDOException $e) {
        header("refresh: 3; URL = ../template_user/addAnnoucment.php");
        exit("Wystąpił błąd dodawania ogłoszenia, spróbuj ponownie - " . $e->getMessage());
    }
}



?>