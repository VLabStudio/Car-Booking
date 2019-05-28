<!DOCTYPE html>
<html>
<head>
  <title>Car Booking - Sign in</title>
  <link rel="stylesheet" type="text/css" href="css/Style.css">
  <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
</head>
<body>
  <?php include 'Objects/NavigationBar.php';?>
  <div class="center">
     <form action="login.php" method="post">
          <div class="container">
            <label><b>User name</b></label>
            <input type="text" placeholder="Indtast username" name="uname" required>

            <label><b>Password</b></label>
            <input type="password" placeholder="Indtast password" name="psw" required>

            <button type="submit" class="submitButton">Sign in</button>
          </div>
    </form>
  </div>
    <?php
        if (!empty($_POST["uname"]) && !empty($_POST["psw"]))
         {
            require_once 'Objects/Validate.php';
            $validate = new Validate();

            if($validate->Check($_POST["uname"],$_POST["psw"]))
            {
              echo "<div class='loginMessage'> Login gyldigt </div>";

              header('Location: bookSearch.php');
            }
            else
            {
              echo "<div class='loginMessage'> Login Ugyldig </div>";
            }
        }
    ?>
</body>
</html>
