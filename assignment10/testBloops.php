<?php
include'top.php';
?>
	
	<nav>
        <ul>
            <li><a href="#"><svg height = 50 width = 50><circle cx = 25 cy = 25 r = 15 stroke = 'black' stroke-width = '3' fill = 'white' /></svg></a></li>
            <li><a href="#"><svg height = 50 width = 50><circle cx = 25 cy = 25 r = 15 stroke = 'black' stroke-width = '3' fill = 'white' /></svg></a></li>
            <li><a href="#"><svg height = 50 width = 50><circle cx = 25 cy = 25 r = 15 stroke = 'black' stroke-width = '3' fill = 'white' /></svg></a></li>
            <li><a href="#"><svg height = 50 width = 50><circle cx = 25 cy = 25 r = 15 stroke = 'black' stroke-width = '3' fill = 'white' /></svg></a></li>
            <li><a href="#"><svg height = 50 width = 50><circle cx = 25 cy = 25 r = 15 stroke = 'black' stroke-width = '3' fill = 'white' /></svg></a></li>
            <li><a href="#"><svg height = 50 width = 50><circle cx = 25 cy = 25 r = 15 stroke = 'black' stroke-width = '3' fill = 'white' /></svg></a></li>
        </ul>
    </nav>


	<script>
		$(function() {
			circle_radius = 100;
			$links = $('nav ul li a');
			total_links = $links.size();
			$links.each(function(index) {
				$(this).attr('data-index',index);
				animateCircle($(this), 1);
			});
			$('li a').hover(function() {
				animateCircle($(this), 1.5)
			}, function() {
				animateCircle($(this), 1)

			});
			
			function animateCircle($link, expansion_scale) {
				index = $link.attr('data-index');
				radians = 2*Math.PI*(index/total_links);
				x = -(Math.sin(radians)*circle_radius*expansion_scale);
				y = -(Math.cos(radians)*circle_radius*expansion_scale);
				$link.animate({
					top: x+'px',
					left: y+'px'
				}, 200);
			}
		});
	</script>

<?php    
    include "footer.php";
?>
</body>
</html>