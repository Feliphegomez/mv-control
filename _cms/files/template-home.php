<?php global $pageDataGlobal; ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php $pageDataGlobal->includeFile("head.php"); ?>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
					<?php $pageDataGlobal->includeFile("left-menu.php"); ?>
      

        <!-- Page Content  -->
        <div id="content">
					  <?php
            if($pageDataGlobal->module != 'login')
            {
              $pageDataGlobal->includeFile("top-menu.php");
              $pageDataGlobal->includePageActive();
              $pageDataGlobal->includeFile("footer.php");
            }
            else
            {
              $pageDataGlobal->includePageActive();
              $pageDataGlobal->includeFile("footer.php");
            }
            ?>
        </div>
    </div>
  <?php
    $pageDataGlobal->includeFile("footer-scripts.php");
    $pageDataGlobal->includePageActiveFooterScripts();
  ?>

    <div class="overlay"></div>
</body>

</html>