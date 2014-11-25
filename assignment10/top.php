<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Don't mark me wrong</title>
        <meta charset="utf-8">
        <meta name="author" content="Don't mark me wrong">
        <meta name="description" content="Don't mark me wrong for changing this">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
        <![endif]-->

        <?php
        $debug = false;

// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// PATH SETUP
//
//  $domain = "https://www.uvm.edu" or http://www.uvm.edu;

        $domain = "http://";
        if (isset($_SERVER['HTTPS'])) {
            if ($_SERVER['HTTPS']) {
                $domain = "https://";
            }
        }

        $server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, "UTF-8");

        $domain .= $server;

        $phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");

        $path_parts = pathinfo($phpSelf);

        if ($debug) {
            print "<p>Domain" . $domain;
            print "<p>php Self" . $phpSelf;
            print "<p>Path Parts<pre>";
            print_r($path_parts);
            print "</pre>";
        }

// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// inlcude all libraries
//

        require_once('lib/security.php');

        if ($path_parts['filename'] == "index") {
            include "lib/validation-functions.php";
            include "lib/mail-message.php";
        }
        else if ($path_parts['filename'] == "confirmation") {
            include "lib/validation-functions.php";
            include "lib/mail-message.php";
        }
        else if ($path_parts['filename'] == "approve") {
            include "lib/validation-functions.php";
            include "lib/mail-message.php";
        }
        ?>	


        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato:100,400,900,100italic,400italic">
        <link href='https://fonts.googleapis.com/css?family=Josefin+Sans:300,400' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="style.css" type="text/css" media="screen">
    </head>
    <!-- ################ body section ######################### -->

    <?php
    print '<body id="' . $path_parts['filename'] . '">';

    include "header.php";
    include "nav.php";
    ?>

<div id="holder">
    <div class="dot"></div>
    <div class="pulse"></div>
</div>