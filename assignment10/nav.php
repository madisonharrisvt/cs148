<!-- ######################     Main Navigation   ########################## -->
<nav>
    <ol>
        <?php
        /* This sets the current page to not be a link. Repeat this if block for
         *  each menu item */
        /*if ($path_parts['filename'] == "home") {
            print '<li class="activePage">Home</li>';
        } else {
            print '<li><a href="home.php">Home</a></li>';
        }

        /* example of repeating */
        /*if ($path_parts['filename'] == "form") {
            print '<li class="activePage">Join</li>';
        } else {*/
            print '<li><a href="index.php">REGISTER</a></li><li><a href="index.php">WORLD</a></li><li><a id = loginOut href = "login.php">LOGIN</a></li><li><a id = loginOut href = "logout.php">LOGOUT</a></li>';
       // }
        ?>
    </ol>
</nav>