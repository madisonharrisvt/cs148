<?php
session_start();
include('db.php');


$query ="SELECT fldSize, fldCenter, fldRadius, fldColor, fldName, fldBlipNumber FROM tblBloop WHERE pmkRegisterId IN(SELECT DISTINCT pmkRegisterId FROM tblRegister WHERE fldEmailAddress = ?)";
$data = array($_SESSION['user']);
$results = $thisDatabase->select($query, $data);

$size = $results[0][0];
$center = $results[0][1];
$radius = $results[0][2];
$color = $results[0][3];
$name = $results[0][4];

$nameERROR = false;
$complete = false;
$errorMsg = array();

$successMsg = array();

if (isset($_POST["btnSubmit"])) {

    $name = htmlentities($_POST["txtName"], ENT_QUOTES, "UTF-8");
    $color = $_POST["txtColor"];

    if ($name == "") {
        $errorMsg[] = "Please enter a name for your Bloop";
        $nameERROR = true;
    }

    elseif(strlen($name) > 20){
      $errorMsg[] = "Your name is too long (> 20 characters)";
      $nameERROR = true;
    }

    if (!$errorMsg) {

        $query = "UPDATE tblBloop SET fldName = ?, fldColor = ? WHERE pmkRegisterId IN(SELECT DISTINCT pmkRegisterId FROM tblRegister WHERE fldEmailAddress = ?);";
        
        $data = array($name,$color,$_SESSION['user']);

        $results = $thisDatabase -> update($query,$data);

        $complete = true;
        $successMsg[] = "Successfully updated Bloop";


         //data entered  
    } // end form is valid
} // ends if form was submitted.

include('top.php');
include "loggedIn.php";

print '<article id="main">';
if ($errorMsg) {
    print '<div id="errors">';
    print "<ol>\n";
    foreach ($errorMsg as $err) {
        print "<li>" . $err . "</li>\n";
    }
    print "</ol>\n";
    print '</div>';
}elseif ($successMsg) {
    print '<div id="success">';
    print "<ol>\n";
    foreach ($successMsg as $err) {
        print "<li>" . $err . "</li>\n";
    }
    print "</ol>\n";
    print '</div>';
} 

