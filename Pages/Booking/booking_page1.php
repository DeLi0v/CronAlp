<!DOCTYPE html>
<html>

<head>
    <?php include_once("../../MainHead.php") ?>
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body>
    <?php 
    session_name("account");
    session_start();
    $page = "booking"; 

    if (isset($_GET["no"])) {
        $err = $_GET["no"];
    } else {
        $err = 0;
    } ?>

    <?php include_once("../../MainNavigation.php") ?>

    <?php 
    if(isset($_SESSION["LogIn"]) && $_SESSION["LogIn"] == 1 && isset($_SESSION["idClient"])) {
        header("Location: /Pages/Booking/booking_page2.php");
    } else { ?>

    <form class="add" action="/Pages/Booking/booking_page2.php" method="post" style=" margin:auto; width:500px;">
        <h3 style="text-align:center;">Бронирование оборудования</h3>
        <ul class="wrapper">
            <li class="form-row">
                <label for="Surname">Фамилия:</label>
                <input type="text" name="Surname" size="20px" />
            </li>
            <li class="form-row">
                <label for="Name">Имя:</label>
                <input type="text" name="Name" size="20px" />
            </li>
            <li class="form-row">
                <label for="Otch">Отчетсво:</label>
                <input type="text" name="Otch" size="20px" />
            </li>
            <li class="form-row">
                <label for="Phone">Телефон:</label>
                <input type="tel" name="Phone" size="20px" />
            </li>
            <li class="form-row">
                <label for="Mail">Почта:</label>
                <input type="email" name="Mail" size="20px" />
            </li>
            <?php if ($err == 1) { ?>
                    <li class="form-row-error">
                        <label>Необходимо заполнить все поля</label>
                    </li>
                <?php } ?>
            <li class="form-row">
                <button type="submit">Дальше</button>
            </li>
        </ul>
    </form>
    <?php } ?>

</body>

</html>