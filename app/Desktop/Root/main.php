<body class="dashboard-page">
  <?php include ("php/ic.panels.php"); ?>

  <div id="main">
    <?php include ("php/ic.headers.php"); ?>

    <aside id="sidebar_left" class="nano nano-light affix">
      <div class="sidebar-left-content nano-content">
        <?php include ("php/ic.sidebar-header.php"); ?>
        <?php include ("php/ic.sidebar_menu.php"); ?>
        
      </div>
    </aside>

    <section id="content_wrapper">
      <?php include ("php/ic.Topbar-Dropdown.php"); ?>      
      <?php include ("php/ic.content_main.php"); ?>

      <footer id="content-footer" class="affix">
        <?php include ("php/ic.footer.php"); ?>
      </footer>
    </section>
  </div>

  <?php include ("php/ic.foot_js.php"); ?>
</body>