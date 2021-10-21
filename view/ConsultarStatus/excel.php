<?php 

  require_once("../../config/conexion.php");
  require_once("../../models/Partes.php");

            
            // $sql="SELECT Nombre,Monto,Cuota,CentroTrabajo,Telefono FROM prospecto WHERE Estatus=1;";
            // $sql=$conectar->prepare($sql);
            // $sql->execute();
            // return $resultado=$sql->fetchall(pdo::FETCH_ASSOC);

header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=File.xls");
?>
<table id="partes_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
<thead>
    <tr>
        <!-- <th style="width: 10%;">IdCliente</th> -->
        <th style="width: 14%;">Fecha</th>
        <th class="d-none d-sm-table-cell" style="width: 35%;">Nombre</th>
        <th class="d-none d-sm-table-cell" style="width: 15%;">Monto</th>
        <th class="d-none d-sm-table-cell" style="width: 5%;">Plazo requerido</th>
        <th class="d-none d-sm-table-cell" style="width: 5%;">Producto</th>
        <th class="d-none d-sm-table-cell" style="width: 15%;">Empresa</th>
        <th class="d-none d-sm-table-cell" style="width: 15%;">Telefono</th>
        <th class="d-none d-sm-table-cell" style="width: 15%;">Ejecutivo</th>
        <th class="d-none d-sm-table-cell" style="width: 15%;">Estatus</th>
        <th class="text-center" style="width: 5%;"></th>
    </tr>
</thead>
<?php

while ($row=mysqli_fetch_assoc($resultado)){

?>
<tr>
    <td><?php echo $row['Nombre']; ?></td>
    <td><?php echo $row['Monto']; ?></td>
    <td><?php echo $row['Cuota']; ?></td>
    <td><?php echo $row['Producto']; ?></td>
    <td><?php echo $row['CentroTrabajo']; ?></td>
    <td><?php echo $row['Telefono']; ?></td>
    <td><?php echo $row['nom']; ?></td>
    <td><?php echo $row['IdEstatusCliente']; ?></td>
</tr>
</table>

<?php

}

?>
<!-- <script type="text/javascript" src="../ConsultarStatus/consultarstatus.js"></script> -->

