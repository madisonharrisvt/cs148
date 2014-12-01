<?php
session_start();
include'top.php';
include "loggedIn.php";
include('db.php');

$id = $_GET['id'];


$query ="SELECT fldSize, fldCenter, fldRadius, fldColor, fldName, fldBlipNumber FROM tblBloop WHERE pmkRegisterId IN(SELECT DISTINCT pmkRegisterId FROM tblRegister WHERE fldEmailAddress = ?)";
$data = array($_SESSION['user']);
$results = $thisDatabase->select($query, $data);

$mySize = $results[0][0];
$myCenter = $results[0][1];
$myRadius = $results[0][2];
$myBlipNumber = $results[0][5];

$query ="SELECT fldSize, fldCenter, fldRadius, fldColor, fldName, fldBlipNumber FROM tblBloop WHERE pmkRegisterId = ?";
$data = array($id);
$results = $thisDatabase->select($query, $data);

$size = $results[0][0];
$center = $results[0][1];
$radius = $results[0][2];

$sizeERROR = false;
$mySizeERROR = false;

if (!isset($_SESSION['user'])){
    print "<article id='main'><p>You don't appear to be logged in.</p> <p> Please sign in <a id = 'loginOut' href = 'login.php'> here </a> or create an account <a id = 'loginOut' href = 'register.php'> here </a></p></article>";
} else{

    if (isset($_POST["btnSubmit"])) {

        $id = $_POST['hiddenID'];
        //$size = $_POST['hiddenSize'];
        //$center = $_POST['hiddenCenter'];
        //$radius = $_POST['hiddenRadius'];
        //$mySize = $_POST['hiddenMySize'];
        //$myCenter = $_POST['hiddenMyCenter'];
        //$myRadius = $_POST['hiddenMyRadius'];

        $query ="SELECT fldSize, fldCenter, fldRadius, fldColor, fldName, fldBlipNumber FROM tblBloop WHERE pmkRegisterId IN(SELECT DISTINCT pmkRegisterId FROM tblRegister WHERE fldEmailAddress = ?)";
        $data = array($_SESSION['user']);
        $results = $thisDatabase->select($query, $data);

        $mySize = $results[0][0];
        $myCenter = $results[0][1];
        $myRadius = $results[0][2];
        $myBlipNumber = $results[0][5];

        $query ="SELECT fldSize, fldCenter, fldRadius, fldColor, fldName, fldBlipNumber FROM tblBloop WHERE pmkRegisterId = ?";
        $data = array($id);
        $results = $thisDatabase->select($query, $data);

        $size = $results[0][0];
        $center = $results[0][1];
        $radius = $results[0][2];

        if ($radius <= 5) {

            $errorMsg[] = "This Bloop is too small to blip!";
            $sizeERROR = true;
        }

        if($myRadius > 200){
            $errorMsg[] = "Your Bloop is too large to blip!";
            $mySizeERROR = true;
        }

        if (!$errorMsg) {

            $size = $size - 5;
            $center = $size / 2;
            $radius = $center - 10;

            $mySize = $mySize + 5;
            $myCenter = $mySize / 2;
            $myRadius = $myCenter - 10;
            $myBlipNumber = $myBlipNumber + 1;

            $query = "UPDATE tblBloop SET fldSize = fldSize + 5, fldCenter = fldSize / 2, fldRadius = fldCenter - 10, fldBlipNumber = fldBlipNumber + 1 WHERE pmkRegisterId IN(SELECT DISTINCT pmkRegisterId FROM tblRegister WHERE fldEmailAddress = ?);";
            $data = array($_SESSION['user']);
            $results = $thisDatabase -> update($query,$data);

            $query = "UPDATE tblBloop SET fldSize = fldSize - 5, fldCenter = fldSize / 2, fldRadius = fldCenter - 10 WHERE pmkRegisterId = ?;";
            $data = array($id);
            $results = $thisDatabase -> update($query,$data);


            $query = 'SELECT pmkRegisterId FROM tblRegister WHERE fldEmailAddress = ?';
            $data = array($_SESSION['user']);
            $results = $thisDatabase -> select($query,$data);

            $myId = $results[0][0];

            $query = 'SELECT fldBlipNumber FROM tblFriendship WHERE fldBlipeeId = ? AND fldBliperId = ?;';
            $data = array($id,$myId);
            $results = $thisDatabase -> select($query,$data);

            $count = count($results);



            if($count > 0){
               $blipNumber = $results[0][0] + 1;
                
                $query = 'UPDATE tblFriendship SET fldBlipNumber = fldBlipNumber + 1 WHERE fldBlipeeId = ? AND fldBliperId = ?;';
                $data = array($id,$myId);
                $results = $thisDatabase -> update($query,$data);
            } else{

                $query = 'INSERT INTO tblFriendship VALUES (Null,?,?,1);';
                $data = array($myId,$id);
                $results = $thisDatabase -> insert($query,$data);

            }

            $complete = true;
            $successMsg[] = "Successfully updated Bloop";

             //data entered  
        } // end form is valid
    } // ends if form was submitted.

    print "<article id = 'accountInfo'>";
    print "<aside id = 'worldHolder'>";
    print "<aside id = 'world'>";

    ?>

    <form action="<?php print $phpSelf; ?>"
              method="post"
              id="frmRegister">
                <fieldset class="buttons">
                    <legend></legend>
                    <input type="submit" id="btnSubmit" name="btnSubmit" value="Blip!" tabindex="900" class="button">
                    <input type="hidden" name="hiddenID" value= <?php print $id; ?> >
                </fieldset> <!-- ends buttons -->
            </fieldset> <!-- Ends Wrapper -->
        </form>

    <?php

    if ($errorMsg) {
        print '<div id="errors">';
        print "<ol>\n";
        foreach ($errorMsg as $err) {
            print "<li>" . $err . "</li>\n";
        }
        print "</ol>\n";
        print '</div>';
    }elseif ($successMsg) {
        print '<div id="success">';
        print "<ol>\n";
        foreach ($successMsg as $err) {
            print "<li>" . $err . "</li>\n";
        }
        print "</ol>\n";
        print '</div>';
    }

    print "<article id = 'left'>";
    print "<article id = 'leftRight'>"; 

    print "<h1 id = 'h1BloopWorld'>My Bloop</h1>";

    $query ="SELECT fldSize, fldCenter, fldRadius, fldColor, fldName, fldBlipNumber FROM tblBloop WHERE pmkRegisterId IN(SELECT DISTINCT pmkRegisterId FROM tblRegister WHERE fldEmailAddress = ?)";
    $data = array($_SESSION['user']);
    $results = $thisDatabase->select($query, $data);

    print "<svg height =";
    print $results[0][0];
    $mySize = $results[0][0];
    print " width = ";
    print $results[0][0];
    print "> <circle cx = ";
    print $results[0][1];
    $myCenter = $results[0][1];
    print " cy = ";
    print $results[0][1];
    print " r = ";
    print $results[0][2];
    $myRadius = $results[0][2];
    print " stroke='white' stroke-width='3' fill = ";
    print $results[0][3];
    print "  /> </svg>";
    print "<aside id = 'bloopInfo'>";
    print "<p id = 'bloopP2'>Bloop's Name: " . $results[0][4] . "</p>";
    print "<p id = 'bloopP2'>Bloop's Size: " . $results[0][0] . "lbs</p>";
    print "<p id = 'bloopP2'>Number of Blips: " . $results[0][5] . "</p>";
    print "</aside>";

    print "</article>";
    print "</article>";

    print "<article id = 'right'>";
    print "<article id = 'rightLeft'>";

    print "<h1 id = 'h1BloopWorld'>Their Bloop</h1>";

    $query ="SELECT fldSize, fldCenter, fldRadius, fldColor, fldName, fldBlipNumber FROM tblBloop WHERE pmkRegisterId = ?";
    $data = array($id);
    $results = $thisDatabase->select($query, $data);

    print "<svg height =";
    print $results[0][0];
    $size = $results[0][0];
    print " width = ";
    print $results[0][0];
    print "> <circle cx = ";
    print $results[0][1];
    $center = $results[0][1];
    print " cy = ";
    print $results[0][1];
    print " r = ";
    print $results[0][2];
    $radius = $results[0][2];
    print " stroke='white' stroke-width='3' fill = ";
    print $results[0][3];
    print "  /> </svg>";
    print "<aside id = 'bloopInfo'>";
    print "<p id = 'bloopP2'>Bloop's Name: " . $results[0][4] . "</p>";
    print "<p id = 'bloopP2'>Bloop's Size: " . $results[0][0] . "lbs</p>";
    print "<p id = 'bloopP2'>Number of Blips: " . $results[0][5] . "</p>";
    print "</article>";
    print "</aritcle>";
    print "</aside>";

    
    print "</aside>";
    print "</aside>";
    print "</article>";
?>

<?php    
}
    include "footer.php";
?>
</body>
</html>