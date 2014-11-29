<?php
session_start();
include'top.php';
include "loggedIn.php";

print "<article id = 'main'>";

if (!isset($_SESSION['user'])){
    print "<p>You don't appear to be logged in.  Please sign in <a id = 'loginOut' href = 'login.php'> here </a> or create an account <a id = 'loginOut' href = 'index.php'> here </a></p>";
    print "</article>";
}
else{

    print "<h1>Account:" . $_SESSION['user']. "</h1>";
?>

<svg height="50" width="50">
  <circle cx="25" cy="25" r="15" fill="white" />
</svg>
</article>

<?php    
}
    include "footer.php";
?>
</body>
</html>