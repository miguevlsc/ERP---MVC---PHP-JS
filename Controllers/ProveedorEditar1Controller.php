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

    $id_prov = $_GET["id_prov"];

    // Instanciacion del objeto
    $oData = new Datos;
    // Llamada al metodo
    $sql = "select * from proveedor where id_proveedor = ?";

    $data = $oData->getDataPS1($sql,$id_prov,1);
    
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
            $id_prov = $row->id_proveedor;
            $telf = $row->telf;
            $nombre = $row->nombre;
            $ubicacion = $row->ubicacion;
        }
    }

?>