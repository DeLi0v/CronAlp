<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="Styles/MainStyles.css">
    <link rel="stylesheet" href="Styles/AdminPanelStyles.css">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Create the data table.
            var data = google.visualization.arrayToDataTable([
                ['Оборудование', 'Количество'],
                <?php require_once("connect.php"); // Подключение файла для связи с БД
                // Подключение к БД
                $db = new DB_Class();
                $conn = $db->connect();
                mysqli_select_db($conn, $db->database);

                // Запрос
                $sql = "SELECT 
                            Equepments.EquepmentName name, 
                            count(Services.idEquepment) count
                        FROM 
                            Services
                            JOIN Equepments on Services.idEquepment = Equepments.idEquepment
                        WHERE
                            idOperation = '1'
                            AND DATE_FORMAT(Services.ServiceData, '%d.%m.%Y') = DATE_FORMAT(NOW(), '%d.%m.%Y') 
                        GROUP BY name";

                // Выполняем SQL-запрос
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "['" . $row["name"] . "', " . $row["count"] . "],";
                    }
                    $error = 0;
                } else {
                    $error = 1;
                } ?>
            ]);

            var options = {
                chart: {
                    title: 'Количество выданного оборудования',
                    //subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
</head>

<body>
    <?php include("head.php"); ?>
    <?php if ($error == 0) { ?>
        <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
    <?php } else { ?>
        <div class="error">На данный момент ни одного оборудования не выдали</div>
    <?php } ?>
</body>

</html>