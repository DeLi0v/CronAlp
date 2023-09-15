<?php 
require_once("../../connect.php"); // Подключение файла для связи с БД

// // Подключение к БД
$db = new DB_Class();
$conn = $db->connect();
mysqli_select_db($conn, $db->database);

if (isset($_POST["id"])) {
    $id = $_POST["id"];
    

    $sql = "DELETE FROM Services WHERE (idService = $id);";
    mysqli_query($conn,$sql);
    if(!$conn->query($sql)){
        echo "Ошибка: " . $conn->error;   
    }

} else {
    echo "Что-то не так";
}
$db->close();
header("Location: /Pages/Account/account_page.php");
?>