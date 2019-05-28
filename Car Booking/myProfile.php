<!DOCTYPE html>
<html>
<head>
  <title>Car Booking - my profile</title>
  <link rel="stylesheet" type="text/css" href="css/Style.css">
  <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
</head>
<body>
  <?php
        include 'Objects/NavigationBar.php';
        require_once 'Objects/ConnectDB.php';
        require_once 'Objects/UserSession.php';

         if (!empty($_POST['undo']))
         {
           $CarID = $_POST['CarID'];

           $statement = $DBH->prepare("DELETE FROM carbookings WHERE CarID = ?");
           $statement->bindParam(1, $CarID);
           $statement->execute();
         }

        $userSession = new UserSession();

        $sessionArray = $userSession->GetSession();
        $UserID  = $userSession->FindUser($sessionArray [0],$sessionArray[1]);

        $userSession->ShowUserCars($UserID);
   ?>
</body>
</html>
