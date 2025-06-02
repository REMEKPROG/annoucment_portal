<?php

session_start();

if (!(isset($_SESSION["userId"]))) {
    header("location: ../login.html");
} else {
    include "../php/checkCookieLog.php";
}


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
            <li><a href="annoucments.php">Ogłoszenia</a></li>
            <li class="dropdown-container">
                <a class="droptown-start">Panel użytkownika</a>
                <ul class="droptown-nav">
                    <li><a href="addAnnoucment.php">Dodaj ogłoszenie</a></li>
                    <li><a href="deleteAnnoucment.html">Usuń ogłoszenie</a></li>
                </ul>
            </li>
            <li><a href="../login.html">Logowanie</a></li>
            <li><a href="../register.html">Rejestracja</a></li>
        </ul>
    </nav>
    
    <main class="addAnnoucment-main">
        <section class="addAnnoucment-container">
            <form action="../php/verifyFormAnnoucment.php" method="post" enctype="multipart/form-data">
                <div class="setup-section">
                        <div class="image-post-container">
                            <img src="" alt="YourImage" id="image">
                            <label for="image-uploaded"></label>
                            <input type="file" accept="image/png" id="image-uploaded" name="image-uploaded">
                        </div>
                        <div class="properties-container">
                            <div class="properties-position">
                                <div class="properties-title">
                                    <input type="text" name="title" id="title-annoucment" placeholder="tytuł ogłoszenia" maxlength="30">
                                </div>
                                <div class="properties-description">
                                    <h3>Opis</h3>
                                    <textarea name="description" id="description-annoucment" maxlength="50" placeholder="treść opisu ogłoszenia"></textarea>
                                </div>
                                <div class="properties-contents">
                                    <h3>Treść</h3>
                                    <textarea name="contents" id="contents-annoucment" maxlength="300" placeholder="treść twojego ogłoszenia"></textarea>
                                </div>
                            </div>
                            <div class="button-container">
                                <button type="submit">Zamieść</button>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="review-container">
                    <div class="information-absolute">
                        <h4>*Podgląd ogłoszenia</h4>
                    </div>
                    <div class="annoucmet-review">
                        <div class="setup-review">
                            <div class="properties-review">
                                <div class="title-review">
                                    <h1></h1>
                                </div>
                                <div class="image-review-container">
                                    <img src="" alt="zdjecie" id="image-review">
                                </div>
                            <div class="contents-review">
                                <p></p>
                            </div>
                        </div>
                    </div>
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


    <script src="../scripts/dynamicAnnoucment.js"></script>
</body>
</html>