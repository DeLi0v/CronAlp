<?php 
require_once("../../connect.php"); // Подключение файла для связи с БД

// // Подключение к БД
$db = new DB_Class();
$conn = $db->connect();
mysqli_select_db($conn, $db->database);

if (isset($_POST["id"]) && isset($_POST["page"])
            || isset($_POST["Surname"]) || isset($_POST["Name"]) || isset($_POST["Otch"]) || isset($_POST["Mail"]) || isset($_POST["Phone"]) || isset($_POST["Passwd"])
            || isset($_POST["Post"]) || isset($_POST["Category"]) || isset($_POST["Total"]) || isset($_POST["Balance"])) {
    $id = $_POST["id"];
    $page = $_POST["page"];
    
    if ($page == "Equepment") {
        //$sql = "UPDATE Ski_pass SET Balance = 0 WHERE (idSki_pass = );";
        mysqli_query($conn,$sql);
        if(!$conn->query($sql)){
            echo "Ошибка: " . $conn->error;   
        }
    } elseif ($page == "Clients") {
        $surname = $_POST["Surname"];
        $name = $_POST["Name"];
        $otch = $_POST["Otch"];
        $mail = $_POST["Mail"];
        $phone = $_POST["Phone"];
        $passwd = $_POST["Passwd"];

        $sql = "UPDATE Clients 
                SET 
                    ClientSurname = '$surname',
                    ClientName = '$name',
                    ClientOtch = '$otch',
                    Mail = '$mail',
                    Phone = '$phone',
                    Passwd = '$passwd'
                WHERE (idClient = $id);";
        mysqli_query($conn,$sql);
        if(!$conn->query($sql)){
            echo "Ошибка: " . $conn->error;   
        }
    } elseif ($page == "EquepmentCategories") {
        //$sql = "DELETE FROM EquepmentCategories WHERE (idEquepmentCategory = $id);";
        mysqli_query($conn,$sql);
        if(!$conn->query($sql)){
            echo "Ошибка: " . $conn->error;   
        }
    } elseif ($page == "OperationTypes") {
        //$sql = "DELETE FROM OperationTypes WHERE (idOperationType = $id);";
        mysqli_query($conn,$sql);
        if(!$conn->query($sql)){
            echo "Ошибка: " . $conn->error;   
        }
    } elseif ($page == "Services") {
        //$sql = "DELETE FROM Services WHERE (idService = $id);";
        mysqli_query($conn,$sql);
        if(!$conn->query($sql)){
            echo "Ошибка: " . $conn->error;   
        }
    } elseif ($page == "Ski_Pass") {
        //$sql = "DELETE FROM Ski_pass WHERE (idSki_pass = $id);";
        mysqli_query($conn,$sql);
        if(!$conn->query($sql)){
            echo "Ошибка: " . $conn->error;   
        }
    } elseif ($page == "Staff") {
        //$sql = "DELETE FROM Staff WHERE (idStaff = $id);";
        mysqli_query($conn,$sql);
        if(!$conn->query($sql)){
            echo "Ошибка: " . $conn->error;   
        }
    }

} else {
    echo "Что-то не так";
}
//header("Location: /Pages/AdminPanel/Select/$page.php");
?>