?>
        <form action="<?php print $phpSelf; ?>"
              method="post"
              id="frmRegister">
            <fieldset class="wrapper">
                <legend>Edit Bloop</legend>
                <p class="registerParagraph">Modify the fields below to change your Bloop</p>
                    <fieldset class="register">
                        <legend>Bloop Information</legend>

                        <label for="txtName" class="required">Name
                            <input type="text" id="txtName" name="txtName"
                                   value="<?php print $name; ?>"
                                   tabindex="120" maxlength="45" placeholder="Enter your Bloop's name here"
                                   <?php if ($nameERROR) print 'class="mistake"'; ?>
                                   onfocus="this.select()"
                                   >
                        </label>
                        <label  for="txtColor" class="required"> Color
                        <select id="txtColor" onchange="myFunction()" name="txtColor" tabindex="100">
                            <option selected="selected" value=<?php print $color?>>Bloop Color</option>
                            <option style="background-color:#F0F8FF" value="#F0F8FF">AliceBlue</option>
                          <option style="background-color:#FAEBD7" value="#FAEBD7">AntiqueWhite</option>
                          <option style="background-color:#00FFFF" value="#00FFFF">Aqua</option>
                          <option style="background-color:#7FFFD4" value="#7FFFD4">Aquamarine</option>
                          <option style="background-color:#F0FFFF" value="#F0FFFF">Azure</option>
                          <option style="background-color:#F5F5DC" value="#F5F5DC">Beige</option>
                          <option style="background-color:#FFE4C4" value="#FFE4C4">Bisque</option>
                          <option style="background-color:#000000" value="#000000">Black</option>
                          <option style="background-color:#FFEBCD" value="#FFEBCD">BlanchedAlmond</option>
                          <option style="background-color:#0000FF" value="#0000FF">Blue</option>
                          <option style="background-color:#8A2BE2" value="#8A2BE2">Blue Violet</option>
                          <option style="background-color:#A52A2A" value="#A52A2A">Brown</option>
                          <option style="background-color:#DEB887" value="#DEB887">BurlyWood</option>
                          <option style="background-color:#5F9EA0" value="#5F9EA0">CadetBlue</option>
                          <option style="background-color:#7FFF00" value="#7FFF00">Chartreuse</option>
                          <option style="background-color:#D2691E" value="#D2691E">Chocolate</option>
                          <option style="background-color:#FF7F50" value="#FF7F50">Coral</option>
                          <option style="background-color:#6495ED" value="#6495ED">CornFlowerBlue</option>
                          <option style="background-color:#FFF8DC" value="#FFF8DC">Cornsilk</option>
                          <option style="background-color:#DC143C" value="#DC143C">Crimson</option>
                          <option style="background-color:#00FFFF" value="#00FFFF">Cyan</option>
                          <option style="background-color:#00008B" value="#00008B">DarkBlue</option>
                          <option style="background-color:#008B8B" value="#008B8B">DarkCyan</option>
                          <option style="background-color:#B8860B" value="#B8860B">DarkGoldenRod</option>
                          <option style="background-color:#A9A9A9" value="#A9A9A9">DarkGray</option>
                          <option style="background-color:#006400" value="#006400">DarkGreen</option>
                          <option style="background-color:#BDB76B" value="#BDB76B">DarkKhaki</option>
                          <option style="background-color:#8B008B" value="#8B008B">DarkMagenta</option>
                          <option style="background-color:#556B2F" value="#556B2F">DarkOliveGreen</option>
                          <option style="background-color:#FF8C00" value="#FF8C00">DarkOrange</option>
                          <option style="background-color:#9932CC" value="#9932CC">DarkOrchid</option>
                          <option style="background-color:#8B0000" value="#8B0000">DarkRed</option>
                          <option style="background-color:#E9967A" value="#E9967A">DarkSalmon</option>
                          <option style="background-color:#8FBC8F" value="#8FBC8F">DarkSeaGreen</option>
                          <option style="background-color:#483D8B" value="#483D8B">DarkSlateBlue</option>
                          <option style="background-color:#2F4F4F" value="#2F4F4F">DarkSlateGray</option>
                          <option style="background-color:#00CED1" value="#00CED1">DarkTurquoise</option>
                          <option style="background-color:#9400D3" value="#9400D3">DarkViolet</option>
                          <option style="background-color:#FF1493" value="#FF1493">DeepPink</option>
                          <option style="background-color:#00BFFF" value="#00BFFF">DeepSkyBlue</option>
                          <option style="background-color:#696969" value="#696969">DimGray</option>
                          <option style="background-color:#1E90FF" value="#1E90FF">DodgerBlue</option>
                          <option style="background-color:#B22222" value="#B22222">FireBrick</option>
                          <option style="background-color:#FFFAF0" value="#FFFAF0">FloralWhite</option>
                          <option style="background-color:#228B22" value="#228B22">ForestGreen</option>
                          <option style="background-color:#FF00FF" value="#FF00FF">Fuchsia</option>
                          <option style="background-color:#DCDCDC" value="#DCDCDC">Gainsboro</option>
                          <option style="background-color:#F8F8FF" value="#F8F8FF">GhostWhite</option>
                          <option style="background-color:#FFD700" value="#FFD700">Gold</option>
                          <option style="background-color:#DAA520" value="#DAA520">GoldenRod</option>
                          <option style="background-color:#808080" value="#808080">Gray</option>
                          <option style="background-color:#008000" value="#008000">Green</option>
                          <option style="background-color:#ADFF2F" value="#ADFF2F">GreenYellow</option>
                          <option style="background-color:#F0FFF0" value="#F0FFF0">HoneyDew</option>
                          <option style="background-color:#FF69B4" value="#FF69B4">HotPink</option>
                          <option style="background-color:#CD5C5C" value="#CD5C5C">IndianRed</option>
                          <option style="background-color:#4B0082" value="#4B0082">Indigo</option>
                          <option style="background-color:#FFFFF0" value="#FFFFF0">Ivory</option>
                          <option style="background-color:#F0E68C" value="#F0E68C">Khaki</option>
                          <option style="background-color:#E6E6FA" value="#E6E6FA">Lavender</option>
                          <option style="background-color:#FFF0F5" value="#FFF0F5">LavenderBlush</option>
                          <option style="background-color:#7CFC00" value="#7CFC00">LawnGreen</option>
                          <option style="background-color:#FFFACD" value="#FFFACD">LemonChiffon</option>
                          <option style="background-color:#ADD8E6" value="#ADD8E6">LightBlue</option>
                          <option style="background-color:#F08080" value="#F08080">LightCoral</option>
                          <option style="background-color:#E0FFFF" value="#E0FFFF">LightCyan</option>
                          <option style="background-color:#FAFAD2" value="#FAFAD2">LightGoldenRodYellow</option>
                          <option style="background-color:#D3D3D3" value="#D3D3D3">LightGrey</option>
                          <option style="background-color:#90EE90" value="#90EE90">LightGreen</option>
                          <option style="background-color:#FFB6C1" value="#FFB6C1">LightPink</option>
                          <option style="background-color:#FFA07A" value="#FFA07A">LightSalmon</option>
                          <option style="background-color:#20B2AA" value="#20B2AA">LightSeaGreen</option>
                          <option style="background-color:#87CEFA" value="#87CEFA">LightSkyBlue</option>
                          <option style="background-color:#778899" value="#778899">LightSlateGray</option>
                          <option style="background-color:#B0C4DE" value="#B0C4DE">LightSteelBlue</option>
                          <option style="background-color:#FFFFE0" value="#FFFFE0">LightYellow</option>
                          <option style="background-color:#00FF00" value="#00FF00">Lime</option>
                          <option style="background-color:#32CD32" value="#32CD32">LimeGreen</option>
                          <option style="background-color:#FAF0E6" value="#FAF0E6">Linen</option>
                          <option style="background-color:#FF00FF" value="#FF00FF">Magenta</option>
                          <option style="background-color:#800000" value="#800000">Maroon</option>
                          <option style="background-color:#66CDAA" value="#66CDAA">MediumAquaMarine</option>
                          <option style="background-color:#0000CD" value="#0000CD">MediumBlue</option>
                          <option style="background-color:#BA55D3" value="#BA55D3">MediumOrchid</option>
                          <option style="background-color:#9370D8" value="#9370D8">MediumPurple</option>
                          <option style="background-color:#3CB371" value="#3CB371">MediumSeaGreen</option>
                          <option style="background-color:#7B68EE" value="#7B68EE">MediumSlateBlue</option>
                          <option style="background-color:#00FA9A" value="#00FA9A">MediumSpringGreen</option>
                          <option style="background-color:#48D1CC" value="#48D1CC">MediumTurquoise</option>
                          <option style="background-color:#C71585" value="#C71585">MediumVioletRed</option>
                          <option style="background-color:#191970" value="#191970">MidnightBlue</option>
                          <option style="background-color:#F5FFFA" value="#F5FFFA">MintCream</option>
                          <option style="background-color:#FFE4E1" value="#FFE4E1">MistyRose</option>
                          <option style="background-color:#FFE4B5" value="#FFE4B5">Moccasin</option>
                          <option style="background-color:#FFDEAD" value="#FFDEAD">NavajoWhite</option>
                          <option style="background-color:#000080" value="#000080">Navy</option>
                          <option style="background-color:#FDF5E6" value="#FDF5E6">OldLace</option>
                          <option style="background-color:#808000" value="#808000">Olive</option>
                          <option style="background-color:#6B8E23" value="#6B8E23">OliveDrab</option>
                          <option style="background-color:#FFA500" value="#FFA500">Orange</option>
                          <option style="background-color:#FF4500" value="#FF4500">OrangeRed</option>
                          <option style="background-color:#DA70D6" value="#DA70D6">Orchid</option>
                          <option style="background-color:#EEE8AA" value="#EEE8AA">PaleGoldenRod</option>
                          <option style="background-color:#98FB98" value="#98FB98">PaleGreen</option>
                          <option style="background-color:#AFEEEE" value="#AFEEEE">PaleTurquoise</option>
                          <option style="background-color:#D87093" value="#D87093">PaleVioletRed</option>
                          <option style="background-color:#FFEFD5" value="#FFEFD5">PapayaWhip</option>
                          <option style="background-color:#FFDAB9" value="#FFDAB9">PeachPuff</option>
                          <option style="background-color:#CD853F" value="#CD853F">Peru</option>
                          <option style="background-color:#FFC0CB" value="#FFC0CB">Pink</option>
                          <option style="background-color:#DDA0DD" value="#DDA0DD">Plum</option>
                          <option style="background-color:#B0E0E6" value="#B0E0E6">PowderBlue</option>
                          <option style="background-color:#800080" value="#800080">Purple</option>
                          <option style="background-color:#FF0000" value="#FF0000">Red</option>
                          <option style="background-color:#BC8F8F" value="#BC8F8F">RosyBrown</option>
                          <option style="background-color:#4169E1" value="#4169E1">RoyalBlue</option>
                          <option style="background-color:#8B4513" value="#8B4513">SaddleBrown</option>
                          <option style="background-color:#FA8072" value="#FA8072">Salmon</option>
                          <option style="background-color:#F4A460" value="#F4A460">SandyBrown</option>
                          <option style="background-color:#2E8B57" value="#2E8B57">SeaGreen</option>
                          <option style="background-color:#FFF5EE" value="#FFF5EE">SeaShell</option>
                          <option style="background-color:#A0522D" value="#A0522D">Sienna</option>
                          <option style="background-color:#C0C0C0" value="#C0C0C0">Silver</option>
                          <option style="background-color:#87CEEB" value="#87CEEB">SkyBlue</option>
                          <option style="background-color:#6A5ACD" value="#6A5ACD">SlateBlue</option>
                          <option style="background-color:#708090" value="#708090">SlateGray</option>
                          <option style="background-color:#FFFAFA" value="#FFFAFA">Snow</option>
                          <option style="background-color:#00FF7F" value="#00FF7F">SpringGreen</option>
                          <option style="background-color:#4682B4" value="#4682B4">SteelBlue</option>
                          <option style="background-color:#D2B48C" value="#D2B48C">Tan</option>
                          <option style="background-color:#008080" value="#008080">Teal</option>
                          <option style="background-color:#D8BFD8" value="#D8BFD8">Thistle</option>
                          <option style="background-color:#FF6347" value="#FF6347">Tomato</option>
                          <option style="background-color:#40E0D0" value="#40E0D0">Turquoise</option>
                          <option style="background-color:#EE82EE" value="#EE82EE">Violet</option>
                          <option style="background-color:#F5DEB3" value="#F5DEB3">Wheat</option>
                          <option style="background-color:#FFFFFF" value="#FFFFFF">White</option>
                          <option style="background-color:#F5F5F5" value="#F5F5F5">WhiteSmoke</option>
                          <option style="background-color:#FFFF00" value="#FFFF00">Yellow</option>
                          <option style="background-color:#9ACD32" value="#9ACD32">YellowGreen</option>
                        </select>
                    </label>
                    </fieldset> <!-- ends contact -->
                <fieldset class="buttons">
                    <legend></legend>
                    <input type="submit" id="btnSubmit" name="btnSubmit" value="Submit" tabindex="900" class="button">
                </fieldset> <!-- ends buttons -->
            </fieldset> <!-- Ends Wrapper -->

            <p id="demo">

            <?php

            $circleToPrintStart = "<svg height =" . $size . " width = " . $size . "> <circle cx = " . $center . " cy = " . $center . " r = " . $radius . " fill = ";
            $circleToPrintEnd = "  /> </svg>";

            print $circleToPrintStart . $color . $circleToPrintEnd;

            ?>

            </p>

            <script>
            function myFunction() {
                var x = document.getElementById("txtColor").value;
                document.getElementById("demo").innerHTML = <?php echo json_encode($circleToPrintStart); ?> + x + <?php echo json_encode($circleToPrintEnd); ?>;
            }
            </script>


        </form>
    </article>



<?php
include "footer.php";
?>
</body>
</html>