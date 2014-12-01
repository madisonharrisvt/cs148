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
    if($_SESSION['user'] == 'mharri11@uvm.edu'){
        print " stroke='black' stroke-width='3' fill = ";
    }else{
    print " stroke='white' stroke-width='3' fill = ";
    }
    print $results[0][3];
    print "  /> </svg>";
    print "<aside id = 'bloopInfo'>";
    print "<p id = 'bloopP2'>Bloop's Name: " . $results[0][4] . "</p>";
    print "<p id = 'bloopP2'>Bloop's Size: " . $results[0][0] . "lbs</p>";
    print "<p id = 'bloopP2'>Number of Blips: " . $results[0][5] . "</p>";
    print "</aside>";

    print "<h1 id = 'h1Bloop'>All Other Bloops</h1>";
    print "<h1 id = 'demoHover'>Click on a bloop!</h1>";

    $query ="SELECT fldSize, fldCenter, fldRadius, fldColor, fldName, fldBlipNumber, pmkRegisterId FROM tblBloop WHERE pmkRegisterId IN(SELECT DISTINCT pmkRegisterId FROM tblRegister WHERE fldEmailAddress != ?)";
    $data = array($_SESSION['user']);
    $results = $thisDatabase->select($query, $data);

    /* since it is associative array display the field names */
    //print "<article class = 'stage'>";
    foreach ($results as $row) {
        //print "<aside id = 'bloopBox'>";
        print "<div><a id = '" . $row[4] . "' onmouseover='mouseOver(this.id);' onmouseout='mouseOut()' href = 'blip.php?id=";
        print $row[6];
        print "'><svg height =";
        print $row[0];
        print " width = ";
        print $row[0];
        print "> <circle cx = ";
        print $row[1];
        print " cy = ";
        print $row[1];
        print " r = ";
        print $row[2];
        print " stroke='white' stroke-width='3' fill = ";
        print $row[3];
        print "  /> </svg></a></div>";
        //print "<aside id = 'bloopP'>";
        //print "<p id = 'bloopP2'>Bloop's Name: " . $row[4] . "</p>";
        //print "<p id = 'bloopP2'>Bloop's Size: " . $row[0] . "lbs</p>";
        //print "<p id = 'bloopP2'>Number of Blips: " . $row[5] . "</p>";
        //print "</aside>";
        //print "</aside>";
    }
    //print "</article>";
    print "</aside>";
    print "</aside>";
    print "</article>";
?>
<script>
        var elems = document.getElementsByTagName('div');
        var increase = Math.PI * 2 / elems.length;
        var x = 0, y = 0, angle = 0, elem;

        for (var i = 0; i < elems.length; i++) {
            elem = elems[i];
            x = 100 * Math.cos(angle) + 200;
            y = 100 * Math.sin(angle) + 150;
            elem.style.position = 'static';
            elem.style.left = x + 'px';
            elem.style.top = y + 'px';
            angle += increase;
        }
    </script>

    <script>
        function mouseOver($id) {
            document.getElementById("demoHover").innerHTML = $id;
        }

        function mouseOut() {
            document.getElementById("demoHover").innerHTML = "Click on a bloop!";
        }
        </script>

<?php    
}
    include "footer.php";
?>
</body>
</html>