<?php
    class UserSession {
        // Methods
        function SetSession ($username,$password)
        {
          if (!isset($_SESSION))
           {
             session_start();
           }

            // Set session variables
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
         }

        function GetSession ()
         {
             if (!isset($_SESSION))
              {
                session_start();
              }

             if (!empty($_SESSION["username"]) && !empty($_SESSION["password"]))
             {
               $session = array();
               // Get session variables
               $session[0] = $_SESSION["username"];
               $session[1] =  $_SESSION["password"];
               return $session;
             }
          }

          function IsSession ()
           {
             if (!isset($_SESSION))
              {
                session_start();
              }

             if (!empty($_SESSION["username"]) && !empty($_SESSION["password"]))
             {
                  return true;
             }
             else
             {
                  return false;
             }
           }

        function FindUser ($username,$password)
         {
           if (!empty($username) && !empty($password))
           {
              require 'ConnectDB.php';

              $statement = $DBH->prepare("SELECT * FROM users WHERE UserName=? and Password=?");
              $statement->bindParam(1, $username);
              $statement->bindParam(2, $password);
              $statement->execute();

              while ($row = $statement->fetch())
              {
                return $row['UserID'];
              }

              // Close the connection
              $DBH = null;
           }
         }

         function GetUserName($userID)
         {
            require 'ConnectDB.php';
            $name = "null";

             $statement = $DBH->prepare("SELECT UserName FROM users WHERE UserID=?");
             $statement->bindParam(1, $userID);
             $statement->execute();
             while ($row = $statement->fetch()) {
                  $name = $row['UserName'];
               }

             // Close the connection
             $DBH = null;

            return $name;
         }

        function GetUserCarBookings($userID)
        {
          require 'ConnectDB.php';

          $bookings = 0;

          $statement = $DBH->prepare("SELECT UserID FROM carbookings WHERE UserID=?;");
          $statement->bindParam(1, $userID);
          $statement->execute();
          while ($row = $statement->fetch()) {
                $bookings++;
            }

          return $bookings;
        }

        function GetUserType($userID)
        {
            require 'ConnectDB.php';

            $statement = $DBH->prepare("SELECT UserType,UserID FROM users WHERE UserID=?");
            $statement->bindParam(1, $userID);
            $statement->execute();
            while ($row = $statement->fetch()) {
                  return $row['UserType'];
              }
        }

        function ShowUserCars($userID)
        {
          require 'ConnectDB.php';

          $isAdmin = false;

          $statement = $DBH->prepare("SELECT UserType,UserID FROM users WHERE UserType='admin' AND UserID=?");
          $statement->bindParam(1, $userID);
          $statement->execute();
          while ($row = $statement->fetch()) {
                $isAdmin = true;
            }

          if($isAdmin == true)
          {
            $statement = $DBH->prepare("SELECT carbookings.CarID,carbookings.UserID,carbookings.FirstDay,carbookings.LastDay,carinfo.Name,carinfo.Color,carinfo.YearsOld,carinfo.PhotoURL FROM carbookings LEFT JOIN carinfo ON carbookings.CarID=carinfo.CarID");
          }
          else
          {
            $statement = $DBH->prepare("SELECT carbookings.CarID,carbookings.UserID,carbookings.FirstDay,carbookings.LastDay,carinfo.Name,carinfo.Color,carinfo.YearsOld,carinfo.PhotoURL FROM carbookings LEFT JOIN carinfo ON carbookings.CarID=carinfo.CarID WHERE carbookings.UserID=?;");
          }
          $statement->bindParam(1, $userID);
          $statement->execute();

          echo "<div class='center'>";
                    echo "<div class='cars'>";
                       echo "<ul>";
                          while ($row = $statement->fetch()) {
                           echo "<a href='carInfo.php?CarID=".$row['CarID'] ."'>". "<li> <form action='myProfile.php' method='post'>";
                                echo "<h3>". $row['Name'] ."</h3>";
                                echo '<img width="1920" height="1080" src="'.$row['PhotoURL'].'">';
                                echo "<p> Color: " . $row['Color'] . "<br>";
                                echo "Years Old: " . $row['YearsOld'] . "<br> <br>";
                                echo "Book to " . $this->GetUserName($row['UserID']) . "<br>";
                                echo "From: " . $row['FirstDay'] . "<br> To: " . $row['LastDay'] . "<br></p>";
                                echo " <input type='hidden' name='CarID' value=".$row['CarID'].">";
                                echo "<input class='submitButton' type='submit' name = 'undo' value='Cancel booking'>";
                            echo "</li> </form> </a>";
                           }
                    echo "</ul>";
                echo "</div>";
          echo "</div>";

           // Close the connection
           $DBH = null;
        }
      }

?>
