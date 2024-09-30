<?php

    /* INICIO - Tratamiento de los input type='text' */
    //$textoConsulta1 = empty($_POST['textoConsulta1']) ? '' : $_POST['textoConsulta1'];
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


    $sql = "SELECT COUNT(cli.id_cliente) as num_cli, SUM(fac.importe_total) as importe_total, COUNT(fac.id_factura_cli) as num_facturas  FROM factura_cliente fac 
    JOIN clientes cli ON fac.id_cliente=cli.id_cliente;";

    $data = $oData->getData1($sql);

    $respuesta=[];
    
    if(empty($data))
    {
        echo $respuesta = [];
    }
    else
    {

        foreach ($data as $row)
        {
            $respuesta = [
            $row->num_cli,
            $row->importe_total,
            $row->num_facturas
            ];
        }
        
        

        print_r($respuesta);
    }


?>