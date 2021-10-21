<?php
  require_once("../../config/conexion.php"); 
  $idUser = $_SESSION["IdUsuario"];
  $idadmon = $_SESSION["admon"];
  if(isset($_SESSION["IdUsuario"])){ 
?>
<!doctype html>
<html lang="en" class="no-focus">
    <head>
        <?php require_once("../MainHead/MainHead.php");?> 
        <style>
             #myDIV {
            visibility: hidden;
            }
        </style>

        <title>Consultar Prospectos</title>

    </head>
    <body>
        <div id="page-container" class="sidebar-o side-scroll page-header-modern main-content-boxed  sidebar-inverse">
            <aside id="side-overlay">
                <div id="side-overlay-scroll">
                    <div class="content-header content-header-fullrow">
                        <div class="content-header-section align-parent">
                            <button type="button" class="btn btn-circle btn-dual-secondary align-v-r" data-toggle="layout" data-action="side_overlay_close">
                                <i class="fa fa-times text-danger"></i>
                            </button>

                            <div class="content-header-item">
                                <a class="img-link mr-5" href="be_pages_generic_profile.html">
                                    <img class="img-avatar img-avatar32" src="../../public/assets/img/avatars/avatar15.jpg" alt="">
                                </a>
                                <a class="align-middle link-effect text-primary-dark font-w600" href="be_pages_generic_profile.html">John Smith</a>
                            </div>
                        </div>
                    </div>
                </div>

            </aside>

            <nav id="sidebar">
                <div id="sidebar-scroll">
                    <div class="sidebar-content">
                        <?php require_once("../MainSidebar/MainSidebar.php");?> 
                        
                        <?php require_once("../MainMenu/MainMenu.php");?> 
                    </div>

                </div>
            </nav>

            <?php require_once("../MainHeader/MainHeader.php");?> 

            <!--Contenido -->
            <main id="main-container">
                <div class="content">
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Listado de Prospectos<small></small></h3>
                        </div>
                        <div class="block-content block-content-full">
                            <table id="partes_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                <thead>
                                    <tr>
                                        <!-- <th style="width: 10%;">IdCliente</th> -->
                                        <th  style="width: 15%;">Fecha Registro</th>
                                        <th class="d-none d-sm-table-cell" style="width: 35%;">FechaRegistro</th>
                                        <th class="d-none d-sm-table-cell" style="width: 11%;">Monto</th>
                                        <th class="d-none d-sm-table-cell" style="width: 5%;">Plazo requerido</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Producto</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Empresa</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Telefono</th>
                                        <th class="d-none d-sm-table-cell" style="width: 12%;">Ejecutivo</th>
                                        <th class="d-none d-sm-table-cell" style="width: 12%;">Estatus</th>
                                        <th class="text-center" style="width: 5%;">Observación</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <a class="label3 label2-pill label2-success" href="productosExcel.php?variable=<?php echo $idUser;?>&admon=<?php echo $idadmon;?>" >Exportar Excel</a>

                        </div>
                    </div>
                </div>
            </main>
            <!-- Contenido -->

            <div id="modaldetalle" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form action="/action_page.php" id="formObservacion">
                    <div class="modal-header">
                                    <h5 class="modal-title">Observación del prospecto</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                    </div>
                        <div class="modal-body">
                          <div class="block-content block-content-full">
                                    <div class="form-group row">
                                                        <input type="hidden" id="IdClienteSeleccionado" name="IdClienteSeleccionado"></input>
                                                        <label class="col-lg-4 col-form-label" for="val-select2">Estatus <span class="text-danger">*</span></label>
                                                        <div class="col-lg-8" style="padding-bottom: 15px;padding-top: 15px;">
                                                            <select class="js-select2 form-control" id="valselect2" name="valselect2" style="width: 100%;" data-placeholder="Seleccione..">
                                                            
                                                            </select>
                                                        
                                                        </div>
                                    </div>
                                    <div class="form-group row" >
                                                        <label class="col-lg-4 col-form-label"  >Observacion<span class="text-danger" >*</span></label>                                            
                                                        <div class="col-lg-8" style="padding-bottom: 15px;padding-top: 15px;">                                                                        
                                                            <textarea id="Observacion" name="Observacion" class="form-control" rows="4"style="width: 100%;" >
                                                            </textarea>                                        
                                                        </div>
                                    </div>
                                    <div class="form-group row" id="myDIV">    
                                                        <label class="col-lg-4 col-form-label"  >Ejecutivo<span class="text-danger" >*</span></label>
                                                        <div class="col-lg-8" style="padding-bottom: 15px;padding-top: 15px;">
                                                            <select class="js-select2 form-control" id="selectUsuario" name="selectUsuario" style="width: 100%;" data-placeholder="Seleccione..">
                                                            </select>
                                                        </div>
                                    </div>
                           </div>
                            
                        </div>
                        <div class="modal-footer">
                            
                           <button type="submit" class="btn btn-primary"  id="#" >Guardar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                        
                    </div>
                </div>
            </div>

        <?php require_once("../MainFooter/MainFooter.php");?> 

        </div>

        <?php require_once("../MainJs/MainJs.php");?> 
        <script type="text/javascript" src="consultarpagos.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    </body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php");
  }
?>