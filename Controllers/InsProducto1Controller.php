<?php

/* INICIO - Tratamiento de los input type='text' */
$nombre = empty($_POST['textoInsercion1']) ? '' : $_POST['textoInsercion1'];
$precio = empty($_POST['textoInsercion2']) ? '' : $_POST['textoInsercion2'];
$cantidad = empty($_POST['textoInsercion3']) ? '' : $_POST['textoInsercion3'];
$info = empty($_POST['textoInsercion4']) ? '' : $_POST['textoInsercion4'];
$compuesto = isset($_POST['textoInsercion5']) == true ? 1 : 0 ;
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

$sql = "INSERT INTO producto (`nombre_pro`, `precio`, `cantidad`, `info`, `compuesto`) VALUES (?, ?, ?, ?, ?)";

$data = $oData->setDataPreparedStatements1($sql, $nombre, $precio, $cantidad, $info, $compuesto);
echo $data;
?>