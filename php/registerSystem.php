<?php
require "config.php";

session_start();


function ValidateForm() {
    if (empty($_POST["name"]) || empty($_POST["surname"]) || empty($_POST["login"]) || empty($_POST["email"]) || empty($_POST["password"])) {
        header("refresh: 3; URL = ../register.html");
        exit();
    } else {
        return;
    }
}

$acceptClientCom = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $flag = true;
    $komunikat = "";
    ValidateForm();
    if (isset($_POST["name"]) && (mb_strlen($_POST["name"])) <= 50) {
        $name = trim($_POST["name"]);
    } else {
        $komunikat .= "imie jest za długie ";
        $flag = false;
    }
    if (isset($_POST["surname"]) && (mb_strlen($_POST["surname"])) <= 50) {
        $surname = trim($_POST["surname"]);
    } else {
        $komunikat .= "nazwisko jest za długie ";
        $flag = false;
    }
    if(isset($_POST["login"]) && (mb_strlen($_POST["login"]) <= 15)) {
        $login = trim($_POST["login"]);
    } else {
        $komunikat .= "login jest za długi ";
        $flag = false;
    }
    if(isset($_POST["email"]) && (mb_strlen($_POST["email"]) <= 50)) {
        $email = trim($_POST["email"]);
    } else {
        $komunikat .= "mail jest za długi ";
        $flag = false;
    }
    if(isset($_POST["password"]) && (mb_strlen($_POST["password"]) <= 30)) {
        $password = trim(password_hash($_POST["password"], PASSWORD_DEFAULT));
    } else {
        $komunikat .= "hasło jest za dlugie ";
        $flag = false;
    }

    if ($flag) {
        try {
        $insertUserSQL = "INSERT INTO serwis_ogloszeniowy.users(name,surname,login,password,email,role)
        VALUES(:name, :surname, :login, :password, :email, 'User')";
        
        $insertUserInst = $pdo->prepare($insertUserSQL);
        $insertUserInst->execute([
            "name" => $name,
            "surname" => $surname,
            "login" => $login,
            "password" => $password,
            "email" => $email,
        ]);

        $_SESSION["userId"] = $pdo->lastInsertId();
        $_SESSION["name"] = $name;
        $_SESSION["surname"] = $surname;
        $_SESSION["email"] = $email;

        $currentDate = date("Y-m-d H:i:s");
        setcookie("lastLog", $currentDate, time() + (86400 * 1), "/");

        header("location: ../template_user/annoucments.php");
        } catch(PDOException $e) {
            if ($e->getCode() == 23000) {
                $acceptClientCom = "Ten login lub mail jest już zajęty, wybierz inny!";
                header("refresh: 2; URL = ../register.html");
            } else {
                $acceptClientCom = "Wystąpił błąd Rejestacji!" . $e->getMessage();
                header("refresh: 4; URL = ../register.html");
            }
        }
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
        <h2 class="alerth2"><?php echo $acceptClientCom ?></h2>
        <h2 class="alerth2">błąd</h2>
    </main>
</body>
</html>