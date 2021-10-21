<?php
    class Menu extends Conectar {

		public function get_menu(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM menu WHERE Estatus=1;";
            $sql=$conectar->prepare($sql);
			$sql->execute();
			return $resultado=$sql->fetchAll();
        }

        public function get_datos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(IdCliente) as count FROM clientes WHERE Estatus=1 UNION 
            SELECT COUNT(IdCliente) as count FROM clientes WHERE Estatus=1 AND IdEstatusCliente = 2;";
            $sql=$conectar->prepare($sql);
			$sql->execute();
            return $resultado=$sql->fetchColumn();
        }

        public function get_datos2(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT (select count(IdCliente) from clientes where IdEstatusCliente = 6) as Cancelado,
            (select count(IdCliente) from clientes where Estatus=1) as Todos, 
            (select count(IdCliente) from clientes where IdEstatusCliente <= 5) as Espera,
            (select count(IdCliente) from clientes where IdEstatusCliente = 7) as Realizado ";
            $sql=$conectar->prepare($sql);
			$sql->execute();
            return $resultado=$sql->fetchAll();

        }

        public function insert_menu($Menu,$MenuIcon,$MenuNom){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO menu VALUES(null,?,?,?,1)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Menu);
            $sql->bindValue(2, $MenuIcon);
            $sql->bindValue(3, $MenuNom);
			$sql->execute();
        }

        public function update_menu($IdMenu,$Menu,$MenuIcon,$MenuNom){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE menu SET
                Menu=?,
                MenuIcon=?,
                MenuNom=?
                WHERE
                IdMenu=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Menu);
            $sql->bindValue(2, $MenuIcon);
            $sql->bindValue(3, $MenuNom);
            $sql->bindValue(4, $IdMenu);
			$sql->execute();
        }

        public function delete_menu($IdMenu){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE menu SET Estatus=0 WHERE IdMenu=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $IdMenu);
			$sql->execute();
        }

        public function get_menu_x_id($IdMenu){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM menu WHERE IdMenu=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $IdMenu);
			$sql->execute();
			return $resultado=$sql->fetchAll();
        }

    }
?>