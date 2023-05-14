<html>
  <head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="Styles/MainStyles.css">
    <link rel="stylesheet" href="Styles/AdminPanelStyles.css">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Дата', 'Количество'],
          <?php require_once("connect.php"); // Подключение файла для связи с БД
            // Подключение к БД
            $db = new DB_Class();
            $conn = $db->connect();
            mysqli_select_db($conn, $db->database);
            
            // Запрос
            $sql = "SELECT 
                        count(idEquepment) count,
                        DATE_FORMAT(ServiceData, '%d.%m.%Y') data
                    FROM Services
                    WHERE
                        idOperation = '1'
                        AND idEquepment = '1'
                    GROUP BY data";

            // Выполняем SQL-запрос
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                echo "['" . $row["data"] . "', ". $row["count"] . "],";
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