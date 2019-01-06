<button type="hidden" class="ModalTrackingNetworkInformation" data-toggle="modal" data-target="#NowModalTrackingNetworkInformation"></button>

<!-- <!- Modal -->
<div class="modal fade" id="NowModalTrackingNetworkInformation" tabindex="-1" role="dialog" aria-labelledby="ModalTrackingNetworkInformation" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ModalTrackingNetworkInformation"><span class="fa fa-dashboard"></span> Topologia de red</h4>
            </div>

            <div class="modal-body">        
                <!-- Modal Monitor -->
                    <div class="row">
                        <!-- Create Column with required .admin-grid class -->
                        <div class="col-md-12">
                            <div class="panel-heading PH_IPAddressHost">
                                <div class="container_options_controls" style="position: absolute; top: 0; right:100px;">
                                    <button style="padding: 9px;" class="filter btn btn-primary btn-sm active" data-filter="all">Todo</button>
                                    <button style="padding: 9px;" class="filter btn btn-primary btn-sm" data-filter=".category-5">Dispositivos finales</button>
                                    <button style="padding: 9px;" class="filter btn btn-info btn-sm" data-filter=".category-6">Enrutadores</button>
                                    <button style="padding: 9px;" class="filter btn btn-info btn-sm" data-filter=".category-7">Conmutadores</button>
                                    <button style="padding: 9px;" class="filter btn btn-info btn-sm" data-filter=".category-8">Servidores</button>

                                    <!-- Orden -->
                                    <button class="sort btn btn-default btn-sm btn_Order_Asc-secundary" data-sort="myorder:asc" style="display: none;">Asc</button>
                                    <button class="sort btn btn-default btn-sm btn_Order_Desc-secundary" data-sort="myorder:desc" style="display: none;">Desc</button>

                                    <!-- Split button -->
                                    <div class="btn-group" style="display: inline-block;">
                                        <button type="button" class="btn btn-danger btn_Order_value-secundary">Orden</button>
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li class="li_OrderAsc-secundary"><a href="#">Ascendente</a></li>
                                            <li class="li_OrderDesc-secundary"><a href="#">Descendente</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body AdminPanel_ResourcesTrackingNetworkInformation_PanelBodyModal">
                                
                            </div>

                        </div>
                        <!-- End Column -->
                    </div>
                <!-- </form> -->
                <br>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="BtnCloseModalTrackingNetworkInformation" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>