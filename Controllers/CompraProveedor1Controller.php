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
    //$sql = "SELECT * FROM factura_cliente WHERE id_factura_cli like'%$textoConsulta1%' or fecha like'%$textoConsulta1%' or importe_total like'%$textoConsulta1%' or id_cliente like'%$textoConsulta1%' ;";
    $sql = "SELECT * FROM factura_prov JOIN proveedor ON id_prov=id_proveedor WHERE id_factura_prov like ? or fecha like ? or precio_compra like ? or id_prov like ? ;";

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
            <div class='bloque1'>ID Factura</div>
            <div class='bloque1'>Proveedor</div>
            <div class='bloque1'>Importe total</div>
            <div class='bloque1'>Fecha</div>
            <div class='bloque1'>Eliminar</div>
        </div>
        ";
        $color=true;
        foreach ($data as $row)
        {
            if($color)
            {
                echo "<div class='bloque1 color1'>";
            }
            else{
                echo "<div class='bloque1 color2'>";
            }
            echo
            "
            
                <div class='bloque1'>$row->id_factura_prov</div>
                <div class='bloque1'>$row->nombre</div>
                <div class='bloque1'>$row->precio_compra</div>
                <div class='bloque1'>$row->fecha</div>
                <div class='bloque1'><a href='#' onclick='eliminarProducto(event, $row->id_factura_prov)'>Eliminar</a></div>
                <script>
                    function eliminarProducto(event, id) {
                        event.preventDefault(); // Evita que el enlace redireccione la página
    
                        if (window.confirm(\"¿Estás seguro de que deseas eliminar este producto?\")) {
                            let url = \"Views/Eliminar/eliminar-articulo.php?id_producto=\" + id;
                            window.location.href = url;
                        }
                    }
                </script>
            </div>
            ";
            if($color){$color=false;}
            else{$color=true;}
        }
    }

?>