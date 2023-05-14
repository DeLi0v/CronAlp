<html>
    <head>
        <link rel="stylesheet" href="http://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
        <script src="http://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    </head>

    <body>
        <?php include("head.php") ?>
        <div class="ct-chart ct-golden-section"></div>
        <script>
            new Chartist.Line('.chart1', {
                labels: ['День 1', 'День 2', 'День 3', 'День 4', 'День 5'],
                    series: [
                        [12, 9, 3, 8, 4],
                        [2, 1, 4.7, 5.5, 8]
                    ]
                }, {
                    fullWidth: true,
                    chartPadding: {
                        right: 50
                    }
            });
        </script>
    </body>
</html>