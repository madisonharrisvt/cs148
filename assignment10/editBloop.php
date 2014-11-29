<?php
session_start();
include('db.php');
$name;
$color;

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
                header("Location: admin.php");
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
                <legend>Edit Bloop</legend>
                <p class="registerParagraph">Modify the fields below to change your Bloop <a id = "loginOutConfirmation" href = "index.php">here</a></p>
                    <fieldset class="register">
                        <legend>Bloop Information</legend>

                        <label for="txtName" class="required">Name
                            <input type="text" id="txtName" name="txtName"
                                   value="<?php print $Name; ?>"
                                   tabindex="120" maxlength="45" placeholder="Enter a name for your Bloop here"
                                   onfocus="this.select()"
                                   >
                        </label>
                        <label  for="txtColor" class="required"> Building
                        <select id="txtColor" name="txtColor" tabindex="100">
                            <option selected value></option>
                            <option value="31 SPR">31 SPR</option>
                            <option value="481 MN">481 MN</option>
                            <option value="617 MN">617 MN</option>
                            <option value="70S WL">70S WL</option>
                            <option value="AIKEN">AIKEN</option>
                            <option value="ALLEN">ALLEN</option>
                            <option value="ANGELL">ANGELL</option>
                            <option value="BLLNGS">BLLNGS</option>
                            <option value="COOK">COOK</option>
                            <option value="CPW">CPW</option>
                            <option value="DELEHA">DELEHA</option>
                            <option value="DEWEY">DEWEY</option>
                            <option value="FAHC">FAHC</option>
                            <option value="FLEMIN">FLEMIN</option>
                            <option value="GIVN">GIVN</option>
                            <option value="GIVN C">GIVN</option>
                            <option value="GUTRSN">GUTRSN</option>
                            <option value="HARRIS">HARRIS</option>
                            <option value="HILLS">HILLS</option>
                            <option value="HSRF">HSRF</option>
                            <option value="JEFFRD">JEFFRD</option>
                            <option value="JERCHO">JERCHO</option>
                            <option value="KALKIN">KALKIN</option>
                            <option value="L/L CM">L/L CM</option>
                            <option value="L/L-A">L/L-A</option>
                            <option value="L/L-B">L/L-B</option>
                            <option value="L/L-D">L/L-D</option>
                            <option value="LAFAYE">LAFAYE</option>
                            <option value="MANN">MANN</option>
                            <option value="MARSH">MARSH</option>
                            <option value="ML SCI">ML SCI</option>
                            <option value="MORRIL">MORRIL</option>
                            <option value="MRC">MRC</option>
                            <option value="MRC-CO">MRC-CO</option>
                            <option value="MUSIC">MUSIC</option>
                            <option value="OFFCMP">OFFCMP</option>
                            <option value="OLDMIL">OLDMIL</option>
                            <option value="OMANEX">OMANEX</option>
                            <option value="ONCMP">ONCMP</option>
                            <option value="ONLINE">ONLINE</option>
                            <option value="PATGYM">PATGYM</option>
                            <option value="PERKIN">PERKIN</option>
                            <option value="POMERO">POMERO</option>
                            <option value="ROWELL">ROWELL</option>
                            <option value="RT THR">RT THR</option>
                            <option value="SOUTHW">SOUTHW</option>
                            <option value="STAFFO">STAFFO</option>
                            <option value="TERRIL">TERRIL</option>
                            <option value="TORREY">TORREY</option>
                            <option value="UHTN">UHTN</option>
                            <option value="UHTN23">UHTN23</option>
                            <option value="UHTS">UHTS</option>
                            <option value="UHTS23">UHTS23</option>
                            <option value="VOTEY">VOTEY</option>
                            <option value="WATERM">WATERM</option>
                            <option value="WHEELR">WHEELR</option>
                            <option value="WILLMS">WILLMS</option>

                        </select>
                    </label>
                    </fieldset> <!-- ends contact -->
                <fieldset class="buttons">
                    <legend></legend>
                    <input type="submit" id="btnSubmit" name="btnSubmit" value="Register" tabindex="900" class="button">
                </fieldset> <!-- ends buttons -->
            </fieldset> <!-- Ends Wrapper -->
        </form>
    </article>



<?php
include "footer.php";
?>
</body>
</html>