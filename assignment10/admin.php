<?php
session_start();
include('top.php');
if (!isset($_SESSION['user'])){
    print "<p>You don't appear to be logged in.  Please sign in <a id = 'loginOut' href = 'login.php'> here </a> or create an account <a id = 'loginOut' href = 'index.php'> here </a></p>";
}
else{
    echo "<p>THIS IS: " . $_SESSION['user'] . '</p>';
}
    include "footer.php";
?>
</body>
</html>