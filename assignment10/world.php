<?php
session_start();
include'top.php';
include "loggedIn.php";
include('db.php');

if (!isset($_SESSION['user'])){
    print "<article id='main'><p>You don't appear to be logged in.</p> <p> Please sign in <a id = 'loginOut' href = 'login.php'> here </a> or create an account <a id = 'loginOut' href = 'register.php'> here </a></p></article>";
}
else{

    print "<article id = 'accountInfo'>";
    print "<aside id = 'worldHolder'>";
    print "<aside id = 'world'>";
    print "<h1 id = 'h1Bloop'>My Bloop</h1>";

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
    print "<aside id = 'bloopInfo'>";
    print "<p>Bloop's Name: " . $results[0][4] . "</p>";
    print "<p>Bloop's Size: " . $results[0][0] . "lbs</p>";
    print "<p>Number of Blips: " . $results[0][5] . "</p>";
    print "</aside>";

    print "<h1 id = 'h1Bloop'>All Bloops</h1>";

    $query ="SELECT fldSize, fldCenter, fldRadius, fldColor, fldName, fldBlipNumber FROM tblBloop WHERE pmkRegisterId IN(SELECT DISTINCT pmkRegisterId FROM tblRegister WHERE fldEmailAddress != ?)";
    $data = array($_SESSION['user']);
    $results = $thisDatabase->select($query, $data);

    /* since it is associative array display the field names */
    foreach ($results as $row) {
        print "<aside id = 'bloopBox'>";
        print "<svg height =";
        print $row[0];
        print " width = ";
        print $row[0];
        print "> <circle cx = ";
        print $row[1];
        print " cy = ";
        print $row[1];
        print " r = ";
        print $row[2];
        print " fill = ";
        print $row[3];
        print "  /> </svg>";
        print "<aside id = 'bloopP'>";
        print "<p>Bloop's Name: " . $row[4] . "</p>";
        print "<p>Bloop's Size: " . $row[0] . "lbs</p>";
        print "<p>Number of Blips: " . $row[5] . "</p>";
        print "</aside>";
        print "</aside>";
    }
    
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