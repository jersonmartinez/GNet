<div id="ContextMenuTest" style="visibility:hidden; z-index: 10000; position: absolute;">
    <li action_selection="monitor" onclick="javascript: getDataSelection(this);">
        <div class="icons-menu-context">
            <i class="fa fa-tachometer"></i>
        </div>
        <div class="label-menu-context">
            Monitorizar
        </div>
    </li>

    <li action_selection="network" onclick="javascript: getDataSelection(this);">
        <div class="icons-menu-context">
            <i class="fa fa-sitemap"></i>
        </div>
        <div class="label-menu-context">
            Red
        </div>
    </li>

    <li action_selection="processes" onclick="javascript: getDataSelection(this);">
        <div class="icons-menu-context">
            <i class="glyphicon glyphicon-tasks"></i>
        </div>
        <div class="label-menu-context">
            Procesos
        </div>
    </li>

    <li action_selection="scanning" onclick="javascript: getDataSelection(this);">
        <div class="icons-menu-context">
            <i class="glyphicon glyphicon-fire"></i>
        </div>
        <div class="label-menu-context" title="Escanear con NMap">
            Escanear
        </div>
    </li>

    <li action_selection="properties" onclick="javascript: getDataSelection(this);">
        <div class="icons-menu-context">
            <i class="fa fa-desktop"></i>
        </div>
        <div class="label-menu-context">
            Propiedades
        </div>
    </li>
</div>

<div id="ContextMenuTest_White" style="visibility:hidden; z-index: 10001; position: absolute;">
    <li action_selection="tracking_network" onclick="javascript: getDataContextMenuTestWhite(this);">
        <div class="icons-menu-context">
            <i class="fa fa-desktop"></i>
        </div>
        <div class="label-menu-context">
            Sondear
        </div>
    </li>

    <li action_selection="information" onclick="javascript: getDataContextMenuTestWhite(this);">
        <div class="icons-menu-context">
            <i class="fa fa-desktop"></i>
        </div>
        <div class="label-menu-context">
            Información
        </div>
    </li>
</div>