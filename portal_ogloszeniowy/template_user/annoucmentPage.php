<?php

require "../php/config.php";

session_start();

if(!isset($_SESSION["userId"])) {
    header("location: ../login.html");
} else {
    include "../php/checkCookieLog.php";
}

$idUrl = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);


$getAnnoucmentDataSQL = "SELECT * FROM serwis_ogloszeniowy.annoucments WHERE id = :id";
$getAnnoucmentData = $pdo->prepare($getAnnoucmentDataSQL);
$getAnnoucmentData->execute([
    "id" => $idUrl,
]);

$annoucmentData = $getAnnoucmentData->fetch();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj ogłoszenie!</title>
    <link rel="stylesheet" href="../style/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fc8a4d7559.js" crossorigin="anonymous"></script>
</head>
<body class="addAnnoucment-body">

     <nav class="nav-conatiner">
        <ul class="nav-list">
            <li><a href="../annoucments.php">Ogłoszenia</a></li>
            <li class="dropdown-container">
                <a class="droptown-start">Panel użytkownika</a>
                <ul class="droptown-nav">
                    <li><a href="addAnnoucment.php">Dodaj ogłoszenie</a></li>
                    <li><a href="deleteAnnoucment.php">Usuń ogłoszenie</a></li>
                </ul>
            </li>
            <?php if(isset($_SESSION["userId"])) { ?>
                <li><a href="../logout.php">Wyloguj</a></li>
            <?php } else {?>
                <li><a href="../login.html">Logowanie</a></li>
            <?php } ?>
            <li><a href="../register.html">Rejestracja</a></li>
        </ul>
    </nav>

    <main class="annoucmentPage-main">
        <div class="annoucment-container">
                <div class="annoucmet-items">
                    <div class="annoucment-setup">
                        <div class="annoucment-properties">
                            <div class="annoucment-title">
                                <h1><?php echo $annoucmentData["title"] ?></h1>
                            </div>
                            <div class="annoucment-image">
                                <img src="<?php echo $annoucmentData["img"] ?>" alt="zdjecie" id="image-review">
                            </div>
                            <div class="annoucment-contents">
                                <p><?php echo $annoucmentData["contents"] ?></p>
                            </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer">
            <div class="lastLog-information">
                <p>Ostatni raz zalogowałeś się: <?php echo $lastLog ?></p>
            </div>
            <div class="footer-items">
                <div class="footer-company">
                    <h3>&copy;Portal ogłoszeniowy</h3>
                </div>
                <div class="media">
                    <a href=""><i class="fa-brands fa-facebook"></i></a>
                    <a href=""><i class="fa-brands fa-instagram"></i></a>
                    <a href=""><i class="fa-brands fa-square-x-twitter"></i></a>
                </div>
            </div>
        </div>
    </footer>
    
</body>
</html>