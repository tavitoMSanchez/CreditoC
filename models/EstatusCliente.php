<?php
    class Cliente extends Conectar {

		public function get_estatuscliente(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM estatuscliente";
            $sql=$conectar->prepare($sql);
           
			$sql->execute();
			return $resultado=$sql->fetchAll();
        }
        public function get_usuariocliente(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM usuario WHERE est = 1 and admon = 0";
            $sql=$conectar->prepare($sql);
           	$sql->execute();
			return $resultado=$sql->fetchAll();
        }

    }
?>