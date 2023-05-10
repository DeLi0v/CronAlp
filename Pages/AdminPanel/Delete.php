<?php 
if (isset($_POST["Equepment"])) {
    $id = $_POST["Equepment"];
    $sql = "DELETE FROM `mydb`.`Ski_pass` WHERE (`idSki_pass` = '$id');";
} else {
    echo "Что-то не так";
}
?>