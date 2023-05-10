<?php 
require_once("../../connect.php"); // Подключение файла для связи с БД

// // Подключение к БД
$db = new DB_Class();
$conn = $db->connect();
mysqli_select_db($conn, $db->database);

if (isset($_POST["id"]) && isset($_POST["page"])) {
    $id = $_POST["id"];
    $page = $_POST["page"];
    
    if ($page == "Equepment") {
        $sql = "DELETE FROM Equepments WHERE (idEquepment = $id);";
        mysqli_query($conn,$sql);
        if(!$conn->query($sql)){
            echo "Ошибка: " . $conn->error;   
        }
    }
} else {
    echo "Что-то не так";
}
header("Location: /Pages/AdminPanel/Select/$page.php");
?>