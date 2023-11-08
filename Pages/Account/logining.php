<!-- Если такой чел есть и в клиентах, и в стафе, то перенаправляем сюда и даем выбрать куда входить -->
<?php
    include_once("../../cookee.php"); 
    startmysession(0,"/", "account",true,false); 
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once("../../MainHead.php") ?>
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body>
    <?php
    
    require_once("../../connect.php"); // Подключение файла для связи с БД

    // // Подключение к БД
    $db = new DB_Class();
    $conn = $db->connect();
    mysqli_select_db($conn, $db->database);

    // session_name("account");
    // session_start();

    $logining = 0;
    $inStaff = 0;
    $inClients = 0;

    if (isset($_POST["phone"]) && isset($_POST["passwd"])) {
        $logining = 1;
        $phone = $_POST["phone"];
        $passwd = $_POST["passwd"];
        $_SESSION["phone"] = $phone;
        $_SESSION["passwd"] = $passwd;
    } elseif (isset($_SESSION["LogIn"])) {
        $logining = 1;
        $phone = $_SESSION["phone"];
        $passwd = $_SESSION["passwd"];    
    }

    if ($logining == 1) {
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
            $inStaff = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION["idStaff"] = $row["id"];
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
            $inClients = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION["idClient"] = $row["id"];
            }
        } 

        $db->close();

        sleep(2);
        if($inClients == 1 && $inStaff == 1) {
            $_SESSION["LogIn"] = 1; ?>
            <script>window.location.replace("/Pages/Account/chooseAccount.php")</script>
            
        <?php } elseif ($inClients == 1 && $inStaff == 0) {
            $_SESSION["LogIn"] = 1; ?>
            <!-- <script>window.location.replace("/Pages/Account/account_page.php")</script> -->
        <?php } elseif ($inClients == 0 && $inStaff == 1) {
            $_SESSION["LogIn"] = 1; ?>
            <script>window.location.replace("/Pages/AdminPanel/adminpanel.php")</script>              
        <?php } else { ?>
            <script>window.location.replace("/Pages/Account/account.php?no=1")</script>
        <?php }
    } else { ?>
        <script>window.location.replace("/Pages/Account/account.php?no=1")</script>
        <?php } ?>
</body>

</html>