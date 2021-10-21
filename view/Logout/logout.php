<?php
@session_start();
session_destroy();
header("Location: ../../index.php");
?>



 /*<?php
    srequire_once("../../config/conexion.php");
    session_destroy();
    header("Location:".Conectar::ruta()."index.php");
    exit();
?> */