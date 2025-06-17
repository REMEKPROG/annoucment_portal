<?php

include "config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["Annoucments"])) {
        $deleteAnnoucments = $_POST["Annoucments"];

        $annoucmentsToSQL = implode(",", array_fill(0, count($deleteAnnoucments), "?"));

        try{
        $deleteSpeciallyAnnoucmentsSQL = "DELETE FROM serwis_ogloszeniowy.annoucments WHERE id_user = ? AND id IN ($annoucmentsToSQL)";
        $deleteSpeciallyAnnoucments = $pdo->prepare($deleteSpeciallyAnnoucmentsSQL);

        $arrayToExec = array_merge([$_SESSION["userId"]], $deleteAnnoucments);

        $deleteSpeciallyAnnoucments->execute($arrayToExec);
        } catch(PDOException $e) {
            header("refresh: 3; URL = ../template_user/deleteAnnoucment.php");
            exit("Wystąpił błąd dodawania ogłoszenia, spróbuj ponownie - " . $e->getMessage());
        }

    }
    header("location: ../template_user/deleteAnnoucment.php");
    exit();
}

?>