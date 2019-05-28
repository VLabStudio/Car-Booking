<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="./css/NavigationBarStyle.css">
  </head>
  <body>
    <div class="navigationBar">
      <ul>
        <li><a href="./home.php">Home</a></li>
        <li><a href="./about.php">About</a></li>
        <li><a href="./bookSearch.php">Find car</a></li>
      
        <?php
          require_once 'UserSession.php';
          $userSession = new UserSession();

          if($userSession->IsSession())
          {
            echo "<li><a href='./myProfile.php'>My profile</a></li>";
            echo "<li><a href='./logout.php'>Log out</a></li>";
          }
          else
          {
            echo "<li><a href='./login.php'>Sign in</a></li>";
          }
        ?>
      </ul>
  </div>
  </body>
</html>
