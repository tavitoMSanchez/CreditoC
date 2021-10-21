<?php

class Conexion{

	static public function conectar(){	

		$link = new PDO("mysql:host=localhost;dbname=mamex;charset=utf8mb4",
						"root",
						"",array(PDO::ATTR_EMULATE_PREPARES => false,
								PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		                      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
						);

		return $link;

	}

		// //CONSULTAS DE 2 A MAS REGISTROS COMO RESULTADO 
		// //SELECT
		//   clientes.IdCliente,clientes.FechaRegistro,clientes.Nombre,clientes.ApellidoPa,clientes.ApellidoMa,clientes.Monto,
        //   clientes.Cuota,clientes.CentroTrabajo,clientes.Telefono,usuario.nom as Ejecutivo,
		// 	  CASE
		// 	WHEN  clientes.IdEstatusCliente = 1  THEN "Atendido"
		// 	WHEN clientes.IdEstatusCliente = 2 THEN "Integración"
		// 	WHEN clientes.IdEstatusCliente = 3 THEN "Proceso"
		// 	WHEN clientes.IdEstatusCliente = 4 THEN "Comite"
		// 	WHEN clientes.IdEstatusCliente = 5 THEN "Espera"
		// 	WHEN clientes.IdEstatusCliente = 6 THEN "Cancelado"
		// 	ELSE "Realizado"
		// 	END AS Estatus,
		 
		//  clientes.Producto
        //     //FROM clientes LEFT JOIN usuario ON clientes.IdUsuario = usuario.IdUsuario
		// 	// WHERE clientes.Estatus=1 AND clientes.IdUsuario = ? OR clientes.admon=?;"
		static public function consultas($tabla,$where1='',$where2='',$where3='',
		$select='clientes.IdCliente,clientes.FechaRegistro,clientes.Nombre,clientes.ApellidoPa,clientes.ApellidoMa,clientes.Monto,
		clientes.Cuota,clientes.CentroTrabajo,clientes.Telefono,
		CASE
		WHEN 
		usuario.nom IS NULL THEN "Sin asignar"
		ELSE usuario.nom
		END AS Ejecutivo,
		CASE
		  WHEN  clientes.IdEstatusCliente = 1  THEN "Atendido"
		  WHEN clientes.IdEstatusCliente = 2 THEN "Integración"
		  WHEN clientes.IdEstatusCliente = 3 THEN "Proceso"
		  WHEN clientes.IdEstatusCliente = 4 THEN "Comite"
		  WHEN clientes.IdEstatusCliente = 5 THEN "Espera"
		  WHEN clientes.IdEstatusCliente = 6 THEN "Cancelado"
		  ELSE "Realizado"
		END AS Estatus,
	      clientes.Producto'){

			
				$stmt =Conexion::conectar()->prepare(" SELECT $select FROM $tabla WHERE clientes.Estatus = $where1 AND clientes.IdUsuario= $where2 OR clientes.admon=$where3;");

				$stmt -> execute();

				return $stmt -> fetchAll();


				$stmt -> close();
				
				$stmt = null;
			
		}

	
 
}
