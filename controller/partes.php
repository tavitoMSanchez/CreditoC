<?php
    require_once("../config/conexion.php");
    require_once("../models/Partes.php");
    $partes = new Partes();

    switch($_GET["op"]){

        case "insert":
            $datos = $partes->insert_partes($_POST["IdUsuario"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["IdProspecto"] = $row["IdProspecto"];
                }
                echo json_encode($output);
            }
        break;

        case "update":
            $partes->update_partes($_POST["IdProspecto"],$_POST["Nombre"],$_POST["Monto"]);
        break;

        case "insertdetalle":
            $partes->insert_partesdetalle($_POST["IdProspecto"],$_POST["partd_obs"],$_POST["partd_file"]);
        break;

        case "deletedetalle":
            $partes->delete_partesdetalle($_POST["IdProspecto"]);
        break;

        case "listardetalle":
            $datos=$partes->list_partesdetalle($_POST["IdProspecto"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["partd_obs"];
                // $sub_array[] = '<a href="../../public/src/'.$row["partd_file"].'" target="_blank">'.$row["partd_file"].'</a>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["partd_id"].');"  id="'.$row["partd_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
                $data[] = $sub_array;
            }
        
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;

        case "listardetalle_consulta":
            $datos=$partes->list_partesdetalle($_POST["IdProspecto"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["partd_obs"];
                $sub_array[] = '<button type="button" );"  class="btn btn-outline-info btn-icon"><div><i class="fa fa-save"></i></div></button>';
                // $sub_array[] = '<a href="../../public/src/'.$row["partd_file"].'" target="_blank">'.$row["partd_file"].'</a>';
                $data[] = $sub_array;
            }
        
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;

        case 'mostrar':
            $datos=$partes->get_estatus_x_id($_POST["IdCliente"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["IdEstatusCliente"] = $row["IdEstatusCliente"];
                    $output["IdCliente"] = $row["IdCliente"];
                    $output["Observacion"] = $row["Observacion"];
                    $output["IdUsuario"] = $row["IdUsuario"];
                    // $output["Menu"] = $row["Menu"];
                    // $output["MenuIcon"] = $row["MenuIcon"];
                    // $output["MenuNom"] = $row["MenuNom"];
                }
                echo json_encode($output);
            }
        break;

        case "listar":
            $datos=$partes->list_partes($_POST["IdUsuario"],$_POST["usu_admon"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                // $sub_array[] = "CL".$row["IdProspecto"];
                $sub_array[] = date("Y-m-d", strtotime($row["FechaRegistro"]));
                $sub_array[] = $row["Nombre"] . " " .$row["ApellidoPa"] . " ".$row["ApellidoMa"];
                $sub_array[] = $row["Monto"];
                $sub_array[] = $row["Cuota"] ." Quincenas" ;
                $sub_array[] = $row["Producto"];
                $sub_array[] = $row["CentroTrabajo"];               
                $sub_array[] = $row["Telefono"];
                if ($row["nom"]=="")
                {
                    $sub_array[] = '<span class="label4 label3-pill label3-sin">Sin asignar</span>';
                }else{
                    $sub_array[] = '<span class="label4 label3-pill label3-nombre">'.$row["nom"].'</span>'; ;
                }
               
                if ($row["IdEstatusCliente"]=="5")
                {
                    $sub_array[] = '<span class="label3 label2-pill label2-default">Espera</span>';
                }else if($row["IdEstatusCliente"]=="6")
                {
                    $sub_array[] = '<span class="label3 label2-pill label2-danger">Cancelado</span>';
                }else if($row["IdEstatusCliente"]=="7")
                {
                    $sub_array[] = '<span class="label3 label2-pill label2-success">Realizado</span>';
                }else if($row["IdEstatusCliente"]=="4")
                {
                    $sub_array[] = '<span class="label3 label2-pill label2-primary">Comite</span>'; 
                }else if ($row["IdEstatusCliente"]=="3")
                {
                    $sub_array[] = '<span class="label3 label2-pill label2-info">Proceso</span>';
                }else if($row["IdEstatusCliente"]=="2")
                {
                    $sub_array[] = '<span class="label3 label2-pill label2-second">Integración</span>';
                }else if ($row["IdEstatusCliente"]=="1")
                {
                    $sub_array[] = '<span class="label3 label2-pill label2-warning">Atendido</span>';
                }

                $sub_array[] = '<button type="button" onClick="ver('.$row["IdCliente"].');"  id="'.$row["IdCliente"].'" class="btn btn-outline-info btn-icon"><div><i class="fa fa-search"></i></div></button>';
                $data[] = $sub_array;
            }
        
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;

        case "guardaryeditar":
            if(empty($_POST["IdClienteSeleccionado"])){       
                $partes->insert_obs($_POST["valselect2"],$_POST["Observacion"],$_POST["selectUsuario"]);     
            }
            else {
                $partes->update_obs($_POST["IdClienteSeleccionado"],$_POST["valselect2"],$_POST["Observacion"],$_POST["selectUsuario"]); 
            }
        break;

    }

?>