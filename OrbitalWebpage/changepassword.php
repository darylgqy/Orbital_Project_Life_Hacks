<?php
	include "connect.php" ;
  include '/home/lifehac5/public_html/inc/header.inc.php';

  $msg = '';
  //Password variables
  $old_password = stripslashes(@$_POST['oldpassword']);
  $new_password = stripslashes(@$_POST['newpassword']);
  $repeat_password = stripslashes(@$_POST['newpassword2']);
  
  //If the form has been submitted ...
  if (@$_POST['senddata']) {
    $password_query = mysql_query("SELECT * FROM users WHERE id='$user_id'");
    while ($row = mysql_fetch_assoc($password_query))
      $db_password = $row['password'];

    //hash the old password before checking if it matches
    $old_password = hash('sha256', $old_password);
        
    //Check whether old password equals $db_password
    if ($old_password == $db_password) {
      //Check whether the 2 new passwords match
      if ($new_password == $repeat_password) {
        if (strlen($new_password) < 8) 
          $msg = "Sorry! But your password must be more than 8 character long!";
        else{
          //sha256 the new password before we add it to the database
          $new_password = hash('sha256', $new_password);
          //Great! Update the users passwords!
          $password_update_query = mysql_query("UPDATE users SET password='$new_password' WHERE id='$user_id'");
          date_default_timezone_set("Singapore");
          $msg = "Success! Your password has been updated! The time is " . date("h:i:sa");
        }
      }
      else
        $msg = "Your two new passwords don't match!";
    }
    else
      $msg = "The old password is incorrect!";
  
  }

?>
<html>
  <div class="container">
   <form action="changepassword.php" method="post">
      <h2>Change Password</h2>
      <h4>
        Your Old Password:<p></p>
        <input type="password" name="oldpassword" id="oldpassword" size="40"><p></p>
        Your New Password: <p></p>
        <input type="password" name="newpassword" id="newpassword" size="40"><p></p>
        Repeat Password: <p></p>
        <input type="password" name="newpassword2" id="newpassword2" size="40"><p></p>
        <input type="submit" name="senddata" id="senddata" value="Update Information"><p></p>
      </h4>
      <?php
        if(!empty($msg))
          echo $msg;
      ?>
   </form>
  </div>
</html>

<?php include 'plugin.php'; ?>