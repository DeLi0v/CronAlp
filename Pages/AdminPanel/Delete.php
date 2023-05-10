<?php 
require_once("../../../connect.php"); // Подключение файла для связи с БД

// // Подключение к БД
$db = new DB_Class();
$conn = $db->connect();
mysqli_select_db($conn, $db->database);

if (isset($_POST["Equepment"])) {
    $id = $_POST["Equepment"];
    $sql = "DELETE FROM `mydb`.`Ski_pass` WHERE (`idSki_pass` = '$id');";
    if(!$conn->query($sql)){
        echo "Ошибка: " . $conn->error;    
    }
} else {
    echo "Что-то не так";
}
?>