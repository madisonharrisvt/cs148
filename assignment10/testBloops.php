<?php
include'top.php';
?>

<nav class="circular-menu">

  <div class="circle">
    <a href=""><svg height = 50 width = 50><circle cx = 25 cy = 25 r = 15 stroke = 'black' stroke-width = '3' fill = 'white' /></svg></a>
    <a href=""><svg height = 50 width = 50><circle cx = 25 cy = 25 r = 15 stroke = 'black' stroke-width = '3' fill = 'white' /></svg></a>
    <a href=""><svg height = 50 width = 50><circle cx = 25 cy = 25 r = 15 stroke = 'black' stroke-width = '3' fill = 'white' /></svg></a>
    <a href=""><svg height = 50 width = 50><circle cx = 25 cy = 25 r = 15 stroke = 'black' stroke-width = '3' fill = 'white' /></svg></a>
  </div>
  
  <a href="" class="menu-button"> <svg height = 60 width = 60><circle cx = 30 cy = 30 r = 20 stroke = 'black' stroke-width = '3' fill = 'white' /></svg> </a>

</nav>
<script>
        var items = document.querySelectorAll('.circle a');

        for(var i = 0, l = items.length; i < l; i++) {
          items[i].style.left = (55 - 35*Math.cos(-0.5 * Math.PI - 2*(1/l)*i*Math.PI)).toFixed(4) + "%";
          items[i].style.top = (55 + 35*Math.sin(-0.5 * Math.PI - 2*(1/l)*i*Math.PI)).toFixed(4) + "%";
        }

        document.querySelector('.menu-button').onclick = function(e) {
            e.preventDefault(); document.querySelector('.circle').classList.toggle('open');
        }

    </script>

<?php    
    include "footer.php";
?>
</body>
</html>