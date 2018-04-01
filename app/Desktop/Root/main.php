<body class="dashboard-page">
    <?php include (PD_DESKTOP_ROOT_PHP."/ic.panels.php"); ?>

    <div id="main">
        <?php include (PD_DESKTOP_ROOT_PHP."/ic.headers.php"); ?>

        <aside id="sidebar_left" class="nano nano-light affix">
            <div class="sidebar-left-content nano-content">
                <?php include (PD_DESKTOP_ROOT_PHP."/ic.sidebar-header.php"); ?>
                <?php include (PD_DESKTOP_ROOT_PHP."/ic.sidebar_menu.php"); ?>
            </div>
        </aside>

        <section id="content_wrapper">
            <?php include (PD_DESKTOP_ROOT_PHP."/ic.Topbar-Dropdown.php"); ?>      
            <?php include (PD_DESKTOP_ROOT_PHP."/ic.content_main.php"); ?>

            <footer id="content-footer" class="affix">
                <?php include (PD_DESKTOP_ROOT_PHP."/ic.footer.php"); ?>
            </footer>
        </section>
    </div>
</body>