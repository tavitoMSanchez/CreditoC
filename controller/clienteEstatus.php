<?php
    require_once("../config/conexion.php");
    require_once("../models/EstatusCliente.php");
    $cliente = new Cliente();

    switch($_GET["op"]){

        case "combo":
            $datos=$cliente->get_estatuscliente();
            if(is_array($datos)==true and count($datos)>0){    
                       
                foreach($datos as $row)
                {
                   
                    $html.= "<option value='".$row['IdEstatusCliente']."'>".$row['EstatusCliente']."</option>";
                }
                echo $html;      
            }
        break;
        case "combousuarios":
            $datos=$cliente->get_usuariocliente();
            if(is_array($datos)==true and count($datos)>0){ 
                $html.= "<option selected value='' label='Seleccione ejecutivo' disabled> </option>";           
                foreach($datos as $row)
                {                    
                    $html.= "<option value='".$row['IdUsuario']."'>".$row['nom']."</option>";
                }
                echo $html;     
                 
            }
        break;
    }

?>