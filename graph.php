<?php
    // header('Content-type: image/png');
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
?>