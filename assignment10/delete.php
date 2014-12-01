<?php
session_start();
include'top.php';
include "loggedIn.php";
include('db.php');

if (!isset($_SESSION['user'])){
    print "<article id='main'><p>You don't appear to be logged in.</p> <p> Please sign in <a id = 'loginOut' href = 'login.php'> here </a> or create an account <a id = 'loginOut' href = 'register.php'> here </a></p></article>";
}
else{

    if (isset($_POST["btnSubmit"])) {


        $query = 'SELECT pmkRegisterId FROM tblRegister WHERE fldEmailAddress = ?';
        $data = array($_SESSION['user']);
        $results = $thisDatabase -> select($query,$data);

        $myId = $results[0][0];

        $query = 'SELECT fldSize FROM tblBloop WHERE pmkRegisterId = ?;';
        $data = array($myId);
        $results = $thisDatabase -> select($query,$data);

        $size = $results[0][0];

        $query = 'SELECT COUNT(*) FROM tblBloop;';
        $results = $thisDatabase -> select($query);

        $average = $size / $results[0][0];

        $query = 'UPDATE tblBloop SET fldSize = fldSize + ?, fldCenter = fldSize / 2, fldRadius = fldCenter - 10;';
        $data = array($average);
        $results = $thisDatabase -> update($query,$data);

        $query = "DELETE FROM tblFriendship WHERE fldBliperId = ? OR fldBlipeeId = ?;";
        $data = array($myId,$myId);
        $results = $thisDatabase -> delete($query,$data);

        $query = "DELETE FROM tblBloop WHERE pmkRegisterId IN(SELECT DISTINCT pmkRegisterId FROM tblRegister WHERE fldEmailAddress = ?);";
        $data = array($_SESSION['user']);
        $results = $thisDatabase -> delete($query,$data);

        $query = "DELETE FROM tblRegister WHERE fldEmailAddress = ?;";
        $data = array($_SESSION['user']);
        $results = $thisDatabase -> delete($query,$data);

        header("Location: logout.php");
        
    } // ends if form was submitted.

    print "<article id = 'accountInfo'>";
    print "<aside>";

    print "<h1 id = 'h1Account'> My Account</h1>";

    $query ="SELECT fldDateJoined FROM tblRegister WHERE fldEmailAddress = ?;";
    $data = array($_SESSION['user']);
    $results = $thisDatabase->select($query, $data);
    print "<p id = 'bloopP3'> Are you sure you want to delete this account? </p>";

    $query ="SELECT fldSize, fldCenter, fldRadius, fldColor, fldName, fldBlipNumber FROM tblBloop WHERE pmkRegisterId IN(SELECT DISTINCT pmkRegisterId FROM tblRegister WHERE fldEmailAddress = ?)";
    $data = array($_SESSION['user']);
    $results = $thisDatabase->select($query, $data);

    print "<svg height =";
    print $results[0][0];
    print " width = ";
    print $results[0][0];
    print "> <circle cx = ";
    print $results[0][1];
    print " cy = ";
    print $results[0][1];
    print " r = ";
    print $results[0][2];
    print " stroke='white' stroke-width='3' fill = ";
    print $results[0][3];
    print "  /> </svg>";
    print "<p id = 'bloopP3'> I'll miss you! :( </p>";
?>

    <form action="<?php print $phpSelf; ?>"
              method="post"
              id="frmRegister">
                <fieldset class="buttons">
                    <legend></legend>
                    <input type="submit" id="btnSubmit" name="btnSubmit" value="DELETE" tabindex="900" class="button">
                </fieldset> <!-- ends buttons -->
            </fieldset> <!-- Ends Wrapper -->
        </form>
    </aside>
</article>

<?php    
}
    include "footer.php";
?>
</body>
</html>