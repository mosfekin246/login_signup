<?php
  require  "header.php";
 ?>

      <main>
        <?php
         if(isset($_SESSION['userId']) && $_SESSION['userType'] == 'Admin'){
           echo "<p> You are logged in As admin! </p>";
         }
        else if(isset($_SESSION['userId']) && $_SESSION['userType'] == 'Student'){
          echo "<p> You are logged out in As student </p>";
        }
        else{
          echo "<p>  You are not logged in! </p>";
        }

         ?>
      </main>

<?php
  require "footer.php";
 ?>
