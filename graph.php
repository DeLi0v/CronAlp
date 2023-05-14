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
                ['Дата', 'Количество', { role: 'annotation' }],
                <?php require_once("connect.php"); // Подключение файла для связи с БД
                // Подключение к БД
                $db = new DB_Class();
                $conn = $db->connect();
                mysqli_select_db($conn, $db->database);

                // Запрос
                $sql = "SELECT 
                            Equepments.EquepmentName name, 
                            count(Services.idEquepment) count,
                            DATE_FORMAT(Services.ServiceData, '%d.%m.%Y') data
                        FROM 
                            Services
                            JOIN Equepments on Services.idEquepment = Equepments.idEquepment
                        WHERE
                            Services.idOperation = '1'
                        GROUP BY data, name";

                // Выполняем SQL-запрос
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "[ '" . $row["data"] . "', " . $row["count"] . ", 'dsfsd' ],";
                    }
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
    <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
</body>

</html>