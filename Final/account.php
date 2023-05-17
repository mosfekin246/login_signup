<?php
  require  "header.php";
 ?>

      <main>
        <?php
        if(isset($_SESSION['userFirst'])){
          require 'includes/dbh.inc.php';
          $id = $_SESSION['userId'];
          $first = $_SESSION['userFirst'];
          $last = $_SESSION['userLast'];
          $mail = $_SESSION['userMail'];
          $class = $_SESSION['userClass'];
          $phone = $_SESSION['userPhone'];

          $sql = "SELECT * from users WHERE id = '$id'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          // $class = $_SESSION['userClass'];
          // $type = $_SESSION['userType'];
          echo '
            <table>
              <tr>
                <td> <strong> Name </strong> </td>
                <td> '.$row['firstName'].' '.$row['lastName'].' </td>
              </tr>
              <tr>
                <td> <strong> Email </strong> </td>
                <td>'.$row['email'].'</td>
              </tr>
              <tr>
                <td> <strong> Class </strong> </td>
                <td>'.$row['class'].'</td>
              </tr>
              <tr>
                <td> <strong> Phone </strong> </td>
                <td>'.$row['phone'].'</td>
              </tr>
            </table>
          ';
         }
        else{
          echo "<p> You are currently logged out! </p>";
        }
         ?>
      </main>

      <p>Which Option Would You like to Update!</p>
      <form action="account.php" method="post">
        <button type="submit" name="email">Email</button> <br>
        <button type="submit" name="firstName">First Name</button> <br>
        <button type="submit" name="lastName">Last Name</button> <br>
        <button type="submit" name="class">Class</button> <br>
        <button type="submit" name="phone">Phone</button> <br>
        <button type="submit" name="password">Password</button> <br>
      </form>

<?php

    if(isset($_POST['email']) && isset($_SESSION['userId'])){
      echo '
      <form action="account.php" method="post">
      <input type="text" name="emailInput" placeholder="Enter new mail id">
      <button type="submit" name="emailButton">Submit</button>
      </form>
      ';
    }
    else if(isset($_POST['firstName'])  && isset($_SESSION['userId'])){
      echo '<form action="account.php" method="post">
      <input type="text" name="firstNameInput" placeholder="your first name">
      <button type="submit" name="firstNameButton">Submit</button>
      </form>
      ';
    }
    else if(isset($_POST['lastName'])  && isset($_SESSION['userId'])){
      echo '<form action="account.php" method="post">
      <input type="text" name="lastNameInput" placeholder="your last name">
      <button type="submit" name="lastNameButton">Submit</button>
      </form>
      ';
    }
    else if(isset($_POST['class'])  && isset($_SESSION['userId'])){
      echo '<form action="account.php" method="post">
      <input type="text" name="classInput" placeholder="class or standard">
      <button type="submit" name="classButton">Submit</button>
      </form>
      ';
    }
    else if(isset($_POST['phone'])  && isset($_SESSION['userId'])){
      echo '<form action="account.php" method="post">
      <input type="text" name="phoneInput" placeholder="your phone no.">
      <button type="submit" name="phoneButton">Submit</button>
      </form>
      ';
    }
    else if(isset($_POST['password'])  && isset($_SESSION['userId'])){
      echo '<form action="account.php" method="post">
      <input type="password" name="passInput" placeholder="your password">
      <input type="password" name="repeat-passInput" placeholder="your password">
      <button type="submit" name="passButton">Submit</button>
      </form>
      ';
    }
    ?>
<?php
  require 'includes/dbh.inc.php';

  if(isset($_POST['emailButton'])){
    $newMail = $_POST['emailInput'];
    $sql = "UPDATE users SET email = ? WHERE id = '$id';";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: index.php?error=emailupdateerror"); //change error=subjectsearcherror
      exit();
    }
    else{
      mysqli_stmt_bind_param($stmt, "s", $newMail); //change $subject
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      header("Location: account.php?updateemailsuccess");
    }
  }
  else if(isset($_POST['firstNameButton'])){
    $newFirstName = $_POST['firstNameInput'];
    $sql = "UPDATE users SET firstName = ? WHERE id = '$id';";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: index.php?error=firstNameupdateerror"); //change error=subjectsearcherror
      exit();
    }
    else{
      mysqli_stmt_bind_param($stmt, "s", $newFirstName); //change $subject
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      header("Location: account.php?updatefirstnamesuccess");
    }
  }
  else if(isset($_POST['lastNameButton'])){
    $newLastName = $_POST['lastNameInput'];
    $sql = "UPDATE users SET lastName = ? WHERE id = '$id';";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: index.php?error=lastNameupdateerror"); //change error=subjectsearcherror
      exit();
    }
    else{
      mysqli_stmt_bind_param($stmt, "s", $newLastName); //change $subject
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      header("Location: account.php?updatelastnamesuccess");
    }
  }
    else if(isset($_POST['classButton'])){
      $newClass = $_POST['classInput'];
      $sql = "UPDATE users SET class = ? WHERE id = '$id';";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: index.php?error=classupdateerror"); //change error=subjectsearcherror
        exit();
      }
      else{
        mysqli_stmt_bind_param($stmt, "i", $newClass); //change $subject
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        header("Location: account.php?updateclasssuccess");
      }
    }
    else if(isset($_POST['phoneButton'])){
      $newPhone = $_POST['phoneInput'];
      $sql = "UPDATE users SET phone = ? WHERE id = '$id';";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: index.php?error=phoneupdateerror"); //change error=subjectsearcherror
        exit();
      }
      else{
        mysqli_stmt_bind_param($stmt, "s", $newPhone); //change $subject
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        header("Location: account.php?updatephonesuccess");
      }
    }
      else if(isset($_POST['passButton'])){
        $newPass = $_POST['passInput'];
        $newRepeatPass = $_POST['repeat-passInput'];
        $sql = "UPDATE users SET firstName = ? WHERE id = '$id';";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
          header("Location: index.php?error=passwordupdateerror"); //change error=subjectsearcherror
          exit();
        }
        else{
          mysqli_stmt_bind_param($stmt, "s", $newFirstName); //change $subject
          mysqli_stmt_execute($stmt);
          mysqli_stmt_store_result($stmt);
          header("Location: account.php?updatepasswordsuccess");
        }
      }

?>
<?php
  require "footer.php";
 ?>
