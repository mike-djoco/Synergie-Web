<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>NavBar</title>
</head>
<body>
    <nav class="navbar">
        <h1>
            Barcelone
        </h1>
        <div class="nav-action">
            <?php
              if (isset($_SESSION['user_auth'])) {
                echo '
                    <form action="navbar.html">
                        <input type="submit" value="Déconnexion">
                    </form>
                ';
              }

              if(!isset($_SESSION['user_auth'])){
                echo '
                    <form action="login.php">
                        <input type="submit" value="Connection">
                    </form>
                ';
              }
            ?>
        </div>
        
       
    </nav>
    
</body>
</html>