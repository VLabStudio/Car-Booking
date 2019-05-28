<?php
    class Booking {
        // Methods
        function Search($firstDay,$lastDay)
        {
          if (!empty($firstDay) && !empty($lastDay))
          {
            if($firstDay != $lastDay)
            {
            $firstDate = date_create($firstDay);
            $lastDate = date_create($lastDay);
            if($firstDate < $lastDate)
            {
               require_once 'ConnectDB.php';
               $firstDay = preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4', $firstDay);
               $lastDay = preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4', $lastDay);
               $statement = $DBH->prepare("SELECT cars.CarID,carinfo.Name,carinfo.Color,carinfo.YearsOld,carinfo.PhotoURL FROM cars LEFT JOIN carinfo ON cars.CarID=carinfo.CarID;");
               $statement->execute();
     echo "<div class='center'>";
               echo "<div class='cars'>";
                  echo "<ul>";

               $CarNum = 0;

               while ($row = $statement->fetch())
               {
                  $statementTest = $DBH->prepare("SELECT * FROM carbookings  WHERE CarID = ?");
                  $statementTest->bindParam(1, $row['CarID']);
                  $statementTest->execute();
                  $add = true;
                   while ($rowTest = $statementTest->fetch())
                   {
                      if(!$this->isColliding($firstDay,$lastDay,$rowTest['FirstDay'],$rowTest['LastDay']))
                      {
                        $add = false;
                      }
                   }

                  if($add == true)
                  {
                    echo "<a href='carInfo.php?CarID=".$row['CarID'] ."'>". "<li> <form action='book.php' method='post'>";
                        echo " <input type='hidden' name='CarID' value=".$row['CarID'].">";
                        echo " <input type='hidden' name='FirstDay' value=".$firstDay.">";
                        echo " <input type='hidden' name='LastDay' value=".$lastDay.">";
                        echo "<h3>". $row['Name'] ."</h3>";
                        echo '<img width="1920" height="1080" src="'.$row['PhotoURL'].'">';
                        echo "<p> Color: " . $row['Color'] . "<br>";
                        echo "Years Old: " . $row['YearsOld'] . "<br> </p>";
                        require_once 'UserSession.php';
                        $userSession = new UserSession();
                        if($userSession->IsSession())
                         {
                           echo "<input class='submitButton' type='submit' value='Book'>";
                         }
                    echo "</li> </form> </a>";
                   $CarNum++;
                  }
               }
                  echo "</ul>";
               echo "</div>";
      echo "</div>";
                // Close the connection
               $DBH = null;

               if($CarNum == 0)
               {
                  echo "<h1>No cars found error</h1>";
               }
          }
          else {
             echo "<h1>The first date is the last date error</h1>";
          }
         }
         else {
             echo "<h1>Minimum booking on cars is 2 days</h1>";
         }
        }
        else {
             echo "<h1>No cars found error</h1>";
        }
       }
        function isColliding($firstDateOne,$lastDateOne,$firstDateTo,$lastDateTo)
        {
          // The return
          $returned = true;
          // A list of all the dates in between the firstDateOne and the lastDateOne
          $betweenDateOne = $this->getBetweenDate($firstDateOne ,$lastDateOne);
          // A list of all the dates in between the firstDateTo and the lastDateTo
          $betweenDateTo = $this->getBetweenDate($firstDateTo,$lastDateTo);
          foreach ($betweenDateOne as $key => $dateOne)
           {
            foreach ($betweenDateTo as $key => $dateTo)
             {
                if($dateOne == $dateTo)
                {
                  $returned = false;
                }
             }
          }
          return $returned;
        }

        function getBetweenDate($firstDate,$lastDate)
        {
            // takes two dates formatted as YYYY-MM-DD and creates an
            // inclusive array of the dates between the from and to dates.

            $aryRange=array();

            $iDateFrom=mktime(1,0,0,substr($firstDate,5,2),     substr($firstDate,8,2),substr($firstDate,0,4));
            $iDateTo=mktime(1,0,0,substr($lastDate,5,2),     substr($lastDate,8,2),substr($lastDate,0,4));

            if ($iDateTo>=$iDateFrom)
            {
                array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
                while ($iDateFrom<$iDateTo)
                {
                    $iDateFrom+=86400; // add 24 hours
                    array_push($aryRange,date('Y-m-d',$iDateFrom));
                }
            }
            return $aryRange;
        }

        function Book($CarID,$firstDay,$lastDay)
        {
           require_once 'ConnectDB.php';
           require_once 'UserSession.php';
           $userSession = new UserSession();
           $sessionArray = $userSession->GetSession();
           $UserID  = $userSession->FindUser($sessionArray [0],$sessionArray[1]);

           if($userSession->GetUserType($UserID) == "admin")
           {
             $statement = $DBH->prepare("INSERT INTO carbookings (`ID`, `CarID`,`UserID`, `FirstDay`, `LastDay`) VALUES (NULL, ?, ?, ?, ?);");
             $statement->bindParam(1, $CarID);
             $statement->bindParam(2, $UserID);
             $statement->bindParam(3, $firstDay);
             $statement->bindParam(4, $lastDay);
             $statement->execute();
             echo "<div class='booked'>";
             echo "The car is booked" ." From: " . $firstDay . " To: ". $lastDay;
             echo '<br> <button class="submitButton" onclick="history.go(-2);"> Back</button>';
             echo "</div>";
           }
           else if($userSession->GetUserType($UserID) == "user" && $userSession->GetUserCarBookings($UserID) < 5)
           {
              $statement = $DBH->prepare("INSERT INTO carbookings (`ID`, `CarID`,`UserID`, `FirstDay`, `LastDay`) VALUES (NULL, ?, ?, ?, ?);");
              $statement->bindParam(1, $CarID);
              $statement->bindParam(2, $UserID);
              $statement->bindParam(3, $firstDay);
              $statement->bindParam(4, $lastDay);
              $statement->execute();
              echo "<div class='booked'>";
              echo "The car is booked" ." From: " . $firstDay . " To: ". $lastDay;
              echo '<br> <button class="submitButton" onclick="history.go(-2);"> Back</button>';
              echo "</div>";
            }
            else if($userSession->GetUserType($UserID) == "user" && $userSession->GetUserCarBookings($UserID) < 5)
            {
               $statement = $DBH->prepare("INSERT INTO carbookings (`ID`, `CarID`,`UserID`, `FirstDay`, `LastDay`) VALUES (NULL, ?, ?, ?, ?);");
               $statement->bindParam(1, $CarID);
               $statement->bindParam(2, $UserID);
               $statement->bindParam(3, $firstDay);
               $statement->bindParam(4, $lastDay);
               $statement->execute();
               echo "<div class='booked'>";
               echo "The car is booked" ." From: " . $firstDay . " To: ". $lastDay;
               echo '<br> <button class="submitButton" onclick="history.go(-2);"> Back</button>';
               echo "</div>";
             }
             else if($userSession->GetUserType($UserID) == "company" && $userSession->GetUserCarBookings($UserID) < 10)
             {
                $statement = $DBH->prepare("INSERT INTO carbookings (`ID`, `CarID`,`UserID`, `FirstDay`, `LastDay`) VALUES (NULL, ?, ?, ?, ?);");
                $statement->bindParam(1, $CarID);
                $statement->bindParam(2, $UserID);
                $statement->bindParam(3, $firstDay);
                $statement->bindParam(4, $lastDay);
                $statement->execute();
                echo "<div class='booked'>";
                echo "The car is booked" ." From: " . $firstDay . " To: ". $lastDay;
                echo '<br> <button class="submitButton" onclick="history.go(-2);"> Back</button>';
                echo "</div>";
              }
            else {
              echo "<div class='booked'>";

              if ($userSession->GetUserType($UserID) == "user"){
                echo "The maximum number of booked cars for user type is 5";
              }
              else if ($userSession->GetUserType($UserID) == "company"){
                echo "The maximum number of booked cars for company type is 10";
              }
              echo '<br> <button class="submitButton" onclick="history.go(-2);"> Back</button>';
              echo "</div>";
            }

           // Close the connection
          $DBH = null;
        }
    }
?>
