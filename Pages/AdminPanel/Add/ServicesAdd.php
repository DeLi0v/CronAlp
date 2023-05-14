<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="/Styles/MainStyles.css">
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body class="clients-add">
<?php include("../../../head.php"); ?>
<?php
if (isset($_POST["Equepment"]) || isset($_POST["newSkiPass"]) || isset($_POST["skiPass"]) || isset($_POST["total"])) {
      
    require_once("../../../connect.php"); // Подключение файла для связи с БД

    // // Подключение к БД
    $db = new DB_Class();
    $conn = $db->connect();
    mysqli_select_db($conn, $db->database);

    session_start();

    $data = 'NOW()';
    $staff = $_SESSION['staff'];
    $client = $_SESSION['client'];
    $operation = $_SESSION['operation'];
    $newSkiPass = $_SESSION['newSkiPass'];
    
    if ($operation == "1" || $operation == "2") { // Выдача или прием оборудования       
        $equepment = $conn->real_escape_string($_POST["Equepment"]);
        $sql = "INSERT INTO Services (ServiceData, idStaff, idClient, idOperation, idEquepment, NewSki_pass, idSki_pass, Total) 
                VALUES ($data,'$staff', '$client', '$operation', '$equepment', Null, Null, Null);";
    } elseif ($operation == "3") { // Оплата проката
        $equepment = $conn->real_escape_string($_POST["Equepment"]);
        $total = $conn->real_escape_string($_POST["total"]); 

        $sql = "INSERT INTO Services (ServiceData, idStaff, idClient, idOperation, idEquepment, NewSki_pass, idSki_pass, Total) 
                VALUES ($data,'$staff', '$client', '$operation', '$equepment', Null, Null, '$total');";
    } elseif ($operation == "4") { // Пополнение ski-pass
        
        $skiPass = $_SESSION['idSki_pass'];
        
        if ($newSkiPass == 1) {
            // Выдаем ski-pass клиенту
            $sql = "INSERT INTO Ski_pass (idClient, Balance) VALUES ('$client', '0');";
            
            if(!$conn->query($sql)) {
                echo "Ошибка: " . $conn->error;
            }
            
            // Получаем данные о выданном ski-pass
            $sql = "SELECT 
                      Ski_pass.idSki_pass,
                      Ski_pass.Balance
                    FROM 
                        Ski_pass 
                    WHERE Ski_pass.idClient='$client';";

            // Выполняем SQL-запрос
            $result = mysqli_query($conn, $sql);
            
            while($object = mysqli_fetch_object($result)){
                $skiPass = $object->idSki_pass;
            }
        }
        $total = $conn->real_escape_string($_POST["total"]);
        if ($newSkiPass == 1) { $total += 250;}
        $sql = "INSERT INTO Services (ServiceData, idStaff, idClient, idOperation, idEquepment, NewSki_pass, idSki_pass, Total) 
                VALUES ($data,'$staff', '$client', '$operation', Null, '$newSkiPass', '$skiPass', '$total');";
    } else {
        echo "Ошибка: " . $conn->error;
    }
        
    if($conn->query($sql)) {
        echo "<div align=\"center\">
        <img src=\"/pictures/icons/success.png\" style=\"max-height: 100px;max-width: 100px; padding-top: 15px;\">
        <div style=\"font-size: 20px;padding-top: 10px;\">Данные успешно добавлены</div>";
        if ($newSkiPass == 1) {
            echo "<div style=\"font-size: 20px;padding-top: 10px;\">Ski-pass успешно присвоен</div>";
        }
        echo "</div>";
    } else{
        echo "Ошибка: " . $conn->error;
    }

    if($operation == "4") {
        $sql ="UPDATE Ski_pass SET Balance = Balance + $total WHERE (idSki_pass = $skiPass);";
        if(!$conn->query($sql)){
            echo "Ошибка: " . $conn->error;    
        }
    }
    $conn->close();
} else {
    echo "<div class=\"error\">Данные не могут быть добавлены. Попробуйте снова.</div>";
}
?>
</body>
</html>