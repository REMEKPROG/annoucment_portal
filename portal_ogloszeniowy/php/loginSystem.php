<?php

require "config.php";

session_start();

if (isset($_SESSION["userId"])) {
    session_unset();
}

function checkIfUserExists($pdo, $login) {
    $checkIfLoginSQL = "SELECT users.login FROM serwis_ogloszeniowy.users WHERE login = :login";
    $checkIfLogin = $pdo->prepare($checkIfLoginSQL);
    $checkIfLogin->execute([
        "login" => $login,
    ]);

    $login = $checkIfLogin->fetch();

    if(!$login) {
        $com = "Podany login nie istnieje!";
        header("location: ../login.html");
        return $com;
    };
}


function getPassword($pdo, $login) {
   $getPasswordSQL = "SELECT users.password FROM serwis_ogloszeniowy.users WHERE login = :login";
   $getPassword = $pdo->prepare($getPasswordSQL);
   $getPassword->execute([
    "login" => $login,
   ]);

   $password = $getPassword->fetch();
   return $password;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = trim($_POST["login"]);
    $passwordInInput = trim($_POST["password"]);

    $communicate = checkIfUserExists($pdo, $login);
    $password = getPassword($pdo, $login);

    if(password_verify($passwordInInput, $password["password"])) {
        $selectUserDataSQL = "SELECT users.id_user, users.name, users.surname, users.email FROM serwis_ogloszeniowy.users WHERE login = :login";
        $selectUserData = $pdo->prepare($selectUserDataSQL);
        $selectUserData->execute([
            "login" => $login,
        ]);
        $userData = $selectUserData->fetch();

        $_SESSION["userId"] = $userData["id_user"];
        $_SESSION["name"] = $userData["name"];
        $_SESSION["surname"] = $userData["email"];
        $_SESSION["role"] = $userData["role"];

        $currentDate = date("Y-m-d H:i:s");
        setcookie("lastLog", $currentDate, time() + 86400, "/");

        header("location: ../template_user/annoucments.php");

    } else {
        $communicate = "Nieprawidłowe hasło!";
        header("refresh: 1; URL = ../login.html");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RegisterPage</title>
    <link rel="stylesheet" href="../style/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <main class="register-main">
        <div class="bg-cover"></div>
        <h2 class="alerth2"><?php echo $communicate ?></h2>
    </main>
</body>
</html>