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

    //$id = $_POST['id_cliente'];

    $id_cliente = $_GET['id_cliente'];


    $sql = "UPDATE clientes SET  eliminado='1' where id_cliente='$id_cliente';";

    
    $data = $oData->setData1($sql);
    
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    //echo $data;
    exit();
        


?>