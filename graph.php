<html>
  <head>
    <link rel="stylesheet" href="Styles/MainStyles.css">
    <link rel="stylesheet" href="Styles/AdminPanelStyles.css">

    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the controls package.
      google.charts.load('current', {'packages':['corechart', 'controls']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawDashboard);

      // Callback that creates and populates a data table,
      // instantiates a dashboard, a range slider and a pie chart,
      // passes in the data and draws it.
      function drawDashboard() {

        // Create a dashboard.
        var dashboard = new google.visualization.Dashboard(
            document.getElementById('dashboard_div'));

        // Create a range slider, passing some options
        var donutRangeSlider = new google.visualization.ControlWrapper({
          'controlType': 'CategoryFilter',
          'containerId': 'filter_div',
          'options': {
            'filterColumnLabel': 'Оборудование'
          }
        });

        // Создание 
        var pieChart = new google.visualization.ChartWrapper({
          'chartType': 'Bar',
          'containerId': 'chart_div',
          'options': {
            'width': 500,
            'height': 500,
            'pieSliceText': 'value',
            'legend': 'right'
          }
        });

        // Создание таблицы с данными
        var data = google.visualization.arrayToDataTable([
          ['Название', 'Количество'],
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
                        idOperation = '1'
                    GROUP BY data, name";

            // Выполняем SQL-запрос
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                echo "['" . $row["name"] . "', ". $row["count"] . "],";
            }
            } ?>
        ]);

        // Establish dependencies, declaring that 'filter' drives 'pieChart',
        // so that the pie chart will only display entries that are let through
        // given the chosen slider range.
        dashboard.bind(donutRangeSlider, pieChart);

        // Draw the dashboard.
        dashboard.draw(data);
      }
    </script>
  </head>

  <body>
  <?php include("head.php"); ?>
    <!--Div that will hold the dashboard-->
    <div id="dashboard_div">
      <!--Divs that will hold each control and chart-->
      <div id="filter_div"></div>
      <div id="chart_div"></div>
    </div>
  </body>
</html>