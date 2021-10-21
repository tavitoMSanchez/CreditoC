<?php
    require_once("../config/conexion.php");
    require_once("../models/Menu.php");
    $menu = new Menu();

    switch($_GET["op"]){

        case "listar":
            $datos=$menu->get_menu();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["Menu"];
                $sub_array[] = $row["MenuIcon"];
                $sub_array[] = $row["MenuNom"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["IdMenu"].');"  id="'.$row["IdMenu"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["IdMenu"].');"  id="'.$row["IdMenu"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
                $data[] = $sub_array;
            }
        
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;

        case "activarydesactivar":
            $datos=$menu->get_menu_x_id($_POST["IdMenu"]);
            if(is_array($datos)==true and count($datos)>0){
                $menu->delete_menu($_POST["IdMenu"]);
            } 
        break;

        case 'mostrar':
            $datos=$menu->get_menu_x_id($_POST["IdMenu"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["IdMenu"] = $row["IdMenu"];
                    $output["Menu"] = $row["Menu"];
                    $output["MenuIcon"] = $row["MenuIcon"];
                    $output["MenuNom"] = $row["MenuNom"];
                }
                echo json_encode($output);
            }
        break;

        case "guardaryeditar":
            if(empty($_POST["IdMenu"])){       
                $menu->insert_menu($_POST["Menu"],$_POST["MenuIcon"],$_POST["MenuNom"]);     
            }
            else {
                $menu->update_menu($_POST["IdMenu"],$_POST["Menu"],$_POST["MenuIcon"],$_POST["MenuNom"]); 
            }
        break;

    }
?>