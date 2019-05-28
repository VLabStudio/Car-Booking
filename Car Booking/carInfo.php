<!DOCTYPE html>
<html>
<head>
  <title>Car Booking - Car info</title>
  <link rel="stylesheet" type="text/css" href="css/Style.css">
  <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
</head>
<body>
  <?php include 'Objects/NavigationBar.php'; ?>
  <div class="center">
      <div class="carInfo">
        <?php
              if (!empty($_GET['CarID']))
               {
                   require_once 'Objects/ConnectDB.php';
                   $CarID = $_GET['CarID'];
                   $statement = $DBH->prepare("SELECT * FROM `carinfo` WHERE CarID = ?");
                   $statement->bindParam(1, $CarID);
                   $statement->execute();
                 while ($row = $statement->fetch())
                 {
                    echo  "<h1>" . $row['Name'] . "</h1>" . "<br><br>";
                      echo "<div class='columns'> <table>";

                        echo "<tr>";
                          echo "<td><b>Color</b></td>";
                          echo "<td>". $row['Color'] ."</td>";
                        echo "</tr>";

                        echo "<tr>";
                          echo "<td><b>Years old</b></td>";
                          echo "<td>".  $row['YearsOld'] ."</td>";
                        echo "</tr>";

                        echo "<tr>";
                          echo "<td><b>License plate</b></td>";
                          echo "<td>".  $row['LicensePlate'] ."</td>";
                        echo "</tr>";

                        echo "<tr>";
                          echo "<td><b>Seats</b></td>";
                          echo "<td>".  $row['Seats'] ."</td>";
                        echo "</tr>";

                        echo "<tr>";
                          echo "<td><b>Doors</b></td>";
                          echo "<td>".  $row['Doors'] ."</td>";
                        echo "</tr>";

                        echo "<tr>";
                          echo "<td><b>Gear type</b></td>";
                          echo "<td>".  $row['GearType'] ."</td>";
                        echo "</tr>";

                        echo "<tr>";
                          echo "<td><b>Fuel type</b></td>";
                          echo "<td>".  $row['FuelType'] ."</td>";
                        echo "</tr>";

                      echo "</table>";
                    echo "</div>";
                  echo  '<img src="'.$row['PhotoURL'].'"alt="HTML5 Icon">';
                 }
                  echo '<div class="Button"> <button class="submitButton" onclick="history.go(-1);">Back</button> </div>';
               }
               else
               {
                  echo "<h1>No car info</h1>";
               }
         ?>
      </div>
   </div>
</body>
</html>
