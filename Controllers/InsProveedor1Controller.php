<?php

/* INICIO - Tratamiento de los input type='text' */
$nombre = empty($_POST['textoInsercion1']) ? '' : $_POST['textoInsercion1'];
$telefono = empty($_POST['textoInsercion2']) ? '' : $_POST['textoInsercion2'];
$ubicacion = empty($_POST['textoInsercion3']) ? '' : $_POST['textoInsercion3'];
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

$sql = "INSERT INTO proveedor (`nombre`, `telf`, `ubicacion`) VALUES (?, ?, ?)";

$data = $oData->setDataPreparedStatements2($sql, $nombre, $telefono, $ubicacion);
echo $data;
?>