<?php 
require_once("../../connect.php"); // Подключение файла для связи с БД

// // Подключение к БД
$db = new DB_Class();
$conn = $db->connect();
mysqli_select_db($conn, $db->database);

if (isset($_POST["id"]) && isset($_POST["page"])
            || isset($_POST["Surname"]) || isset($_POST["Name"]) || isset($_POST["Otch"]) || isset($_POST["Mail"]) || isset($_POST["Phone"]) || isset($_POST["Passwd"])
            || isset($_POST["Post"]) || isset($_POST["Category"]) || isset($_POST["Total"]) || isset($_POST["Balance"]) || isset($_POST["Status"])
            || isset($_POST["Storage"]) || isset($_POST["Size"])) {
    $id = $_POST["id"];
    $page = $_POST["page"];
    
    if ($page == "Equepment") {
        $category = $_POST["Category"];
        $name = $_POST["Name"];
        $size = $_POST["Size"];
        $storage = $_POST["Storage"];

        $sql = "UPDATE Equepments 
                SET 
                    idCategory = '$category',
                    EquepmentName = '$name',
                    size = '$size',
                    storage = '$storage'
                WHERE (idEquepment = $id);";
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
        $name = $_POST["Name"];

        $sql = "UPDATE EquepmentCategories 
                SET 
                    CategoryName = '$name'
                WHERE (idEquepmentCategory = $id);";
        mysqli_query($conn,$sql);
        if(!$conn->query($sql)){
            echo "Ошибка: " . $conn->error;   
        }
    } elseif ($page == "OperationTypes") {
        $name = $_POST["Name"];

        $sql = "UPDATE OperationTypes 
                SET 
                    OperationName = '$name'
                WHERE (idOperationType = $id);";
        mysqli_query($conn,$sql);
        if(!$conn->query($sql)){
            echo "Ошибка: " . $conn->error;   
        }
    } elseif ($page == "Services" || $page == "broni") {
        $operation = $_POST["Operation"]; 
        
        if ($operation == 3) {
            $total = $_POST["Total"];

            $sql = "UPDATE Services 
                    SET 
                        Total = '$total'
                    WHERE (idService = $id);";
            mysqli_query($conn,$sql);
            if(!$conn->query($sql)){
                echo "Ошибка: " . $conn->error;   
            }
        } elseif ($operation == 6) {
            $status = $_POST["Status"];

            $sql = "UPDATE Services 
                    SET 
                        idStatusEquepment = '$status'
                    WHERE (idService = $id);";
            mysqli_query($conn,$sql);
            if(!$conn->query($sql)){
                echo "Ошибка: " . $conn->error;   
            }    
        }
    } elseif ($page == "Ski_Pass") {
        $balance = $_POST["Balance"];

        $sql = "UPDATE Ski_pass 
                SET 
                    Balance = $balance
                WHERE (idSki_pass = $id);";
        mysqli_query($conn,$sql);
        if(!$conn->query($sql)){
            echo "Ошибка: " . $conn->error;   
        }
    } elseif ($page == "Staff") {
        $surname = $_POST["Surname"];
        $name = $_POST["Name"];
        $otch = $_POST["Otch"];
        $mail = $_POST["Mail"];
        $phone = $_POST["Phone"];
        $passwd = $_POST["Passwd"];
        $post = $_POST["Post"];

        $sql = "UPDATE Staff 
                SET 
                    StaffSurname = '$surname',
                    StaffName = '$name',
                    StaffOtch = '$otch',
                    Mail = '$mail',
                    Phone = '$phone',
                    Passwd = '$passwd',
                    Post = '$post'
                WHERE (idStaff = $id);";
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