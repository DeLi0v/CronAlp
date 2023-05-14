<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="Styles/MainStyles.css">
    <link rel="stylesheet" href="Styles/AdminPanelStyles.css">
</head>

<body>
    <?php include "head.php"; ?>
    <div>
    <p>Добро пожаловать в административную панель, сверху выберете какую таблицу хотите открыть</p>
    </div>

    <?php
    header('Content-type: image/png');
    $image = imageCreateTrueColor(600, 280);
    $white = imageColorAllocate($image, 255, 255, 255);
    imagefilledrectangle($image, 0, 0, 599, 279, $white);
    $blue = imageColorAllocate($image, 0, 0, 255);
    imageLine($image, 50, 250, 570, 250, $blue);
    imageLine($image, 50, 50, 50, 250, $blue);
    imageLine($image, 150, 246, 150, 249, $blue);
    imageLine($image, 250, 246, 250, 249, $blue);
    imageLine($image, 350, 246, 350, 249, $blue);
    imageLine($image, 450, 246, 450, 249, $blue);
    imageLine($image, 550, 246, 550, 249, $blue);
    imageString($image, 5, 145, 255, '1', $blue);
    imageString($image, 5, 245, 255, '2', $blue);
    imageString($image, 5, 345, 255, '3', $blue);
    imageString($image, 5, 445, 255, '4', $blue);
    imageString($image, 5, 545, 255, '5', $blue);
    imageLine($image, 51, 160, 54, 160, $blue);
    imageLine($image, 51, 60, 54, 60, $blue);
    imageString($image, 5, 30, 155, '10', $blue);
    imageString($image, 5, 30, 55, '20', $blue);
    imagepng($image);
    imagedestroy($image);

    $mas = array(2, 7, 20, 9, 14);
    $points = array(
    array ('x' => 150, 'y' => 230),
    array ('x' => 250, 'y' => 180),
    array ('x' => 350, 'y' => 50),
    array ('x' => 450, 'y' => 160),
    array ('x' => 550, 'y' => 90)
    );

    $green = imageColorAllocate($image, 50, 237, 35); //цвет графика
    imageSetThickness($image, 2); //толщина линий
    $num_points = count($points);
    for ($i=0; $i<=$num_points-2; $i++)
    {
    imageLine($image, $points[$i]['x'], $points[$i]['y'], $points[$i+1]['x'], $points[$i+1]['y'], $green);
    }

    header('Content-type: image/png');
    $regusers = array(2, 7, 20, 9, 14);
    $segments_x = count($regusers); //количество сегментов
    $lengthsegment_x = floor((570-50)/($segmentx_x - 1)); //длина сегмента

    $max = max($regusers);
    $min = min($regusers);
    $lengthsegment_y = floor((250-50)/($max - $min));

    $image = imageCreateTrueColor(600, 280);
    $white = imageColorAllocate($image, 255, 255, 255);
    imagefilledrectangle($image, 0, 0, 599, 279, $white);
    $blue = imageColorAllocate($image, 0, 0, 255);
    imageLine($image, 50, 250, 570, 250, $blue);
    imageLine($image, 50, 50, 50, 250, $blue);

    for ($i=1; $i<=5; $i++)
    {
    $x = 50 + $lengthsegment_x * ($i - 1);
    if ($i > 1)
    imageLine($image, $x, 246, $x, 249, $blue);
    imagestring($image, 5, $x-1, 255, "$i", $blue);
    }

    $y = 250 - $lengthsegment_y * ($max - $min);
    imageLine($image, 51, $y, 54, $y, $blue);
    $num = $max;
    imageString($image, 5, 30, $y-5, "$num", $blue);
    $y = 250 - $lengthsegment_y * floor(($max-$min) / 2);
    imageLine($image, 51, $y, 54, $y, $blue);
    $num = $min + floor(($max - $min) / 2);
    imageString($image, 5, 30, $y-5, "$num", $blue);
    $num = $min;
    imageString($image, 5, 30, 241, "$num", $blue);

    $green = imageColorAllocate($image, 50, 237, 35);
    imageSetThickness($image, 2);
    for ($i=0; $i<=$segments_x-1; $i++)
    {
    $x1 = 50 + $i * $lengthsegment_x;
    $y1 = 250 - ($regusers[$i] - $min) * $lengthsegment_y;
    if ($i>0)
    imageLine($image, $x1, $y1, $x2, $y2, $green);
    $x2 = $x1;
    $y2 = $y1;
    }
    imagepng($image);
    imagedestroy($image);
    ?>
</body>

</html>