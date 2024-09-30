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
    $sql = "SELECT * FROM producto WHERE id_producto like ? or nombre_pro like ? or precio like ? or cantidad like ? or info like ? or compuesto like ? ;";

    $data = $oData->getDataPS1($sql,$textoConsulta1,6);

    
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
            <div class='bloque1'>ID Producto</div>
            <div class='bloque1'>Nombre</div>
            <div class='bloque1'>Precio</div>
            <div class='bloque1'>Unidades</div>
            <div class='bloque1'>Info</div>
            <div class='bloque1'>Prod. compuesto</div>
            <div class='bloque1'>Editar</div>
            <div class='bloque1'>Eliminar</div>
        </div>
        ";
        foreach ($data as $row)
        {
            echo
            "
            <div class='bloque1'>
                <div class='bloque1'>$row->id_producto</div>
                <div class='bloque1'>$row->nombre_pro</div>
                <div class='bloque1'>$row->precio</div>
                <div class='bloque1'>$row->cantidad</div>
                <div class='bloque1'>$row->info</div>
                <div class='bloque1'>";
                if($row->compuesto){
                    echo "<div class='bloque1'>SI</div>";
                }
                else{echo "<div class='bloque1'>No</div>";};
            echo"</div>
                <div class='bloque1'><a href='editar-articulo.php?id_producto=$row->id_producto'>Editar</a></div>
                <div class='bloque1'><a href='#' onclick='eliminarProducto(event, $row->id_producto)'>Eliminar</a></div>
                <script>
                    function eliminarProducto(event, id) {
                        event.preventDefault(); // Evita que el enlace redireccione la página
    
                        if (window.confirm(\"¿Estás seguro de que deseas eliminar este producto?\")) {
                            let url = \"Views/Eliminar/eliminar-articulo.php?id_producto=\" + id;
                            window.location.href = url;
                        }
                    }
                </script>
                
            </div>";
                
        };     
    }/* if($row->compuesto){
                    "<div class='bloque1'>SI</div>";
                }
                else{"<div class='bloque1'>No</div>";} */

?>