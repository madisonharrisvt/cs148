<?php
/* the purpose of this page is to accept the hashed date joined and primary key  
 * as passed into this page in the GET format.
 * 
 * I retrieve the date joined from the table for this person and verify that 
 * they are the same. After which i update the confirmed field and acknowlege 
 * to the user they were successful. Then i send an email to the system admin 
 * to approve their membership 
 * 
 * Written By: Robert Erickson robert.erickson@uvm.edu
 * Last updated on: October 17, 2014
 * 
 * 
 */
session_start();
include "top.php";
include "loggedIn.php";

print '<article id="main">';

print '<h1 id = "requestProcessed">Registration Confirmation</h1>';

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1 Initialize variables
//
// SECTION: 1a.
// variables for the classroom purposes to help find errors.
$debug = false;
if (isset($_GET["debug"])) { // ONLY do this in a classroom environment
    $debug = true;
}
if ($debug)
    print "<p>DEBUG MODE IS ON</p>";
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%

$adminEmail = "mharri11@uvm.edu";
$message = "<p>I am sorry but this project cannot be confrimed at this time. Please call (802) 656-1234 for help in resolving this matter.</p>";


//##############################################################
//
// SECTION: 2 
// 
// process request

if (isset($_GET["q"])) {
    $key1 = htmlentities($_GET["q"], ENT_QUOTES, "UTF-8");
    $key2 = htmlentities($_GET["w"], ENT_QUOTES, "UTF-8");

    $data = array($key2);

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: MAKE TABLE
    //
    // MAKING THE TABLE FOR THE QUERY

    require_once('../bin/myDatabase.php');

    $dbUserName = 'mharri11' . '_admin';
    $whichPass = "a"; //flag for which one to use.
    $dbName = strtoupper('mharri11') . '_BlipBloop';

    $thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName);
    
    //##############################################################
    // get the membership record 

    $query = "SELECT fldDateJoined, fldEmailAddress FROM tblRegister WHERE pmkRegisterId = ? ";
    $results = $thisDatabase->select($query, $data);

    $dateSubmitted = $results[0]["fldDateJoined"];
    $email = $results[0]["fldEmailAddress"];

    $k1 = sha1($dateSubmitted);

    if ($debug) {
        print "<p>Date: " . $dateSubmitted;
        print "<p>email: " . $email;
        print "<p><pre>";
        print_r($results);
        print "</pre></p>";
        print "<p>k1: " . $k1;
        print "<p>q : " . $key1;
    }
    //##############################################################
    // update confirmed
    if ($key1 == $k1) {
        if ($debug)
            print "<h1>Confirmed</h1>";

        $query = "UPDATE tblRegister set fldConfirmed=1 WHERE pmkRegisterId = ? ";
        $results = $thisDatabase->update($query, $data);

        if ($debug) {
            print "<p>Query: " . $query;
            print "<p><pre>";
            print_r($results);
            print_r($data);
            print "</pre></p>";
        }
        // notify admin
        $message = '<h2>The following Registration has been confirmed:</h2>';

        $message = "<p>A user has been added to your system </p>";

        if ($debug)
            print "<p>" . $message;

        $to = $adminEmail;
        $cc = "";
        $bcc = "";
        $from = "BlipBloop <noreply@mharri11.w3.uvm.edu>";
        $subject = "New BlipBloop Membership Confirmed";

        $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);

        if ($debug) {
            print "<p>";
            if (!$mailed) {
                print "NOT ";
            }
            print "mailed to admin ". $to . ".</p>";
        }

        // notify user
        $to = $email;
        $cc = "";
        $bcc = "";
        $from = "BlipBloop <noreply@mharri11.w3.uvm.edu>";
        $subject = "BlipBloop Registration Confirmed";
        $message = "<p id = 'confirmationText'>Thank you for taking the time to confirm your registration.  Your account is now active.  Please log in <a id = 'loginOutConfirmation' href = 'login.php'>here</a> to begin using your account.</p>";

        $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);

        print $message;
        if ($debug) {
            print "<p>";
            if (!$mailed) {
                print "NOT ";
            }
            print "mailed to member: " . $to . ".</p>";
        }
    }else{
        print $message;
    }
} // ends isset get q
?>


</article>
<?php
include "footer.php";
if ($debug)
    print "<p>END OF PROCESSING</p>";
?>
</body>
</html>