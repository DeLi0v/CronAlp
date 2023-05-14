<html>

<head>
    <link rel="stylesheet" href="Styles/MainStyles.css">
    <link rel="stylesheet" href="Styles/AdminPanelStyles.css">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            packages: ['bar']
        });
        var visualization;

        function draw() {
            drawVisualization();
            drawToolbar();
        }

        function drawVisualization() {
            var container = document.getElementById('visualization_div');
            visualization = new google.visualization.Bar(container);
            new google.visualization.Query('https://spreadsheets.google.com/tq?key=pCQbetd-CptHnwJEfo8tALA').
            send(queryCallback);
        }

        function queryCallback(response) {
            visualization.draw(response.getDataTable(), {
                is3D: false
            });
        }

        function drawToolbar() {
            var components = [{
                    type: 'igoogle',
                    datasource: 'https://spreadsheets.google.com/tq?key=pCQbetd-CptHnwJEfo8tALA',
                    gadget: 'https://www.google.com/ig/modules/pie-chart.xml',
                    userprefs: {
                        '3d': 1
                    }
                },
                {
                    type: 'html',
                    datasource: 'https://spreadsheets.google.com/tq?key=pCQbetd-CptHnwJEfo8tALA'
                },
                {
                    type: 'csv',
                    datasource: 'https://spreadsheets.google.com/tq?key=pCQbetd-CptHnwJEfo8tALA'
                },
                {
                    type: 'htmlcode',
                    datasource: 'https://spreadsheets.google.com/tq?key=pCQbetd-CptHnwJEfo8tALA',
                    gadget: 'https://www.google.com/ig/modules/pie-chart.xml',
                    userprefs: {
                        '3d': 1
                    },
                    style: 'width: 800px; height: 700px; border: 3px solid purple;'
                }
            ];

            var container = document.getElementById('toolbar_div');
            google.visualization.drawToolbar(container, components);
        };

        google.charts.setOnLoadCallback(draw);
    </script>
</head>

<body>
<?php include("head.php"); ?>
    <div id="toolbar_div"></div>
    <div id="visualization_div" style="width: 270px; height: 200px;"></div>
</body>

</html>