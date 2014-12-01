<?php
session_start();
include'top.php';
include "loggedIn.php";
include('db.php');

if (!isset($_SESSION['user'])){
    print "<article id='main'><p>You don't appear to be logged in.</p> <p> Please sign in <a id = 'loginOut' href = 'login.php'> here </a> or create an account <a id = 'loginOut' href = 'register.php'> here </a></p></article>";
}
else{

    $query = 'SELECT pmkRegisterId FROM tblRegister WHERE fldEmailAddress = ?';
    $data = array($_SESSION['user']);
    $results = $thisDatabase -> select($query,$data);

    $myId = $results[0][0];

    $query = "SELECT pmkRegisterId FROM tblRegister WHERE fldEmailAddress = 'mharri11@uvm.edu';";
    $results = $thisDatabase -> select($query);

    $adminId = $results[0][0];

    print "<article id = 'accountInfo'>";
    print "<aside>";

    print "<h1 id = 'h1Account'> My Account <a id = 'loginOut' href = 'delete.php'>Delete Account</a></h1>";

    $query ="SELECT fldDateJoined FROM tblRegister WHERE fldEmailAddress = ?;";
    $data = array($_SESSION['user']);
    $results = $thisDatabase->select($query, $data);
    print "<p id = 'pAccount'>Email Address: " . $_SESSION['user'].  "</p>";
    print "<p id = 'pAccount'>Date Joined: ". $results[0][0] ."</p>";

    $query = 'SELECT pmkRegisterId FROM tblRegister WHERE fldEmailAddress = ?';
    $data = array($_SESSION['user']);
    $results = $thisDatabase -> select($query,$data);

    $myId = $results[0][0];

    $query = 'SELECT fldBlipeeId,fldBlipNumber FROM tblFriendship WHERE fldBliperId = ?';
    $data = array($myId);
    $results = $thisDatabase -> select($query,$data);

    $minValue = 0;
    $minId = 0;
    foreach ($results as $row) {
        if($row[1] > $minValue){
            $minValue = $row[1];
            $minId = $row[0];
        }
    }

    $query = 'SELECT fldName FROM tblBloop WHERE pmkRegisterId = ?';
    $data = array($minId);
    $results = $thisDatabase -> select($query,$data);

    $myBlipeeName = $results[0][0];

    if($minValue == 0 OR $minId = 0){
        print '<p id = "pAccount">You have not blipped anyone yet!</p>';
    }else{
    print "<p id = 'pAccount'>You have blipped ". $myBlipeeName ." the most (". $minValue ." blips)</p>";
    }




    print "<h1 id = 'h1Bloop'>My Bloop <a id = 'loginOut' href = 'editBloop.php'>Edit</a></h1>";


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
    if($myId == $adminId){
        print " stroke='black' stroke-width='3' fill = ";
    }else{
        print " stroke='white' stroke-width='3' fill = ";
    }
    print $results[0][3];
    print "  /> </svg>";
    print "<aside id = 'bloopInfo'>";
    print "<p id = 'pBloop'>Bloop's Name: " . $results[0][4] . "</p>";
    print "<p id = 'pBloop'>Bloop's Size: " . $results[0][0] . "lbs</p>";
    print "<p id = 'pBloop'>Number of Blips: " . $results[0][5] . "</p>";
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