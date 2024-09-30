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
    //$sql = "SELECT * FROM clientes WHERE id_cliente like'%$textoConsulta1%' or nombre_cliente like'%$textoConsulta1%' or dni like'%$textoConsulta1%' or telef like'%$textoConsulta1%' or ubi like'%$textoConsulta1%' ;";
    $sql = "SELECT * FROM clientes WHERE id_cliente like ? or nombre_cliente like ? or dni like ? or telef like ? or ubi like ? ;";

    $data = $oData->getDataPS1($sql,$textoConsulta1,5);

    
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
            <div class='bloque1'>ID Cliente</div>
            <div class='bloque1'>Nombre</div>
            <div class='bloque1'>DNI</div>
            <div class='bloque1'>Teléfono</div>
            <div class='bloque1'>Ubicación</div>
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
            
                <div class='bloque1'>$row->id_cliente</div>
                <div class='bloque1'>$row->nombre_cliente</div>
                <div class='bloque1'>$row->dni</div>
                <div class='bloque1'>$row->telef</div>
                <div class='bloque1'>$row->ubi</div>
                <div class='bloque1'><a href='#' onclick='eliminarCliente(event, $row->id_cliente)'>Eliminar</a></div>
                <script>
                    function eliminarCliente(event, id) {
                        event.preventDefault(); // Evita que el enlace redireccione la página
    
                        if (window.confirm(\"¿Estás seguro de que deseas eliminar este cliente?\")) {
                            let url = \"Views/Eliminar/eliminar-cliente.php?id_cliente=\" + id;
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