<?php 

require "../php/config.php";

session_start();

if(!isset($_SESSION["userId"])) {
    header("location: ../login.html");
} else {
    include "../php/checkCookieLog.php";
}

$getUserAnnoucmentsSQL = "SELECT * FROM serwis_ogloszeniowy.annoucments WHERE id_user = :userId";
$getuserAnnoucment = $pdo->prepare($getUserAnnoucmentsSQL);
$getuserAnnoucment->execute([
    "userId" => $_SESSION["userId"],
]);

$userAnnoucments = $getuserAnnoucment->fetchAll();

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

        <main class="deleteAnnoucment-main">
            <section class="userAnnoucment-container-section">
                <div class="userAnnoucment-container">
                    <form action="../php/deleteAnnoucmentsSystem.php" method="post">
                        <div class="warning-information-annoucment">
                            <div class="warning-text">
                                <h4>Czy na pewno chcesz usunąć ogłoszenia?</h4>
                            </div>
                            <div class="warning-buttons">
                                <button class="Delete" type="submit">Usuń</button>
                                <button class="return">Wróć</button>
                            </div>
                        </div>
                        <div class="singleAnnoucment">
                            <?php foreach($userAnnoucments as $annoucmentData) { ?>
                                <div class="annoucment-box-user">
                                    <label for="selectedAnnoucment<?php echo $annoucmentData["id"] ?>" class="select-input"></label>
                                    <input name="Annoucments[]" value="<?php echo $annoucmentData["id"] ?>" type="checkbox" id="selectedAnnoucment<?php echo $annoucmentData["id"] ?>" data-active="false" class="input-select-annoucment">
                                    <div class="annoucment-image" style="background-image: url(<?php echo $annoucmentData["img"] ?>);">
                                    <div class="annoucment-image-bg"></div>
                                    </div>
                                    <div class="annoucment-box-text">
                                        <h2><?php echo $annoucmentData["title"] ?></h2>
                                        <p><?php echo $annoucmentData["description"] ?></p>
                                    </div>
                            </div>
                            <?php } ?>
                        </div>
                        <button class="deleteButton" type="button">Usuń</button>
                    </form>
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

    <script src="../scripts/showClickedAnnoucment.js"></script>
    <script src="../scripts/errorDisplayAnnoucmet.js"></script>
</body>
</html>