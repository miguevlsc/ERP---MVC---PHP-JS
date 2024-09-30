<?php
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

    $id_producto = $_GET["id_producto"];

    // Instanciacion del objeto
    $oData = new Datos;
    // Llamada al metodo
    $sql = "select * from producto where id_producto = ?";

    $data = $oData->getDataPS1($sql,$id_producto,1);
    
    if(empty($data))
    {
        echo
        "
            <div class='bloque1 negrita'>
                No hay datos.
            </div>
        ";
    }
    else
    {
        foreach ($data as $row)
        {
            $ideArt = $row->id_producto;
            $nomArt = $row->nombre_pro;
            $pvpArt = $row->precio;
            $cantidad = $row->cantidad;
            $info = $row->info;
            $compuesto = $row->compuesto;
        }
    }

?>