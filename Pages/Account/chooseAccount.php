<!DOCTYPE html>
<html>

<head>
    <?php include_once("../../MainHead.php") ?>
</head>

<body>

    <?php 
    $page = "account"; 
    ?>

    <?php include_once("../../MainNavigation.php") ?>

    <h3 style="text-align: center;">Выбери куда зайти!</h3>
    <a herf="/Pages/Account/account_page.php">Личный кабинет клиента</a>
    <a herf="/Pages/AdminPanel/adminpanel.php">Административная панель</a>
    <div>
        <a href="/Pages/Account/account_page.php">Личный кабинет клиента</a>
        <a href="/Pages/AdminPanel/adminpanel.php">Административная панель</a>
    </div>

</body>

</html>