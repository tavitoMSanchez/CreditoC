<?php
    class Usuario extends Conectar {
        
        public function login(){
			$conectar=parent::Conexion();
			parent::set_names();
			if(isset($_POST["enviar"])){
				
				$password = $_POST["password"];
				$correo = $_POST["correo"];

				if(empty($correo) and empty($password)){
					header("Location:".Conectar::ruta()."index.php?m=2");
					exit();
				}
			else {
				$sql= "select * from usuario where correo=? and pass=? and est=1";
				$sql=$conectar->prepare($sql);
				$sql->bindValue(1, $correo);
				$sql->bindValue(2, $password);
				$sql->execute();
				$resultado = $sql->fetch();
					if(is_array($resultado) and count($resultado)>0){
						$_SESSION["IdUsuario"] = $resultado["IdUsuario"];
                        $_SESSION["nom"] = $resultado["nom"];
                        $_SESSION["ape"] = $resultado["ape"];
						$_SESSION["correo"] = $resultado["correo"];
						$_SESSION["admon"] = $resultado["admon"];
						header("Location:".Conectar::ruta()."view/Home/");
						exit(); 
					} else {
						header("Location:".Conectar::ruta()."index.php?m=1");
						exit();
					} 
				}
			}
		}

		public function insert_usuario($nom,$ape,$correo,$pass){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO usuario values (NULL,?,?,?,?,NULL, NULL, NULL, '1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_nom);
            $sql->bindValue(2,$usu_ape);
			$sql->bindValue(3,$usu_correo);
			$sql->bindValue(4,$usu_pass);
            $sql->execute();
		}
		
		public function get_correo_usuario($usu_correo){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM usuario WHERE correo=? AND est=1;";
            $sql=$conectar->prepare($sql);
			$sql->bindValue(1,$usu_correo);
			$sql->execute();
			return $resultado=$sql->fetchAll();
        }

    }
?>