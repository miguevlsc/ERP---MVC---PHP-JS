<?php

    /* INICIO - Tratamiento de los input type='text' */
    $textoModificacion0 = $_POST['textoModificacion0'];
    $textoModificacion1 = empty($_POST['textoModificacion1']) ? '' : $_POST['textoModificacion1'];
    $textoModificacion2 = empty($_POST['textoModificacion2']) ? '' : $_POST['textoModificacion2'];
    $textoModificacion3 = empty($_POST['textoModificacion3']) ? '' : $_POST['textoModificacion3'];
    /* FIN - Tratamiento de los input type='text' */

    // Llamada a la conexion
    require_once "../Db/Con1Db.php";
    // Llamada al modelo
    require_once "../Models/Datos1Model.php";

    // Instanciacion del objeto
    $oData = new Datos;

    // Llamada al metodo
    $sql = "update proveedor set nombre='$textoModificacion1', telf= $textoModificacion2, ubicacion= '$textoModificacion3' WHERE id_proveedor = '$textoModificacion0';";
    $data = $oData->setData1($sql);
    
    echo $data;

?>