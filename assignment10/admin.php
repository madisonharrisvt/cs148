<?php
session_start();
include'top.php';
include "loggedIn.php";
include('db.php');

print "<article id = 'main'>";

if (!isset($_SESSION['user'])){
    print "<p>You don't appear to be logged in.  Please sign in <a id = 'loginOut' href = 'login.php'> here </a> or create an account <a id = 'loginOut' href = 'index.php'> here </a></p>";
    print "</article>";
}
else{

    print "<h1>Account:" . $_SESSION['user']. "</h1>";

    $query ="SELECT fldDateJoined FROM tblRegister WHERE fldEmailAddress = ?;";
    $data = array($_SESSION['user']);
    $results = $thisDatabase->select($query, $data);
    print "<p>Date Joined: ". $results[0][0] ."</p>";
    print "<h1>Your Bloop: </h1>";

    $query ="SELECT fldSize, fldCenter, fldRadius, fldColor, fldName FROM tblBloop WHERE pmkRegisterId IN(SELECT DISTINCT pmkRegisterId FROM tblRegister WHERE fldEmailAddress = ?)";
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
    print "<p>Bloop's Name: " . $results[0][4] . "</p>";
?>
</article>

<?php    
}
    include "footer.php";
?>
</body>
</html>