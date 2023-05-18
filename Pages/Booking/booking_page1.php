<!DOCTYPE html>
<html>

<head>
    <?php include_once("../../MainHead.php") ?>
    <!-- <link rel="stylesheet" href="/Styles/AdminPanelStyles.css"> -->
    <style>
        .add {
            margin: auto;
            width: 500px;
        }

        h3 {
            text-align: center;
        }

        .wrapper {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .form-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        label {
            font-weight: bold;
            margin-right: 5px;
        }

        input {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
            width: 70%;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #3e8e41;
        }
    </style>
</head>

<body>
    <?php $page = "booking" ?>
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