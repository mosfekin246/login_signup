<?php
  session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Online Exam</title>
  </head>
  <body>

    <header>
      <nav>
        <!-- <a href="#">
          <img src="logo.png" alt="logo">
        </a> -->
        <a href="signup.php">Signup</a>
        <a href="index.php">Home</a>
        <a href="#">Dashboard</a>
        <a href="account.php">Account</a>
        <a href="#">About</a>
        <div>
          <?php
           if(isset($_SESSION['userId'])){
             echo '<p><form action="includes/logout.inc.php" method="post">
               <button type="submit" name="logout-submit">Logout</button>
             </form></p>';
           }
           else{
             echo '
             <form action="includes/login.inc.php" method="post">
               <input type="text" name="mail_id" placeholder="Username/Email...">
               <input type="password" name="password" placeholder="Password">
               <button type="submit" name="login-submit">Login</button>
               </form>
               ';
           }
           ?>



        </div>
      </nav>
    </header>
