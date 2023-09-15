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
    } elseif ($page == "Clients") {
        $sql = "DELETE FROM Clients WHERE (idClient = $id);";
        mysqli_query($conn,$sql);
        if(!$conn->query($sql)){
            echo "Ошибка: " . $conn->error;   
        }
    } elseif ($page == "EquepmentCategories") {
        $sql = "DELETE FROM EquepmentCategories WHERE (idEquepmentCategory = $id);";
        mysqli_query($conn,$sql);
        if(!$conn->query($sql)){
            echo "Ошибка: " . $conn->error;   
        }
    } elseif ($page == "OperationTypes") {
        $sql = "DELETE FROM OperationTypes WHERE (idOperationType = $id);";
        mysqli_query($conn,$sql);
        if(!$conn->query($sql)){
            echo "Ошибка: " . $conn->error;   
        }
    } elseif ($page == "Services" || $page == "broni") {
        $sql = "DELETE FROM Services WHERE (idService = $id);";
        mysqli_query($conn,$sql);
        if(!$conn->query($sql)){
            echo "Ошибка: " . $conn->error;   
        }
    } elseif ($page == "Ski_Pass") {
        $sql = "DELETE FROM Ski_pass WHERE (idSki_pass = $id);";
        mysqli_query($conn,$sql);
        if(!$conn->query($sql)){
            echo "Ошибка: " . $conn->error;   
        }
    } elseif ($page == "Staff") {
        $sql = "DELETE FROM Staff WHERE (idStaff = $id);";
        mysqli_query($conn,$sql);
        if(!$conn->query($sql)){
            echo "Ошибка: " . $conn->error;   
        }
    }

} else {
    echo "Что-то не так";
}
$db->close();
header("Location: /Pages/AdminPanel/Select/$page.php");
?>