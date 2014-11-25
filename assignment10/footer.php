<!-- ######################     Footer  #################################### -->
<footer>
    <p>Madison Harris</p>
		<?php
				 $today = date("F j, Y");

					$todayDateValue = date("Y-m-d"); 

					print '<p>You are visiting on <time datetime="' . $todayDateValue . '">' . $today . "</time></p>\n";

		?>
</footer>