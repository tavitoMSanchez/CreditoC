<?php 
require_once '../../config/conexionexcel.php';
 $user = $_REQUEST['variable'];
 $admon = $_REQUEST['admon'];
	$nombre ='productosenexcel.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel;charset=iso-8859-15"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:attachment; filename="'.$nombre.'"');
			header("Content-Transfer-Encoding: binary");


	echo utf8_decode("<table border='0'> 
						<tr > 
						<td style='font-weight:bold; border:1px solid #eee;background: #3b81ff;color:white;'>FechaRegistro</td> 
						<td style='font-weight:bold; border:1px solid #eee;background: #3b81ff;color:white;'>ID</td> 
						<td style='font-weight:bold; border:1px solid #eee;background: #3b81ff;color:white;padding:10px;'>Nombre</td>
						<td style='font-weight:bold; border:1px solid #eee;background: #3b81ff;color:white;padding:10px;'>Apellido_Paterno</td>
						<td style='font-weight:bold; border:1px solid #eee;background: #3b81ff;color:white;padding:10px;'>Apellido_Materno</td>
						<td style='font-weight:bold; border:1px solid #eee;background: #3b81ff;color:white;padding:10px;'>Monto</td>
						<td style='font-weight:bold; border:1px solid #eee;background: #3b81ff;color:white;padding:10px;'>Cuota</td>
						<td style='font-weight:bold; border:1px solid #eee;background: #3b81ff;color:white;padding:10px;'>Empresa</td>
						<td style='font-weight:bold; border:1px solid #eee;background: #3b81ff;color:white;padding:10px;'>Telefono</td>
						<td style='font-weight:bold; border:1px solid #eee;background: #3b81ff;color:white;padding:10px;'>Ejecutivo</td>
						<td style='font-weight:bold; border:1px solid #eee;background: #3b81ff;color:white;padding:10px;'>Estatus</td>
						</tr>");


				$reporte=conexion::consultas('clientes LEFT JOIN usuario ON clientes.IdUsuario = usuario.IdUsuario', '1' ,$user,$admon);

				foreach ($reporte as $value) {

					 echo utf8_decode("<tr>
					    <td style='border:1px solid #eee;'>".$value["FechaRegistro"]."</td>
						<td style='border:1px solid #eee;'>".$value["IdCliente"]."</td>
						<td style='border:1px solid #eee;'>".$value["Nombre"]."</td>
						<td style='border:1px solid #eee;'>".$value["ApellidoPa"]."</td>
						<td style='border:1px solid #eee;'>".$value["ApellidoMa"]."</td>
						<td style='border:1px solid #eee;'>".$value["Monto"]."</td>
						<td style='border:1px solid #eee;'>".$value["Cuota"]."</td>
						<td style='border:1px solid #eee;'>".$value["CentroTrabajo"]."</td>
						<td style='border:1px solid #eee;'>".$value["Telefono"]."</td>
						<td style='border:1px solid #eee;'>".$value["Ejecutivo"]."</td>
						<td style='border:1px solid #eee;'>".$value["Estatus"]."</td>

						</tr>");

				}


			echo "</table>";


			 ?>