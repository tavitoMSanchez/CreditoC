<?php
    class Partes extends Conectar {
        
        public function insert_partes($IdUsuario){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="insert into tm_partes values (null, ?, null,null,now(),null,null,2);";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $IdUsuario);
            $sql->execute();

            $sql1="select last_insert_id() as 'part_id';";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchall(pdo::FETCH_ASSOC);
        }

        public function update_partes($IdProspecto,$Nombre,$Monto){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="update prospecto set
                    Nombre=?,
                    Monto=?,
                    est=1
                where
                    IdProspecto=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Nombre);
            $sql->bindvalue(2, $Monto);
            $sql->bindvalue(3, $IdProspecto);
            $sql->execute();
        }


        public function insert_obs($IdEstatusCliente,$Observacion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO menu VALUES(null,?,?,?,1)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $IdEstatusCliente);
            $sql->bindValue(2, $Observacion);
			$sql->execute();
        }

        public function update_obs($IdClienteSeleccionado,$valselect2,$Observacion,$selectUsuario){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE clientes SET
                IdEstatusCliente=?,
                Observacion=?,
                IdUsuario =?              
                WHERE
                IdCliente=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $valselect2);          
            $sql->bindValue(2, $Observacion);
            $sql->bindValue(3, $selectUsuario);
            $sql->bindValue(4, $IdClienteSeleccionado);
            
			$sql->execute();
        }

        public function insert_partesdetalle($part_id,$partd_obs,$partd_file){
            $conectar=parent::conexion();
            parent::set_names();

            require_once("Partes.php");
            $partx = new Partes();
            $partd_file = '';
            if($_FILES["partd_file"]["name"] != '')
            {
                $partd_file = $partx->upload_file();
            }else{
                $partd_file = $_POST["hidden_file_imagen"];
            }

            $sql="insert into tm_detallepartes values (null, ?, ?,?,now(),1);";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $part_id);
            $sql->bindvalue(2, $partd_obs);
            $sql->bindvalue(3, $partd_file);
            $sql->execute();
        }

        public function upload_file(){
            if(isset($_FILES["partd_file"]))
            {
              $extension = explode('.', $_FILES['partd_file']['name']);
              $new_name = rand() . '.' . $extension[1];
              $destination = '../public/src/' . $new_name;
              move_uploaded_file($_FILES['partd_file']['tmp_name'], $destination);
              return $new_name;
            }
        }

        public function list_partesdetalle($part_id){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_detallepartes WHERE part_id=? and est=1;";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $part_id);
            $sql->execute();
            return $resultado=$sql->fetchall(pdo::FETCH_ASSOC);
        }

        public function delete_partesdetalle($partd_id){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="update tm_detallepartes set est=0 where partd_id=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $partd_id);
            $sql->execute();
        }  

        public function list_partes($IdUsuario,$usu_admon){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT clientes.IdCliente,clientes.FechaRegistro,clientes.Nombre,clientes.ApellidoPa,clientes.ApellidoMa,clientes.Monto,
            clientes.Cuota,clientes.CentroTrabajo,clientes.Telefono,usuario.nom,clientes.IdEstatusCliente,clientes.Producto
            FROM clientes LEFT JOIN usuario ON clientes.IdUsuario = usuario.IdUsuario WHERE clientes.Estatus=1 AND clientes.IdUsuario = ? OR clientes.admon=? ORDER BY clientes.FechaRegistro DESC;";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $IdUsuario);
            $sql->bindvalue(2, $usu_admon);
            $sql->execute();
            return $resultado=$sql->fetchall(pdo::FETCH_ASSOC);
        }

        public function get_estatus_x_id($IdCliente){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM clientes WHERE IdCliente=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $IdCliente);
			$sql->execute();
			return $resultado=$sql->fetchAll();
        }

    }
?>