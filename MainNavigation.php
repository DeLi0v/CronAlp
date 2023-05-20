
    <ul class="topnav">
      <li><a href="/index.php" <?php if($page == "main") {echo "class=\"active\"";}?> >Главная</a></li>
      <li><a href="/Pages/Booking/booking_page1.php" <?php if($page == "booking") {echo "class=\"active\"";}?> >Бронирование</a></li>
      <li><a href="#" <?php if($page == "about") {echo "class=\"active\"";}?> >О курорте</a></li>
      <li class="right"><a href="/Pages/Account/account.php" <?php if($page == "account") {echo "class=\"active\"";}?> >Личный кабинет</a></li>
      <?php 
      session_name("account");
      session_start();
      if (isset($_SESSION("LogIn")) && $_SESSION("LogIn") == 1) { 
      ?>
      <li class="right">
        <a href="/Pages/Account/logout.php"><img src="/pictures/icons/logout.png" style="max-width: 25px;border: 0;"></a>
      </li>
      <?php } ?>
    </ul>