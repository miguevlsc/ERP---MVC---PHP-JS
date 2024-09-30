<?php
    // Para poder accder desde motor.js o desde alguna View
    if(file_exists("../../Db/Con1Db.php"))
    {
        // Llamada a la conexion
        require_once "../../Db/Con1Db.php";
        // Llamada al modelo
        require_once "../../Models/Datos1Model.php";
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

    //$id = $_POST['id_proveedor'];

    $id_proveedor = $_GET['id_proveedor'];


    $sql = "DELETE FROM proveedor where id_prov='$id_proveedor';";


    $data = $oData->setData1($sql);

    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
        
    //echo $data;


?>