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

<svg height="100" width="100">
  <circle cx="50" cy="50" r="40" stroke="red" stroke-width="3" fill="red" />
</svg>
</article>

<?php    
}
    include "footer.php";
?>
</body>
</html>