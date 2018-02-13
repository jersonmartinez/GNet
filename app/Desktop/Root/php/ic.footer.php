<div class="row">
  <div class="col-xs-6">
    <span class="footer-legal">© <?php echo date("Y"); ?> TheCodeBrain / InterCloud (Intranet Académica)</span>
  </div>
  <div class="col-xs-6 text-right">
	  
	  <?php
	    include ("app/src/test/disk_free_space.php");
	    include ("app/src/test/size_directory.php");
	  ?>

    <span class="footer-meta">Tamaño del sistema: <b><?php echo dirSize("./app"); ?></b> | Disponible: <b>
    	<?php echo know_free_space(); ?></b> Libre</span>
    <a href="#content" class="footer-return-top">
      <span class="fa fa-arrow-up"></span>
    </a>
  </div>
</div>