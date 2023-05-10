<?php 
require_once("../../connect.php"); // Подключение файла для связи с БД

// // Подключение к БД
$db = new DB_Class();
$conn = $db->connect();
mysqli_select_db($conn, $db->database);

if (isset($_POST["id"]) && isset($_POST["table"])) {
    $id = $_POST["id"];
    $table = $_POST["table"];
    $sql = "DELETE FROM Equepments WHERE (idEquepment = $id);";
    mysqli_query($conn,$sql);
    if(!$conn->query($sql)){
        echo "Ошибка: " . $conn->error;   
    }
} else {
    echo "Что-то не так";
}
header("Location: /Pages/AdminPanel/Select/$table.php");
?>