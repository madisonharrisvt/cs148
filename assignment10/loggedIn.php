<?php
print "<article id = 'loggedInPanel'>";


if (!isset($_SESSION['user'])){
    print "<p id = 'loginPanel'> Please <a id = 'loginOutConfirmation' href = 'login.php'> sign in </a></p>";
}
else{
    echo "<p id = 'loginPanel'>Logged in as: " . $_SESSION['user'] . ' <a id = "loginOutConfirmation" href = "logout.php">Log Out</a></p>';
}

print "</article>";
?>