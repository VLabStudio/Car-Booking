<!DOCTYPE html>
<html>
<head>
  <title>Car Booking - Booking</title>
  <link rel="stylesheet" type="text/css" href="css/Style.css">
  <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
</head>
<body>
  <?php
      if (!empty($_POST["CarID"]) & !empty($_POST["FirstDay"]) & !empty($_POST["LastDay"]))
       {
         require_once 'Objects/Booking.php';

         $booking = new Booking();
         $booking->Book($_POST["CarID"],$_POST["FirstDay"],$_POST["LastDay"]);
      }
  ?>
</body>
</html>
