<?php
if(isset($_POST['signup-submit'])){

   require 'dbh.inc.php';

   $firstName = $_POST['FirstName'];
   $lastName = $_POST['LastName'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $passwordRepeat = $_POST['password-repeat'];
   $class = $_POST['class'];
   $phone = $_POST['phone'];

   if(empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($passwordRepeat)){
     header("Location: ../signup.php?error=emptyfields&FirstName=".$firstName."&LastName=".$lastName."&email=".$email);
     exit();
   }
   else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9 ]*$/",$firstName) && !preg_match("/^[a-zA-Z0-9 ]*$/",$lastName)){
     header("Location: ../signup.php?error=invalidemailFirstNameLastName");
     exit();
   }
   else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
     header("Location: ../signup.php?error=invalidmail&FirstName=".$firstName."&LastName=".$lastName);
     exit();
   }
   else if(!preg_match("/^[a-zA-Z0-9 ]*$/",$firstName) && !preg_match("/^[a-zA-Z0-9 ]*$/",$lastName)){
     header("Location: ../signup.php?error=invalidFirstNameLastName&email=".$email);
     exit();
   }
   else if($password !== $passwordRepeat){
     header("Location: ../signup.php?error=passwordcheck&FirstName=".$firstName."&LastName=".$lastName."&email=".$email);
     exit();
   }
   else{
     $sql = "SELECT email FROM  users WHERE email=?";
     $stmt = mysqli_stmt_init($conn);
     if(!mysqli_stmt_prepare($stmt, $sql)){
       header("Location: ../signup.php?error=sqlerrortop");
       exit();
     }
     else{
       mysqli_stmt_bind_param($stmt, "s", $email);
       mysqli_stmt_execute($stmt);
       mysqli_stmt_store_result($stmt);
       $resultCheck = mysqli_stmt_num_rows($stmt);
       if($resultCheck > 0){
         header("Location: ../signup.php?error=emailalreadyexists&FirstName=".$firstName."&LastName=".$lastName);
         exit();
       }
       else{
         $sql = "INSERT INTO users (firstName, lastName, email, password_i, class, phone) VALUES (?, ?, ?, ?, ?, ?)";
         $stmt = mysqli_stmt_init($conn);
         if(!mysqli_stmt_prepare($stmt, $sql)){
           header("Location: ../signup.php?error=sqlerrorinside");
           exit();
         }
         else{
           $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

           mysqli_stmt_bind_param($stmt, "ssssis", $firstName, $lastName, $email, $hashedPwd, $class, $phone);
           mysqli_stmt_execute($stmt);
           header("Location: ../signup.php?signup=success");
           exit();
         }
       }
     }
   }
   mysqli_stmt_close($stmt);
   mysqli_close($conn);

}
else{
  header("Location: ../signup.php");
  exit();
}
