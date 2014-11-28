<?php
print "<article id = 'loggedInPanel'>";


if (!isset($_SESSION['user'])){
    print "<p> Please <a id = 'loginOut' href = 'login.php'> sign in </a></p>";
}
else{
    echo "<p>THIS IS: " . $_SESSION['user'] . ' <a id = "loginOut" href = "logout.php">Log Out</a></p>';
}

print "</article>";
?>