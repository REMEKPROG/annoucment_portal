<?php

require "../php/config.php";

session_start();

if (!(isset($_SESSION["userId"]))) {
    header("location: ../login.html");
} else {
    include "../php/checkCookieLog.php";
}


$zapytanieTest = "SELECT * FROM serwis_ogloszeniowy.annoucments";

$zapytanieTestinst = $pdo->query($zapytanieTest);
$wynik = $zapytanieTestinst->fetchAll();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ogłoszenia!</title>
    <link rel="stylesheet" href="../style/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fc8a4d7559.js" crossorigin="anonymous"></script>
</head>
<body class="annoucment-body">
     <nav class="nav-conatiner">
        <ul class="nav-list">
            <li><a href="annoucments.php">Ogłoszenia</a></li>
            <li class="dropdown-container">
                <a class="droptown-start">Panel użytkownika</a>
                <ul class="droptown-nav">
                    <li><a href="addAnnoucment.php">Dodaj ogłoszenie</a></li>
                    <li><a href="">Usuń ogłoszenie</a></li>
                </ul>
            </li>
            <li><a href="../login.html">Logowanie</a></li>
            <li><a href="../register.html">Rejestracja</a></li>
        </ul>
    </nav>

    <main class="annoucments-main">
        <section class="annoucments-container-section">
            <div class="annoucments-container">
                <?php foreach($wynik as $ogloszenie) { ?>
                <a href="annoucmentPage.php?id=<?php echo $ogloszenie["id"] ?>" class="annoucment-page-link">
                    <div class="annoucment-box">
                        <div class="annoucment-image" style="background-image: url(<?php echo $ogloszenie["img"] ?>);">
                            <div class="annoucment-image-bg"></div>
                        </div>
                        <div class="annoucment-box-text">
                            <h2><?php echo $ogloszenie["title"] ?></h2>
                            <p><?php echo $ogloszenie["description"]?></p>
                        </div>
                    </div>
                </a>
                <?php } ?>
                </div>
            </div>
        </section>
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