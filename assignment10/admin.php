<?php
session_start();
include'top.php';
include "loggedIn.php";
include('db.php');

if (!isset($_SESSION['user'])){
    print "<p>You don't appear to be logged in.  Please sign in <a id = 'loginOut' href = 'login.php'> here </a> or create an account <a id = 'loginOut' href = 'index.php'> here </a></p>";
}
else{

    print "<article id = 'accountInfo'>";

    print "<h1 id = 'h1Account'>" . $_SESSION['user']. "</h1>";

    $query ="SELECT fldDateJoined FROM tblRegister WHERE fldEmailAddress = ?;";
    $data = array($_SESSION['user']);
    $results = $thisDatabase->select($query, $data);
    print "<p id = 'pAccount'>Date Joined: ". $results[0][0] ."</p>";
    print "<p> See information about your Bloop on the right side of this page. </p>";
    print "</article>";
    print "<aside>";
    print "<h1>Your Bloop: </h1>";

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
    print " fill = ";
    print $results[0][3];
    print "  /> </svg>";
    print "<p id = 'pBloop'>Bloop's Name: " . $results[0][4] . "</p>";
    print "<p id = 'pBloop'>Bloop's Size: " . $results[0][0] . "lbs</p>";
    print "<p id = 'pBloop'>Number of Blips: " . $results[0][5] . "</p>";
    print "</aside>";
?>

<?php    
}
    include "footer.php";
?>
</body>
</html>