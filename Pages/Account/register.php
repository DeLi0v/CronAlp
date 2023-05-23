<!DOCTYPE html>
<html>

<head>

    <?php include_once("../../MainHead.php") ?>
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">

</head>

<body>

    <?php $page = "account"; ?>

    <?php include("../../MainNavigation.php"); ?>
    <?php
    if (isset($_POST["Surname"]) && isset($_POST["Name"]) && isset($_POST["Otch"]) && isset($_POST["Phone"]) && isset($_POST["Mail"]) && isset($_POST["passwd"])) {
        
        require_once("../../connect.php"); // Подключение файла для связи с БД

        // // Подключение к БД
        $db = new DB_Class();
        $conn = $db->connect();
        mysqli_select_db($conn, $db->database);

        $surname = $conn->real_escape_string($_POST["Surname"]);
        $name = $conn->real_escape_string($_POST["Name"]);
        $otch = $conn->real_escape_string($_POST["Otch"]);
        $phone = $conn->real_escape_string($_POST["Phone"]);
        $mail = $conn->real_escape_string($_POST["Mail"]);
        $passwd = $conn->real_escape_string($_POST["passwd"]);

        session_name("register");
        session_start();
        $_SESSION["surname"] = $surname;
        $_SESSION["name"] = $name;
        $_SESSION["otch"] = $otch;
        $_SESSION["phone"] = $phone;
        $_SESSION["mail"] = $mail;
        $p = 0;
        $m = 0;

        // Проверка на существование пользователя с таким же телефоном
        $sql = "SELECT * FROM Clients WHERE Phone = '$phone' AND Passwd IS NOT NULL;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) { $p=1; } else { $p=0; }

        // Проверка на существование пользователя с такой же почтой
        $sql = "SELECT * FROM Clients WHERE Mail = '$mail' AND Passwd IS NOT NULL;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) { $p=1; } else { $m=0; }

        if ($p == 1 || $m == 1) { // Если есть хотя бы одно совпадение перенаправляем обратно на страницу с регистрацией  
            header("Location: register_page.php?p=$p&m=$m"); 
        } else {
            
            $sql = "SELECT * FROM Clients WHERE Phone = '$phone' AND Passwd IS NULL";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) { 
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row["idClient"];
                }
                $sql = "UPDATE Clients 
                SET 
                    ClientSurname = '$surname',
                    ClientName = '$name',
                    ClientOtch = '$otch',
                    Mail = '$mail',
                    Phone = '$phone',
                    Passwd = '$passwd'
                WHERE (idClient = $id);";
             } else {    
                $sql = "INSERT INTO Clients (ClientSurname, ClientName, ClientOtch, Phone, Mail, Passwd) VALUES ('$surname', '$name', '$otch', '$phone', '$mail', '$passwd');";
            }
            
            if($conn->query($sql)){
                echo "<div align=\"center\">
                    <img src=\"/pictures/icons/success.png\" style=\"max-height: 100px;max-width: 100px; padding-top: 15px;\">
                    <div style=\"font-size: 20px;padding-top: 10px;\">Аккаунт успешно зарегестрирован!</div>
                </div>";
                session_unset(); // Очищаем данные сессии
                header("Refresh: 3; Location: /Pages/Account/account.php"); // перенаправляем на страницу входа в аккаунт через 10 секунд
            } else{
                echo "Ошибка: " . $conn->error;
            }
        }
        $conn->close();
    } else {
        echo "Что-то не так";
    }
    ?>

</body>

</html>