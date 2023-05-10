<?php 
if (isset($_POST["id"]) && isset($_POST["table"])) {
    $id = $_POST["id"];
    $table = $_POST["table"];
    $sql = "DELETE FROM `mydb`.`Ski_pass` WHERE (`idSki_pass` = '$id');";
    if(!$conn->query($sql)){
        echo "Ошибка: " . $conn->error;    
    }
} else {
    echo "Что-то не так";
}
header("/Pages/AdminPanel/Select/$table.php");
?>