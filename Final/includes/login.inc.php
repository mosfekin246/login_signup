<?php
if(isset($_POST['login-submit'])){

  require 'dbh.inc.php';

  $mailuid = $_POST['mail_id'];
  $password = $_POST['password'];

  if(empty($mailuid) || empty($password)){
    header("Location: ../index.php?error=emptyfields");
    exit();
  }
  else{
    $sql = "SELECT * FROM users WHERE email=?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../index.php?error=sqlerrorline17");
      exit();
    }
    else{
      mysqli_stmt_bind_param($stmt, "s", $mailuid);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if($row = mysqli_fetch_assoc($result)){
        $pwdCheck = password_verify($password, $row['password_i']);
        if(!$pwdCheck){
          header("Location: ../index.php?error=wrongpassword1");
          exit();
        }
        else if($pwdCheck){
           session_start();
           $_SESSION['userId'] = $row['id'];
           $_SESSION['userFirst'] = $row['firstName'];
           $_SESSION['userLast'] = $row['lastName'];
           $_SESSION['userMail'] = $row['email'];
           $_SESSION['userClass'] = $row['class'];
           $_SESSION['userPhone'] = $row['phone'];
           $_SESSION['userType'] = $row['userType'];
           header("Location: ../index.php?login=success");
           exit();
        }
        else{
          header("Location: ../index.php?error=wrongpassword2");
          exit();
        }
      }
      else{
        header("Location: ../index.php?error=sqlerrrorline27");
        exit();
      }
    }
  }

}
else{
  header("Location: ../index.php");
  exit();
}
