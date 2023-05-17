<?php
  require  "header.php";
 ?>

      <main>
        <div class="">
          <section>
            <h1>Signup</h1>
            <form action="includes/signup.inc.php" method="post">
              <label for="FirstName"> First Name: </label>
              <input type="text" id="FirstName" name="FirstName" placeholder="First Name"> <br>
              <label for="LastName"> Last Name: </label>
              <input type="text" id="LastName" name="LastName" placeholder="Last Name"> <br>
              <label for="email"> Email: </label>
              <input type="text" name="email" placeholder="E-Mail"> <br>
              <label for="password">Password:</label>
              <input type="password" id="password" name="password" placeholder="Password"> <br>
              <label for="password-repeat">Confirm Password: </label>
              <input type="password" id="password-repeat" name="password-repeat" placeholder="Repeat Password"> <br>
              <label for="phone">Phone: </label>
              <input type="text" id="phone" name="phone" placeholder="phone no."> <br>
              <label for="class">Class: </label>
              <input type="number" id="class" name="class" placeholder="class/standard eg:6"> <br>
              <button type="submit" name="signup-submit">Submit</button>
            </form>
          </section>
        </div>
      </main>

<?php
  require "footer.php";
?>
