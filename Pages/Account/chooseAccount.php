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
    <div>
        <ul>
            <li><a href="/Pages/Account/account_page.php">Личный кабинет клиента</a></li>
            <li><a href="/Pages/AdminPanel/adminpanel.php">Административная панель</a></li>
        </ul>
    </div>

</body>

</html>