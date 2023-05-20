<!DOCTYPE html>
<html>

<head>
    <?php include_once("../../MainHead.php") ?>
    <link rel="stylesheet" href="/Styles/chooseAccount.css">
</head>

<body>

    <?php
    session_name("account");
    session_start();
    $page = "account";
    ?>

    <?php include_once("../../MainNavigation.php") ?>
    <h3 style="text-align: center;">Выбери куда зайти!</h3>
    <div class="choose">
        <a href="/Pages/Account/account_page.php">Личный кабинет клиента</a>
        <a href="/Pages/AdminPanel/adminpanel.php">Административная панель</a>
    </div>

</body>

</html>