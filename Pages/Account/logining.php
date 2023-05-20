<!-- Если такой чел есть и в клиентах, и в стафе, то перенаправляем сюда и даем выбрать куда входить -->
<!DOCTYPE html>
<html>

<head>
    <?php include("../../MainHead.php") ?>
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body>
    <?php 
    if (isset($_POST["phone"]) && isset($_POST["passwd"])) {
        require_once("../../connect.php"); // Подключение файла для связи с БД

        // // Подключение к БД
        $db = new DB_Class();
        $conn = $db->connect();
        mysqli_select_db($conn, $db->database);

        session_name("account");
        session_start();

        if (isset($_SESSION["LogIn"])) {
            if ($_SESSION["LogIn"] <> 1) {
                $_SESSION["LogIn"] = 0;
                $_SESSION["phone"] = $_POST["phone"];
                $_SESSION["passwd"] = $_POST["passwd"];
            }
        } else {
            $_SESSION["LogIn"] = 0;
            $_SESSION["phone"] = $_POST["phone"];
            $_SESSION["passwd"] = $_POST["passwd"];
        }

        $phone = $_SESSION["phone"];
        $phone = $_SESSION["passwd"];
        $inStaff = 0;
        $inClients = 0;

        $sql = "SELECT 
                    idStaff id,
                    StaffSurname surname,
                    StaffName name,
                    StaffOtch otch,
                    Post,
                    Phone,
                    Mail,
                    Passwd
                FROM
                    Staff
                WHERE
                    Phone = '$phone'
                    AND Passwd = '$passwd';";
        // Выполняем SQL-запрос
        $result = mysqli_query($conn, $sql);

        // Проверим, есть ли записи в таблице
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) { 
                $inStaff = 1;
            } 
        } 

        $sql = "SELECT 
                    idClient id,
                    ClientSurname surname,
                    ClientName name,
                    ClientOtch otch,
                    Phone,
                    Mail,
                    Passwd
                FROM
                    Clients
                WHERE
                    Phone = '$phone'
                    AND Passwd = '$passwd';";
        // Выполняем SQL-запрос
        $result = mysqli_query($conn, $sql);

        // Проверим, есть ли записи в таблице
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) { 
                $inClients = 1;
            } 
        } 

        if($inClinets == 1 && $inStaff == 1) {
            $_SESSION["LogIn"] = 1;
            header("Location: /Pages/Account/chooseAccount.php");
        } elseif ($inClinets == 1 && $inStaff == 0) {
            $_SESSION["LogIn"] = 1;
            header("Location: /Pages/Account/account_page.php");
        } elseif ($inClinets == 0 && $inStaff == 1) {
            $_SESSION["LogIn"] = 1;
            header("Location: /Pages/AdminPanel/adminpanel.php");               
        } else { header("Location: /Pages/Account/account.php?no=1"); }
    } else { header("Location: /Pages/Account/account.php?no=1"); } ?>
</body>

</html>

<!-- // <?php include("head.php"); ?>
                // <h2 style="text-align: center;">Добро пожаловать в административную панель!</h2> -->