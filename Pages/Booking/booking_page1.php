<!DOCTYPE html>
<html>

<head>
    <?php include_once("../../MainHead.php") ?>
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body>
    <?php include_once("../../MainNavigation.php") ?>
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
            <li class="form-row">
                <label for="Passwd">Пароль:</label>
                <input type="text" name="Passwd" size="20px" />
            </li>
            <li class="form-row">
                <button type="submit">Дальше</button>
            </li>
        </ul>
    </form>

</body>

</html>  