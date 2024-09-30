<?php

    /* INICIO - Tratamiento de los input type='text' */
    $textoConsulta1 = empty($_POST['textoConsulta1']) ? '' : $_POST['textoConsulta1'];
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

    $textoConsulta1 = "%".$textoConsulta1."%";

    //$sql = "select * from facturas where mar_coc like'%$textoConsulta1%' or mod_coc like'%$textoConsulta1%' or aut_coc='$textoConsulta1' order by mar_coc, mod_coc, aut_coc";
    $sql = "SELECT * FROM proveedor WHERE id_proveedor like ? or telf like ? or nombre like ? or ubicacion like ?;";

    $data = $oData->getDataPS1($sql,$textoConsulta1,4);

    
    if(empty($data))
    {
        echo"
            <div class='bloque1 negrita'>
                No hay datos.
            </div>
        ";
    }
    else
    {
        echo
        "
        <div class='bloque0 negrita'>
            <div class='bloque1'>ID Proveedor</div>
            <div class='bloque1'>Teléfono</div>
            <div class='bloque1'>Nombre</div>
            <div class='bloque1'>Ubicación</div>
            <div class='bloque1'>Editar</div>
            <div class='bloque1'>Eliminar</div>
        </div>
        ";
        foreach ($data as $row)
        {
            echo
            "
            <div class='bloque1'>
                <div class='bloque1'>$row->id_proveedor</div>
                <div class='bloque1'>$row->telf</div>
                <div class='bloque1'>$row->nombre</div>
                <div class='bloque1'>$row->ubicacion</div>
                <div class='bloque1'>";
            echo"</div>
                <div class='bloque1'><a href='editar-proveedor.php?id_prov=$row->id_proveedor'>Editar</a></div>
                <div class='bloque1'><a href='#' onclick='eliminarProveedor(event, $row->id_proveedor)'>Eliminar</a></div>
                <script>
                    function eliminarProveedor(event, id) {
                        event.preventDefault(); // Evita que el enlace redireccione la página
    
                        if (window.confirm(\"¿Estás seguro de que deseas eliminar este proveedor?\")) {
                            let url = \"Views/Eliminar/eliminar-proveedor.php?id_proveedor=\" + id;
                            window.location.href = url;
                        }
                    }
                </script>
                
            </div>";
                
        };     
    }


?>