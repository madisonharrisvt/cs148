<?php
session_start();
include('db.php');
$email = "";
$password = "";
$emailERROR = false;
$queryERROR = false;
$confirmERROR = false;

$errorMsg = array();

if (isset($_POST["btnSubmit"])) {
    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
    $password = $_POST["pwdPassword"];
    if ($email == "") {
        $errorMsg[] = "Please enter your email address";
        $emailERROR = true;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg[] = "Your email address appears to be incorrect.";
        $emailERROR = true;
    }

    if (!$errorMsg) {

        $query ="SELECT fldEmailAddress, fldPassword, fldConfirmed FROM tblRegister WHERE fldEmailAddress = ? AND fldPassword = ?;";
        $data = array($email, $password);
        $results = $thisDatabase->select($query, $data);
        $numberRecords = count($results[0]);
        $confirmed = $results[0][2];
        
        if($numberRecords >= 4){

            if($results[0][2] == 0){
                $confirmERROR = true;
                $errorMsg[] = "You have not confirmed your email address yet.  Please confirm your account via email to continue.";
            }
            else{ 
                $_SESSION["user"] = $_POST["txtEmail"];
                header("Location: index.php");
            }
        }

        else{
            $queryERROR = true;
            $errorMsg[] = "Your username/password is incorrect";
        } //data entered  
    } // end form is valid
} // ends if form was submitted.

include('top.php');
include "loggedIn.php";

print '<article id="main">';
if ($errorMsg) {
    print '<div id="errors">';
    print "<ol>\n";
    foreach ($errorMsg as $err) {
        print "<li>" . $err . "</li>\n";
    }
    print "</ol>\n";
    print '</div>';
} 
?>
        <form action="<?php print $phpSelf; ?>"
              method="post"
              id="frmRegister">
            <fieldset class="wrapper">
                <legend>Sign In Here</legend>
                <p class="registerParagraph">If you don't have an account, please register <a id = "loginOutConfirmation" href = "register.php">here</a></p>
                    <fieldset class="register">
                        <legend>Account Information</legend>

                        <label for="txtEmail" class="required">Email
                            <input type="text" id="txtEmail" name="txtEmail"
                                   value="<?php print $email; ?>"
                                   tabindex="120" maxlength="45" placeholder="Enter a valid email address"
                                   <?php if ($queryERROR) print 'class="mistake"'; ?>
                                   onfocus="this.select()"
                                   >
                        </label>
                        <label for="pwdPassword" class="required">Password
                            <input type="password" id="pwdPassword" name="pwdPassword"
                                   value="<?php print $password; ?>"
                                   tabindex="120" maxlength="45" placeholder = "password"
                                    <?php if ($queryERROR) print 'class="mistake"'; ?>
                                   onfocus="this.select()"
                                   >
                        </label>
                    </fieldset> <!-- ends contact -->
                <fieldset class="buttons">
                    <legend></legend>
                    <input type="submit" id="btnSubmit" name="btnSubmit" value="Login" tabindex="900" class="button">
                </fieldset> <!-- ends buttons -->
            </fieldset> <!-- Ends Wrapper -->
        </form>
    </article>



<?php
include "footer.php";
?>
</body>
</html>