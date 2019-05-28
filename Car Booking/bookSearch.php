<!DOCTYPE html>
<html>
<head>
  <title>Car Booking - Booking</title>
  <link rel="stylesheet" type="text/css" href="css/Style.css">
  <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
</head>
<body>
  <?php include 'Objects/NavigationBar.php';?>
  <div class="center">
    <div class="search">
      <form action="bookSearch.php" method="post">
        <input type="date" name="firstDay" min="<?php echo date("Y-m-d");?>" max="<?php $max = date_create(date("Y-m-d")); $max->modify('+12 month'); echo date_format($max, 'Y-m-d');?>" value="<?php echo date("Y-m-d");?>">
        <input type="date" name="lastDay" min="<?php echo date("Y-m-d");?>" max="<?php $max = date_create(date("Y-m-d")); $max->modify('+12 month'); echo date_format($max, 'Y-m-d');?>" value="<?php echo date("Y-m-d");?>"><br><br>
        <input class='submitButton' type="submit" value="Search">
      </form>
    </div>
  </div>
  <?php
      header('Cache-Control: no cache');
      session_cache_limiter('private_no_expire');
      if (!isset($_SESSION))
      {
        session_start();
      }

      if (!empty($_POST["firstDay"]) && !empty($_POST["lastDay"]))
       {
         require_once 'Objects/Booking.php';

         $booking = new Booking();
         $booking->Search($_POST['firstDay'],$_POST["lastDay"]);
      }
  ?>
</body>
</html>
