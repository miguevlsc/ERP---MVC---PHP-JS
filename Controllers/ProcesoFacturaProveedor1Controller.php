<?php

/* INICIO - Tratamiento de los input type='text' */
$nombreProveedor = empty($_POST['textoInsercion1']) ? '' : $_POST['textoInsercion1'];
$producto = empty($_POST['textoInsercion2']) ? '' : $_POST['textoInsercion2'];
$cantidad = empty($_POST['textoInsercion3']) ? '' : $_POST['textoInsercion3'];
/* FIN - Tratamiento de los input type='text' */

// Para poder accder desde motor.js o desde alguna View
if(file_exists("../Db/Con1Db.php"))
{
    // Llamada a la conexion
    require_once "../Db/Con1Db.php";
    // Llamada al modelo
    require_once "../Models/Datos1Model.php";
}
elseif(file_exists("Db/Con1Db.php"))
{
    // Llamada a la conexion
    require_once "Db/Con1Db.php";
    // Llamada al modelo
    require_once "Models/Datos1Model.php";
}
// Instanciacion del objeto
$oData = new Datos;
// Llamada al metodo
$oData->controlAcceso1();
$sql1 = "SELECT id_producto FROM producto WHERE nombre_pro=?";

$comprobarProducto = $oData->getDataPS1($sql1,$producto,1);

$oData = new Datos;
$resultado;

if(!empty($comprobarProducto))
{
    $compraProveedor1 = "CALL compraProveedor1('$nombreProveedor', '$producto', $cantidad)";
    $resultado = $oData->setData1($compraProveedor1);
}
echo $resultado;
?>