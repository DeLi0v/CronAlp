<!DOCTYPE html>
<html>

<head>
    <?php include_once("MainHead.php") ?>
    <link rel="stylesheet" href="/Styles/slideshow.css">
</head>

<body>
    <?php $page = "main" ?>
    <?php include_once("MainNavigation.php") ?>
    
    <div class="slideshow-container">
        <!-- Full-width images with number and caption text -->
        <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            <img src="/pictures/img/1.jpg" style="width:100%">
            <div class="text">Caption Text</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <img src="/pictures/img/2.jpg" style="width:100%">
            <div class="text">Caption Two</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">3 / 3</div>
            <img src="/pictures/img/3.jpg" style="width:100%">
            <div class="text">Caption Three</div>
        </div>

        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>

    <!-- The dots/circles -->
    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>
    <h3 style="text-align: center;">Добро пожаловать на сайт грнолыжного курорта "Альпийская крона!"</h3>
    <p>В данный момент сайт находится в разработке, поэтому работает только часть функций, а дизайн является лишь прототипом.
        <br>В процессе разработки функции и дизайн будут меняться!
    </p>
</body>

</html>